<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardController extends CI_Controller {


	public function __construct()
    {
        parent::__construct();
        // Panggil fungsi untuk memeriksa status login
        $this->load->library('session'); // Pastikan library session sudah dimuat
        $this->is_logged_in();
    }

	private function is_logged_in()
    {
        if (!$this->session->userdata('logged_in')) {
            redirect('AuthController/index'); // Redirect ke halaman login
        }
    }

	public function render()
	{
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('dashboard/index');
		$this->load->view('templates/footer');
	}
}
