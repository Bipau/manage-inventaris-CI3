<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Model Petugas_model
 *
 * This Model for ...
 * 
 * @package		CodeIgniter
 * @category	Model
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @link      https://github.com/setdjod/myci-extension/
 * @param     ...
 * @return    ...
 *
 */

class Petugas_model extends CI_Model
{

	// ------------------------------------------------------------------------


	// ------------------------------------------------------------------------


	// ------------------------------------------------------------------------
	public function index()
	{

		$this->db->select('petugas.*, level.nama_level');

		$this->db->join('level', 'petugas.id_level = level.id_level');


		$data =  $this->db->get('petugas')->result_array();

		return $data;
	}

	public function create($data)
	{
		$this->db->insert('petugas', $data);
	}

	public function getById($id_petugas)
	{
		return $this->db->get_where('petugas', ['id_petugas' => $id_petugas])->row_array();
	}
	public function update($id_petugas, $data)
	{
		$this->db->where('id_petugas', $id_petugas);
		$this->db->update('petugas', $data);
	}

	public function deleteDataPetugas($id_petugas)
	{
		return $this->db->delete('petugas', ['id_petugas' => $id_petugas]);
	}

	// ------------------------------------------------------------------------

}

/* End of file Petugas_model.php */
/* Location: ./application/models/Petugas_model.php */
