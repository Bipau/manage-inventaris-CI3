<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_inventaris extends CI_Model {
    
    public function get_all_inventaris() {
        $this->db->select('inventaris.*, jenis.nama_jenis, petugas.nama_petugas, ruang.nama_ruang');
        $this->db->from('inventaris');
        $this->db->join('jenis', 'inventaris.id_jenis = jenis.id_jenis', 'left');
        $this->db->join('petugas', 'inventaris.id_petugas = petugas.id_petugas', 'left');
        $this->db->join('ruang', 'inventaris.id_ruang = ruang.id_ruang', 'left');
        return $this->db->get()->result();
    }

    public function insert_inventaris($data) {
        return $this->db->insert('inventaris', $data);
    }

    public function get_inventaris_by_id($id) {
        return $this->db->get_where('inventaris', ['id_inventaris' => $id])->row();
    }

    public function update_inventaris($id, $data) {
        $this->db->where('id_inventaris', $id);
        return $this->db->update('inventaris', $data);
    }

    public function delete_inventaris($id) {
        $this->db->where('id_inventaris', $id);
        return $this->db->delete('inventaris');
    }

    public function get_all_jenis() {
        return $this->db->get('jenis')->result();
    }

    public function get_all_petugas() {
        return $this->db->get('petugas')->result();
    }

    public function get_all_ruang() {
        return $this->db->get('ruang')->result();
    }

    public function get_last_kode() {
        $this->db->select('kode_inventaris');
        $this->db->from('inventaris');
        $this->db->order_by('kode_inventaris', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get();
        return $query->row_array()['kode_inventaris'] ?? null;
    }
    
}
?>
