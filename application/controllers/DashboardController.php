<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardController extends CI_Controller {

	public function render()
	{
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('dashboard/index');
		$this->load->view('templates/footer');
	}
}
