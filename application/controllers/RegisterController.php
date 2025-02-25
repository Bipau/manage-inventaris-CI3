<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *
 * Controller RegisterController
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

class RegisterController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('Petugas_model', 'petugas');
		$this->load->model('Level_model', 'level');
	}

	public function index()
	{
		$data['level'] = $this->level->index(); // Ambil data level untuk dropdown
		
		$this->load->view('register/index', $data); // Load view register
	
	}
	public function register_action()
    {
        // Set validation rules
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[petugas.username]', [
            'required' => 'Username harus diisi.',
            'is_unique' => 'Username sudah digunakan.'
        ]);
        $this->form_validation->set_rules('nama_petugas', 'Nama', 'required', [
            'required' => 'Nama harus diisi.'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]', [
            'required' => 'Password harus diisi.',
            'min_length' => 'Password minimal 8 karakter.'
        ]);
       

        if ($this->form_validation->run() == FALSE) {
            // Validation failed, reload the form with errors
            $data['level'] = $this->level->index();
      
            $this->load->view('register/index', $data);
     
        } else {
            // Validation passed, process the registration
            $username = $this->input->post('username');
            $nama = $this->input->post('nama_petugas');
            $password = $this->input->post('password');
          
            $foto = $_FILES['foto'];

            // Handle file upload
            if ($foto != '') {
                $config['upload_path'] = './assets/img';
                $config['allowed_types'] = 'jpg|png|gif';
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('foto')) {
                    // Handle upload error
                    $this->session->set_flashdata('error', $this->upload->display_errors());
                    redirect('RegisterController/index');
                } else {
                    $foto = $this->upload->data('file_name');
                }
            } else {
                $foto = 'default.jpg'; // Default image if no file is uploaded
            }

            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);

            // Prepare data for insertion
            $data = array(
                'username' => $username,
                'password' => $hashed_password,
                'nama_petugas' => $nama,
                'id_level' => 2,
                'foto' => $foto
            );

            // Insert data into the database
            $this->petugas->create($data);

            // Set success message and redirect
            $this->session->set_flashdata('success', 'Pendaftaran berhasil. Silakan login.');
            redirect('AuthController/index'); // Redirect to login page
        }
    }
}


/* End of file RegisterController.php */
/* Location: ./application/controllers/RegisterController.php */
