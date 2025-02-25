<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class C_inventaris extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('M_inventaris'); 
        $this->load->helper(['url', 'form']);
        $this->load->library(['upload', 'form_validation','session']);
		$this->is_logged_in();
    }


	private function is_logged_in()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('AuthController/index'); // Redirect ke halaman login
        }
    }

    public function inventaris() {
        $data['inventaris'] = $this->M_inventaris->get_all_inventaris();
        $data['jenis'] = $this->M_inventaris->get_all_jenis();
        $data['petugas'] = $this->M_inventaris->get_all_petugas();
        $data['ruang'] = $this->M_inventaris->get_all_ruang();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('inventaris/inventaris', $data);
        $this->load->view('templates/footer');

        $last_kode = $this->M_inventaris->get_last_kode(); 
        echo $last_kode;
    }

    public function simpan() {
        // Validasi Input
        $this->form_validation->set_rules('nama', 'Nama Inventaris', 'required');
        $this->form_validation->set_rules('kondisi', 'Kondisi', 'required');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required|integer');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('C_inventaris/inventaris');
        }

        // Ambil kode inventaris terakhir
        $lastKode = $this->M_inventaris->get_last_kode();
        if ($lastKode) {
            $lastNumber = (int) substr($lastKode, 2); // Ambil angka setelah 'IN'
            $newNumber = $lastNumber + 1;
            $newKode = 'IN' . str_pad($newNumber, 3, '0', STR_PAD_LEFT); // Format IN001, IN002, ...
        } else {
            $newKode = 'IN001';
        }

        // Pastikan folder upload tersedia
        if (!is_dir('./uploads/')) {
            mkdir('./uploads/', 0777, true);
        }

        // Konfigurasi Upload
        $config['upload_path']   = './uploads/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $this->upload->initialize($config);

        if ($this->upload->do_upload('foto')) {
            $foto = $this->upload->data('file_name');
        } else {
            $foto = null;
        }

        $data = [
            'nama' => $this->input->post('nama'),
            'kondisi' => $this->input->post('kondisi'),
            'keterangan' => $this->input->post('keterangan'),
            'jumlah' => $this->input->post('jumlah'),
            'id_jenis' => $this->input->post('id_jenis'),
            'tanggal_register' => $this->input->post('tanggal_register'),
            'id_ruang' => $this->input->post('id_ruang'),
            'kode_inventaris' => $newKode,
            'id_petugas' => $this->input->post('id_petugas'),
            'foto' => $foto
        ];
        $this->M_inventaris->insert_inventaris($data);
        redirect('C_inventaris/inventaris');
    }

    public function update($id) {
        // Validasi Input
        $this->form_validation->set_rules('nama', 'Nama Inventaris', 'required');
        $this->form_validation->set_rules('kondisi', 'Kondisi', 'required');
        $this->form_validation->set_rules('jumlah', 'Jumlah', 'required|integer');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error', validation_errors());
            redirect('C_inventaris/inventaris');
        }

        // Konfigurasi Upload
        $config['upload_path']   = './uploads/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size']      = 2048;
        $this->upload->initialize($config);

        if ($this->upload->do_upload('foto')) {
            $foto = $this->upload->data('file_name');
        } else {
            $foto = $this->input->post('foto_lama');
        }

        $data = [
            'nama' => $this->input->post('nama'),
            'kondisi' => $this->input->post('kondisi'),
            'keterangan' => $this->input->post('keterangan'),
            'jumlah' => $this->input->post('jumlah'),
            'id_jenis' => $this->input->post('id_jenis'),
            'tanggal_register' => $this->input->post('tanggal_register'),
            'id_ruang' => $this->input->post('id_ruang'),
            'kode_inventaris' => $this->input->post('kode_inventaris'),
            'id_petugas' => $this->input->post('id_petugas'),
            'foto' => $foto
        ];
        $this->M_inventaris->update_inventaris($id, $data);
        redirect('C_inventaris/inventaris');
    }

    public function hapus($id) {
        $this->M_inventaris->delete_inventaris($id);
        redirect('C_inventaris/inventaris');
    }
}
