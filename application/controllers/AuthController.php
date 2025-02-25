<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *
 * Controller AuthController
 *
 * This controller for ...
 *
 * @package   CodeIgniter
 * @category  Controller CI
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @author    Raul Guerrero <r.g.c@me.com>
 * @link      https://github.com/setdjod/myci-extension/
 * @param     ...
 * @return    ...
 *
 */

class AuthController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Petugas_model');
	}

	public function index()
	{
		// 
		$this->load->view('Login/index');
	}


	public function proses_login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$user = $this->Petugas_model->cek_login($username);

		if ($user && password_verify($password, $user->password)) {
			$data_session = [
				'id_petugas' => $user->id_petugas,
				'username' => $user->username,
				'id_level' => $user->id_level,
				'logged_in' => TRUE
			];
			$this->session->set_userdata($data_session);
			redirect('DashboardController/render');
		} else {
			$this->session->set_flashdata('error', 'Username atau Password salah!');
			redirect('AuthController  /login');
		}
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('auth/login');
	}
}


/* End of file AuthController.php */
/* Location: ./application/controllers/AuthController.php */
