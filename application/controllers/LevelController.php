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

class LevelController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Level_model', 'level');
	}

	public function index()
	{


		$data['level'] = $this->level->index();

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('level/index', $data);
		$this->load->view('templates/footer');
	}

	public function CreateAction()
	{


		$nama_level =  $this->input->post('level');

		$data = [
			'nama_level' => $nama_level,
		];

		$this->level->create($data);

		$this->session->set_flashdata('success', 'Data berhasil ditambahkan.');
		redirect('LevelController');
	}

	public function UpdateAction()
	{
		$this->load->library('form_validation');

		$this->form_validation->set_rules('level', 'Nama Level', 'required', [
			'required' => 'Nama level harus diisi.'
		]);

		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error', 'Gagal mengupdate data.');
			redirect('LevelController/index');
		} else {
			$data = [
				'id_level' => $this->input->post('id_level'),
				'nama_level' => $this->input->post('level')
			];

			$this->level->update($data);
			$this->session->set_flashdata('success', 'Data berhasil diupdate.');
			redirect('LevelController/index');
		}
	}

	public function deletePetugas($id_level)
	{
		// Validasi jika id tidak valid
		if (!$id_level || !is_numeric($id_level)) {
			$this->session->set_flashdata('error', 'level tidak valid.');
			redirect('LevelController/index');
		}

		// Check jika data level ditemukan
		$level = $this->level->getById($id_level); // Gunakan alias yang benar
		if (!$level) {
			$this->session->set_flashdata('error', 'Data level tidak ditemukan.');
			redirect('LevelController/index');
		}

	
		// Process delete data
		$delete = $this->level->deleteDataLevel($id_level);

		if ($delete) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus.');
		} else {
			$this->session->set_flashdata('error', 'Gagal menghapus data.');
		}

		redirect('LevelController/index');
	}
}


/* End of file LevelController.php */
/* Location: ./application/controllers/LevelController.php */
