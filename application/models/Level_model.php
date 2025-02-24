<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Model Level_model
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

class Level_model extends CI_Model
{


	private $table = 'level';

	// ------------------------------------------------------------------------
	public function index()
	{
		return $this->db->get($this->table)->result_array();
	}

	public function create($data)
	{
		$this->db->insert('level', $data);
	}
	public function update($data)
	{
		$this->db->where('id_level', $data['id_level']);
		return $this->db->update('level', ['nama_level' => $data['nama_level']]);
	}

	
	public function getById($id_level)
	{
		return $this->db->get_where('level', ['id_level' => $id_level])->row_array();
	}
	

	public function deleteDataLevel($id_level)
	{
		return $this->db->delete('level', ['id_level' => $id_level]);
	}
	// ------------------------------------------------------------------------

}

/* End of file Level_model.php */
/* Location: ./application/models/Level_model.php */
