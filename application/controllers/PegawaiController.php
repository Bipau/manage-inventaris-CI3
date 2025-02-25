<?php

defined("BASEPATH") or exit("No direct script access allowed");

class PegawaiController extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("PegawaiModel");
    }

    public function index()
    {
        $this->load->model('PegawaiModel');

        $data['pegawai'] = $this->PegawaiModel->getAllPegawai();

        $this->load->view('templates/header');
        $this->load->view('templates/sidebar');
        $this->load->view('pegawai/index', $data);
        $this->load->view('templates/footer');
    }

    public function createPegawai()
    {
        $this->form_validation->set_rules('nama_pegawai', 'Nama Pegawai', 'required');
        $this->form_validation->set_rules('nip', 'NIP', 'required|numeric');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');

        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error_nama_pegawai', form_error('nama_pegawai'));
            $this->session->set_flashdata('error_nip', form_error('nip'));
            $this->session->set_flashdata('error_alamat', form_error('alamat'));

            $this->session->set_flashdata('old_data', $this->input->post());

            $this->session->set_flashdata('show_modal', true);

            redirect('PegawaiController');
        } else {
            $data = array(
                'nama_pegawai' => $this->input->post('nama_pegawai'),
                'nip' => $this->input->post('nip'),
                'alamat' => $this->input->post('alamat')
            );
            $this->PegawaiModel->insertPegawai($data);

            $this->session->unset_userdata('old_data');
            $this->session->unset_userdata('show_modal');

            $this->session->set_flashdata('success', 'Data Pegawai berhasil ditambahkan!');
            redirect('PegawaiController');
        }
    }

    public function deletePegawai($id)
    {
        $where = array('id_pegawai' => $id);
        $this->load->model('PegawaiModel');
        $this->PegawaiModel->deletePegawai($where, 'pegawai');
        $this->session->set_flashdata('success', 'Data berhasil dihapus!');

        redirect('PegawaiController');
    }

    public function updatePegawai($id)
    {
        $form = [
            'nama_pegawai' => $this->input->post('nama_pegawai'),
            'nip' => $this->input->post('nip'),
            'alamat' => $this->input->post('alamat'),
        ];
        $this->load->model('PegawaiModel');
        $this->PegawaiModel->updatePegawai($id, $form);
        $this->session->set_flashdata('success', 'Data berhasil diperbarui!');

        redirect('PegawaiController');
    }
}