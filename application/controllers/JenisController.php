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

class JenisController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session'); // Pastikan library session sudah dimuat
        $this->is_logged_in();
		$this->load->model('Jenis_model', 'jenis');
	}


	private function is_logged_in()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('AuthController/index'); // Redirect ke halaman login
        }
    }

	public function index()
	{

		$data['jenis'] = $this->jenis->index();

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('jenis/index', $data);
		$this->load->view('templates/footer');
	}

	public function CreateAction()
	{


		$nama_jenis =  $this->input->post('nama_jenis');
        $kode_jenis = $this->input->post('kode_jenis');
        $keterangan = $this->input->post('keterangan');


		$data = [
			'nama_jenis' => $nama_jenis,
			'kode_jenis' => $kode_jenis,
			'keterangan' => $keterangan,
		];

		$this->jenis->create($data);

		$this->session->set_flashdata('success', 'Data berhasil ditambahkan.');
		redirect('JenisController');
	}

	public function UpdateAction()
{
    $this->load->library('form_validation');

    // Aturan validasi
    $this->form_validation->set_rules('nama_jenis', 'Nama Jenis', 'required', [
        'required' => 'Nama jenis harus diisi.'
    ]);
    $this->form_validation->set_rules('kode_jenis', 'Kode Jenis', 'required', [
        'required' => 'Kode jenis harus diisi.'
    ]);
    $this->form_validation->set_rules('keterangan', 'Keterangan', 'required', [
        'required' => 'Keterangan harus diisi.'
    ]);

    if ($this->form_validation->run() == FALSE) {
        $this->session->set_flashdata('error', 'Gagal mengupdate data. Pastikan semua kolom terisi.');
        redirect('JenisController/index');
    } else {
        $data = [
            'id_jenis' => $this->input->post('id_jenis'),
            'nama_jenis' => $this->input->post('nama_jenis'),
            'kode_jenis' => $this->input->post('kode_jenis'),
            'keterangan' => $this->input->post('keterangan')
        ];

        $this->jenis->update($data);
        $this->session->set_flashdata('success', 'Data berhasil diupdate.');
        redirect('JenisController/index');
    }
}


	public function deleteDataJenis($id_jenis)
	{
		// Validasi jika id tidak valid
		if (!$id_jenis || !is_numeric($id_jenis)) {
			$this->session->set_flashdata('error', 'jenis tidak valid.');
			redirect('JenisController/index');
		}

		// Check jika data level ditemukan
		$level = $this->jenis->getById($id_jenis); // Gunakan alias yang benar
		if (!$id_jenis) {
			$this->session->set_flashdata('error', 'Data jenis tidak ditemukan.');
			redirect('JenisController/index');
		}

	
		// Process delete data
		$delete = $this->jenis->deleteDataJenis($id_jenis);

		if ($delete) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus.');
		} else {
			$this->session->set_flashdata('error', 'Gagal menghapus data.');
		}

		redirect('JenisController/index');
	}
}


/* End of file JenisController.php */
/* Location: ./application/controllers/JenisController.php */
