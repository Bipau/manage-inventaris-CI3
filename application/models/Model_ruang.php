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

class Model_ruang extends CI_Model
{


	private $table = 'ruang';

	// ------------------------------------------------------------------------
	public function index()
	{
		return $this->db->get($this->table)->result_array();
	}

	public function create($data)
	{
		$this->db->insert('ruang', $data);
	}

	public function update($data)
    {
        $this->db->where('id_ruang', $data['id_ruang']);
        $this->db->update('ruang', [
            'nama_ruang' => $data['nama_ruang'],
            'kode_ruang' => $data['kode_ruang'],
            'keterangan' => $data['keterangan']
        ]);
        
    }

	
	public function getById($id_ruang)
	{
		return $this->db->get_where('ruang', ['id_ruang' => $id_ruang])->row_array();
	}
	

	public function DeleteDataRuang($id_ruang)
	{
		return $this->db->delete('ruang', ['id_ruang' => $id_ruang]);
	}
	// ------------------------------------------------------------------------

}

/* End of file ruang_model.php */
/* Location: ./application/models/ruang_model.php */
