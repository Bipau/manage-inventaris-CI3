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

class Jenis_model extends CI_Model
{


	private $table = 'jenis';

	// ------------------------------------------------------------------------
	public function index()
	{
		return $this->db->get($this->table)->result_array();
	}

	public function create($data)
	{
		$this->db->insert('jenis', $data);
	}

    public function update($data)
    {
        $this->db->where('id_jenis', $data['id_jenis']);
        $this->db->update('jenis', [
            'nama_jenis' => $data['nama_jenis'],
            'kode_jenis' => $data['kode_jenis'],
            'keterangan' => $data['keterangan']
        ]);
        
    }
    
    
	
	public function getById($id_jenis)
	{
		return $this->db->get_where('jenis', ['id_jenis' => $id_jenis])->row_array();
	}
	

	public function deleteDataJenis($id_jenis)
	{
		return $this->db->delete('jenis', ['id_jenis' => $id_jenis]);
	}
	// ------------------------------------------------------------------------

}

/* End of file Jennis_model.php */
/* Location: ./application/models/Jenis_model.php */
