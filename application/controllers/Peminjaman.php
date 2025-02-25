<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Peminjaman extends CI_Controller {
    
    public function __construct() {
        parent::__construct();

		
        $this->load->model('Peminjaman_model');
        $this->load->helper(['form', 'url', 'security']);
        $this->load->library(['form_validation','session']);
        $this->is_logged_in();
    }

	private function is_logged_in()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('AuthController/index'); // Redirect ke halaman login
        }
    }

    // Validation callback methods
    public function validate_date($date) {
        if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $date)) {
            $this->form_validation->set_message('validate_date', 'Format {field} tidak valid');
            return FALSE;
        }
        return TRUE;
    }

    public function date_not_past($date) {
        if (strtotime($date) < strtotime(date('Y-m-d'))) {
            $this->form_validation->set_message('date_not_past', '{field} tidak boleh tanggal lampau');
            return FALSE;
        }
        return TRUE;
    }

    public function date_after_pinjam($return_date) {
        $pinjam_date = $this->input->post('tanggal_pinjam');
        if (strtotime($return_date) <= strtotime($pinjam_date)) {
            $this->form_validation->set_message('date_after_pinjam', 'Tanggal Kembali harus setelah Tanggal Pinjam');
            return FALSE;
        }
        return TRUE;
    }

    public function index() {
        $data['title'] = 'Peminjaman & Pengembalian';
        $data['peminjaman'] = $this->Peminjaman_model->get_all_peminjaman();
        $data['pegawai'] = $this->Peminjaman_model->get_all_pegawai();
        $data['inventaris'] = $this->Peminjaman_model->get_all_inventaris();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('peminjaman/index', $data);
        $this->load->view('templates/footer');
    }

    public function tambah() {
        // Set validation rules
        $this->form_validation->set_rules('tanggal_pinjam', 'Tanggal Pinjam', 'required|callback_validate_date|callback_date_not_past');
        $this->form_validation->set_rules('tanggal_kembali', 'Tanggal Kembali', 'required|callback_validate_date|callback_date_after_pinjam');
        $this->form_validation->set_rules('id_pegawai', 'Pegawai', 'required');
        $this->form_validation->set_rules('id_inventaris', 'Barang', 'required');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required|numeric');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('peminjaman');
        } else {
            // Prepare base data
            $data_peminjaman = [
                'tanggal_pinjam' => $this->input->post('tanggal_pinjam'),
                'tanggal_kembali' => $this->input->post('tanggal_kembali'),
                'status_peminjaman' => 'Dipinjam',
                'id_pegawai' => $this->input->post('id_pegawai'),
                'created_at' => date('Y-m-d H:i:s')
            ];

            // Insert peminjaman data
            $insert_id = $this->Peminjaman_model->tambah_peminjaman($data_peminjaman);
            
            if ($insert_id) {
                // Prepare detail pinjam data
                $data_detail_pinjam = [
                    'id_inventaris' => $this->input->post('id_inventaris'),
                    'jumlah' => $this->input->post('jumlah'),
                    'id_peminjaman' => $insert_id
                ];

                // Insert detail pinjam data
                $this->Peminjaman_model->tambah_detail_pinjam($data_detail_pinjam);

                $this->session->set_flashdata('success', 'Data peminjaman berhasil ditambahkan');
            } else {
                $this->session->set_flashdata('error', 'Gagal menambahkan data peminjaman');
            }
            
            redirect('peminjaman');
        }
    }

	public function edit($id) {
		// Set validation rules
		$this->form_validation->set_rules('tanggal_pinjam', 'Tanggal Pinjam', 'required|callback_validate_date');
		$this->form_validation->set_rules('tanggal_kembali', 'Tanggal Kembali', 'required|callback_validate_date|callback_date_after_pinjam');
		$this->form_validation->set_rules('id_pegawai', 'Pegawai', 'required');
		$this->form_validation->set_rules('id_inventaris', 'Barang', 'required');
		$this->form_validation->set_rules('jumlah', 'Jumlah', 'required|numeric');
	
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', validation_errors());
			redirect('peminjaman');
		} else {
			$old_data = $this->Peminjaman_model->get_peminjaman_by_id($id);
			if (!$old_data) {
				$this->session->set_flashdata('error', 'Data peminjaman tidak ditemukan');
				redirect('peminjaman');
				return;
			}
	
			$data_peminjaman = [
				'tanggal_pinjam' => $this->input->post('tanggal_pinjam'),
				'tanggal_kembali' => $this->input->post('tanggal_kembali'),
				'status_peminjaman' => $this->input->post('status_peminjaman'),
				'id_pegawai' => $this->input->post('id_pegawai'),
				'updated_at' => date('Y-m-d H:i:s')
			];
	
			$data_detail_pinjam = [
				'id_inventaris' => $this->input->post('id_inventaris'),
				'jumlah' => $this->input->post('jumlah'),
				'id_peminjaman' => $id
			];
	
			// Update peminjaman data
			if ($this->Peminjaman_model->update_peminjaman($id, $data_peminjaman)) {
				// Update detail pinjam data
				$this->Peminjaman_model->update_detail_pinjam($id, $data_detail_pinjam);
	
				$this->session->set_flashdata('success', 'Data peminjaman berhasil diupdate');
			} else {
				$this->session->set_flashdata('error', 'Gagal mengupdate data peminjaman');
			}
			
			redirect('peminjaman');
		}
	}
	
	public function hapus($id) {
		$peminjaman = $this->Peminjaman_model->get_peminjaman_by_id($id);
		
		if (!$peminjaman) {
			$this->session->set_flashdata('error', 'Data peminjaman tidak ditemukan');
			redirect('peminjaman');
			return;
		}
	
		// Delete detail pinjam data
		$this->Peminjaman_model->hapus_detail_pinjam($id);
	
		// Delete peminjaman data
		if ($this->Peminjaman_model->hapus_peminjaman($id)) {
			$this->session->set_flashdata('success', 'Data peminjaman berhasil dihapus');
		} else {
			$this->session->set_flashdata('error', 'Gagal menghapus data peminjaman');
		}
	
		redirect('peminjaman');
	}
	
	public function kembalikan($id) {
		if ($this->Peminjaman_model->kembalikan_barang($id)) {
			$this->session->set_flashdata('success', 'Barang berhasil dikembalikan.');
		} else {
			$this->session->set_flashdata('error', 'Gagal mengembalikan barang.');
		}
		redirect('peminjaman');
	}
}
