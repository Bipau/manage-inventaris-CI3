<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Don't forget include/define REST_Controller path

/**
 *
 * Controller LevelController
 *
 * This controller for ...
 *
 * @package   CodeIgniter
 * @category  Controller REST
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @author    Raul Guerrero <r.g.c@me.com>
 * @link      https://github.com/setdjod/myci-extension/
 * @param     ...
 * @return    ...
 *
 */

class Ruang_Controller extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->library('session'); // Pastikan library session sudah dimuat
        $this->is_logged_in();
		
		$this->load->model('Model_ruang', 'ruang');

	}

	private function is_logged_in()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('AuthController/index'); // Redirect ke halaman login
        }
    }

	public function index()
	{

		$data['ruang'] = $this->ruang->index();

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('Ruang/index', $data);
		$this->load->view('templates/footer');
	}
	public function create()
	{


		$data['ruang'] = $this->ruang->index();

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('Ruang/create', $data);
		$this->load->view('templates/footer');
	}



	public function CreateAction()
	{


		$nama_ruang =  $this->input->post('ruang');
		$kode_ruang =  $this->input->post('kode_ruang');
		$keterangan =  $this->input->post('keterangan');

		$data = [
			'nama_ruang' => $nama_ruang,
			'kode_ruang' => $kode_ruang,
			'keterangan' => $keterangan,
		];

		$this->ruang->create($data);

		$this->session->set_flashdata('success', 'Data berhasil ditambahkan.');
		redirect('Ruang_Controller');
	}

	

	public function UpdateAction()
	{
		$this->load->library('form_validation');

		// Aturan validasi
		$this->form_validation->set_rules('ruang', 'Nama ruang', 'required', [
			'required' => 'Nama jenis harus diisi.'
		]);
		$this->form_validation->set_rules('kode_ruang', 'Kode ruang', 'required', [
			'required' => 'Kode jenis harus diisi.'
		]);
		$this->form_validation->set_rules('keterangan', 'Keterangan', 'required', [
			'required' => 'Keterangan harus diisi.'
		]);
	
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Gagal mengupdate data. Pastikan semua kolom terisi.');
			redirect('Ruang_Controller/index');
		} else {
			$data = [
				'id_ruang' => $this->input->post('id_ruang'),
				'nama_ruang' => $this->input->post('ruang'),
				'kode_ruang' => $this->input->post('kode_ruang'),
				'keterangan' => $this->input->post('keterangan')
			];
	
			$this->ruang->update($data);
			$this->session->set_flashdata('success', 'Data berhasil diupdate.');
			redirect('Ruang_Controller/index');
		}
	}

	public function DeleteRuang($ruang)
	{
		// Validasi jika id tidak valid
		if (!$ruang || !is_numeric($ruang)) {
			$this->session->set_flashdata('error', 'Ruang tidak valid.');
			redirect('Ruang_Controllerr/index');
		}

		// Check jika data level ditemukan
		$level = $this->ruang->getById($ruang); // Gunakan alias yang benar
		if (!$ruang) {
			$this->session->set_flashdata('error', 'Data Ruang tidak ditemukan.');
			redirect('Ruang_Controller/index');
		}

	
		// Process delete data
		$delete = $this->ruang->DeleteDataRuang($ruang);

		if ($delete) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus.');
		} else {
			$this->session->set_flashdata('error', 'Gagal menghapus data.');
		}

		redirect('Ruang_Controller/index');
	}
}


/* End of file Ruang_Controller.php */
/* Location: ./application/controllers/Ruang_Controller.php */
