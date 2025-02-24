<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Don't forget include/define REST_Controller path

/**
 *
 * Controller PetugasController
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

class PetugasController extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();

		$this->load->model('Petugas_model', 'petugas');
		$this->load->model('Level_model', 'level');
	}

	public function index()
	{
		$data['petugas'] = $this->petugas->index();

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('petugas/index', $data);
		$this->load->view('templates/footer');
	}

	public function Create()
	{

		$data['level'] = $this->level->index();

		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('petugas/create', $data);
		$this->load->view('templates/footer');
	}

	public function CreateAction()
	{
		$this->load->library('form_validation');

		// Validation rules
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
		$this->form_validation->set_rules('id_level', 'Level', 'required', [
			'required' => 'Level harus dipilih.'
		]);

		if ($this->form_validation->run() == FALSE) {
			// Validation failed, reload the form with the data
			$data['level'] = $this->level->index();


			$this->load->view('templates/header');
			$this->load->view('templates/sidebar');
			$this->load->view('petugas/create', $data);
			$this->load->view('templates/footer');
		} else {
			// If validation passed, process the form data
			$username = $this->input->post('username');
			$nama = $this->input->post('nama_petugas');
			$password = $this->input->post('password');
			$level = $this->input->post('id_level');
			$foto = $_FILES['foto'];

			if ($foto != '') {
				$config['upload_path'] = './assets/img';
				$config['allowed_types'] = 'jpg|png|gif';
				$this->upload->initialize($config);

				if (!$this->upload->do_upload('foto')) {
					// Handle upload error
					echo "Upload Gagal";
					die();
				} else {
					$foto = $this->upload->data('file_name');
				}
			}

			$hashed_password = password_hash($password, PASSWORD_BCRYPT);

			$data = array(
				'username' => $username,
				'password' => $hashed_password,
				'nama_petugas' => $nama,
				'id_level' => $level,
				'foto' => $foto
			);

			$this->petugas->create($data);
			$this->session->set_flashdata('success', 'Data berhasil ditambahkan.');
			redirect('PetugasController/index');
		}
	}

	public function print()
	{
		$data['petugas'] = $this->petugas->index('petugas');

		$this->load->view('petugas/print', $data);
	}

	public function Edit($id_petugas)
	{
		// Ambil data petugas berdasarkan ID
		$data['petugas'] = $this->petugas->getById($id_petugas);

		// Jika data tidak ditemukan, tampilkan pesan error
		if (!$data['petugas']) {
			$this->session->set_flashdata('error', 'Data petugas tidak ditemukan.');
			redirect('PetugasController/index');
		}

		// Ambil data level untuk dropdown
		$data['level'] = $this->level->index();

		// Load view untuk form edit
		$this->load->view('templates/header');
		$this->load->view('templates/sidebar');
		$this->load->view('petugas/edit', $data);
		$this->load->view('templates/footer');
	}

	public function UpdateAction()
	{
		$this->load->library('form_validation');

		// Validation rules
		$this->form_validation->set_rules('username', 'Username', 'required', [
			'required' => 'Username harus diisi.'
		]);
		$this->form_validation->set_rules('nama_petugas', 'Nama', 'required', [
			'required' => 'Nama harus diisi.'
		]);
		$this->form_validation->set_rules('id_level', 'Level', 'required', [
			'required' => 'Level harus dipilih.'
		]);

		// Jika password diisi, tambahkan validasi untuk password
		$password = $this->input->post('password');
		if (!empty($password)) {
			$this->form_validation->set_rules('password', 'Password', 'min_length[8]', [
				'min_length' => 'Password minimal 8 karakter.'
			]);
		}

		// Jalankan validasi
		if ($this->form_validation->run() == FALSE) {
			// Jika validasi gagal, kembalikan ke halaman edit
			$id_petugas = $this->input->post('id_petugas');
			$this->session->set_flashdata('error', 'Periksa kembali input Anda.');
			redirect("PetugasController/Edit/$id_petugas");
		} else {
			// Jika validasi berhasil, proses update data
			$id_petugas = $this->input->post('id_petugas');
			$username = $this->input->post('username');
			$nama = $this->input->post('nama_petugas');
			$level = $this->input->post('id_level');
			$foto = $_FILES['foto'];

			// Hash password jika ada perubahan
			$hashed_password = null;
			if (!empty($password)) {
				$hashed_password = password_hash($password, PASSWORD_BCRYPT);
			}

			// Persiapkan data untuk update
			$data = [
				'username' => $username,
				'nama_petugas' => $nama,
				'id_level' => $level
			];

			// Tambahkan password jika ada perubahan
			if ($hashed_password) {
				$data['password'] = $hashed_password;
			}

			// Handle upload foto jika ada file baru
			if ($foto['name'] != '') {
				$config['upload_path'] = './assets/img';
				$config['allowed_types'] = 'jpg|png|jpeg|gif';
				$config['max_size'] = 2048; // 2MB
				$config['encrypt_name'] = TRUE;

				$this->load->library('upload', $config);

				if (!$this->upload->do_upload('foto')) {
					// Handle upload error
					$error = $this->upload->display_errors();
					$this->session->set_flashdata('error', $error);
					redirect("PetugasController/Edit/$id_petugas");
				} else {
					// Jika upload berhasil, ambil nama file baru
					$new_foto = $this->upload->data('file_name');

					// Hapus foto lama jika ada
					$old_foto = $this->petugas->getById($id_petugas)['foto'];
					if ($old_foto && file_exists(FCPATH . 'assets/img/' . $old_foto)) {
						unlink(FCPATH . 'assets/img/' . $old_foto);
					}

					// Tambahkan foto baru ke data
					$data['foto'] = $new_foto;
				}
			}

			// Update data di database
			$this->petugas->update($id_petugas, $data);

			// Set flashdata dan redirect
			$this->session->set_flashdata('success', 'Data berhasil diperbarui.');
			redirect('PetugasController/index');
		}
	}

	public function deletePetugas($id_petugas)
	{
		// Validasi jika id tidak valid
		if (!$id_petugas || !is_numeric($id_petugas)) {
			$this->session->set_flashdata('error', 'ID Petugas tidak valid.');
			redirect('PetugasController/index');
		}

		// Check jika data petugas ditemukan
		$petugas = $this->petugas->getById($id_petugas); // Gunakan alias yang benar
		if (!$petugas) {
			$this->session->set_flashdata('error', 'Data petugas tidak ditemukan.');
			redirect('PetugasController/index');
		}

		// Hapus foto lama jika ada
		if ($petugas['foto'] && file_exists(FCPATH . 'assets/img/' . $petugas['foto'])) {
			unlink(FCPATH . 'assets/img/' . $petugas['foto']);
		}

		// Process delete data
		$delete = $this->petugas->deleteDataPetugas($id_petugas);

		if ($delete) {
			$this->session->set_flashdata('success', 'Data berhasil dihapus.');
		} else {
			$this->session->set_flashdata('error', 'Gagal menghapus data.');
		}

		redirect('PetugasController/index');
	}
}


/* End of file PetugasController.php */
/* Location: ./application/controllers/PetugasController.php */
