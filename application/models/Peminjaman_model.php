<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjaman_model extends CI_Model {
    
    public function get_all_peminjaman() {
        $this->db->select('peminjaman.*, pegawai.nama_pegawai');
        $this->db->from('peminjaman');
        $this->db->join('pegawai', 'pegawai.id_pegawai = peminjaman.id_pegawai', 'left');
        $this->db->order_by('peminjaman.created_at', 'DESC');
        $peminjaman = $this->db->get()->result();
    
        foreach ($peminjaman as $p) {
            if ($this->cek_status_terlambat($p->id_peminjaman)) {
                $p->status_peminjaman = 'Terlambat';
            }
        }
    
        return $peminjaman;
    }
    
    public function get_all_pegawai() {
        $this->db->select('*');
        $this->db->from('pegawai');
        return $this->db->get()->result();
    }
    
    public function get_all_inventaris() {
        $this->db->select('*');
        $this->db->from('inventaris');
        return $this->db->get()->result();
    }
    
    public function get_peminjaman_only() {
        $this->db->select('peminjaman.*, pegawai.nama_pegawai');
        $this->db->from('peminjaman');
        $this->db->join('pegawai', 'pegawai.id_pegawai = peminjaman.id_pegawai', 'left');
        $this->db->where('peminjaman.status_peminjaman', 'Dipinjam');
        $this->db->order_by('peminjaman.created_at', 'DESC');
        $peminjaman = $this->db->get()->result();
        
        foreach ($peminjaman as $p) {
            if ($this->cek_status_terlambat($p->id_peminjaman)) {
                $p->status_peminjaman = 'Terlambat';
                
                $data = [
                    'status_peminjaman' => 'Terlambat',
                    'updated_at' => date('Y-m-d H:i:s')
                ];
                $this->db->where('id_peminjaman', $p->id_peminjaman);
                $this->db->update('peminjaman', $data);
            }
        }
        
        return $peminjaman;
    }
    
    public function get_pengembalian_only() {
        $this->db->select('peminjaman.*, pegawai.nama_pegawai');
        $this->db->from('peminjaman');
        $this->db->join('pegawai', 'pegawai.id_pegawai = peminjaman.id_pegawai', 'left');
        $this->db->where_in('peminjaman.status_peminjaman', ['Dikembalikan', 'Terlambat']);
        $this->db->order_by('peminjaman.updated_at', 'DESC');
        return $this->db->get()->result();
    }

    public function kembalikan_barang($id_peminjaman) {
        $peminjaman = $this->get_peminjaman_by_id($id_peminjaman);
        
        if (!$peminjaman) {
            return false;
        }
    
        $tanggal_kembali = strtotime($peminjaman->tanggal_kembali);
        $tanggal_sekarang = strtotime(date('Y-m-d'));
    
        $status = ($tanggal_sekarang > $tanggal_kembali) ? 'Terlambat' : 'Dikembalikan';
    
        $data = [
            'status_peminjaman' => $status,
            'updated_at' => date('Y-m-d H:i:s')
        ];
    
        $this->db->where('id_peminjaman', $id_peminjaman);
        return $this->db->update('peminjaman', $data);
    }
    
    public function cek_status_terlambat($id_peminjaman) {
        $peminjaman = $this->db->get_where('peminjaman', ['id_peminjaman' => $id_peminjaman])->row();
        if ($peminjaman) {
            $tanggal_kembali = strtotime($peminjaman->tanggal_kembali);
            $sekarang = strtotime(date('Y-m-d'));
            if ($sekarang > $tanggal_kembali && $peminjaman->status_peminjaman == 'Dipinjam') {
                return true; // Terlambat
            }
        }
        return false; // Tidak terlambat
    }

	public function get_peminjaman_by_id($id) {
		$this->db->select('peminjaman.*, pegawai.nama_pegawai, inventaris.nama as nama_barang');
		$this->db->from('peminjaman');
		$this->db->join('pegawai', 'pegawai.id_pegawai = peminjaman.id_pegawai', 'left');
		$this->db->join('detail_pinjam', 'detail_pinjam.id_peminjaman = peminjaman.id_peminjaman', 'left');
		$this->db->join('inventaris', 'inventaris.id_inventaris = detail_pinjam.id_inventaris', 'left');
		$this->db->where('peminjaman.id_peminjaman', $id);
		$query = $this->db->get();
		if ($query->num_rows() > 0) {
			$row = $query->row();
			$row->detail_pinjam = $this->get_detail_pinjam_by_peminjaman($id);
			return $row;
		}
		return null;
	}
	
	public function get_detail_pinjam_by_peminjaman($id_peminjaman) {
		$this->db->select('detail_pinjam.*, inventaris.nama as nama_barang');
		$this->db->from('detail_pinjam');
		$this->db->join('inventaris', 'inventaris.id_inventaris = detail_pinjam.id_inventaris', 'left');
		$this->db->where('detail_pinjam.id_peminjaman', $id_peminjaman);
		return $this->db->get()->result();
	}
    public function tambah_peminjaman($data_peminjaman) {
        $this->db->trans_start();
        $this->db->insert('peminjaman', $data_peminjaman);
        $insert_id = $this->db->insert_id();
        $this->db->trans_complete();
        
        return $this->db->trans_status() ? $insert_id : false;
    }

    public function update_peminjaman($id, $data_peminjaman) {
        $this->db->trans_start();
        $this->db->where('id_peminjaman', $id);
        $this->db->update('peminjaman', $data_peminjaman);
        $this->db->trans_complete();
        
        return $this->db->trans_status();
    }

	public function update_detail_pinjam($id_peminjaman, $data_detail_pinjam) {
		$this->db->where('id_peminjaman', $id_peminjaman);
		return $this->db->update('detail_pinjam', $data_detail_pinjam);
	}
	
	public function hapus_detail_pinjam($id_peminjaman) {
		$this->db->where('id_peminjaman', $id_peminjaman);
		return $this->db->delete('detail_pinjam');
	}
    
    public function hapus_peminjaman($id) {
        $this->db->trans_start();
        $this->db->where('id_peminjaman', $id);
        $this->db->delete('peminjaman');
        $this->db->trans_complete();
        
        return $this->db->trans_status();
    }
    
    public function tambah_detail_pinjam($data_detail_pinjam) {
        $this->db->trans_start();
        $this->db->insert('detail_pinjam', $data_detail_pinjam);
        $this->db->trans_complete();
        
        return $this->db->trans_status();
    }
}
