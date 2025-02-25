<?php

class PegawaiModel extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getAllPegawai()
    {
        return $this->db->get('pegawai')->result_array();
    }

    public function insertPegawai($data)
    {
        return $this->db->insert('pegawai', $data);
    }

    public function deletePegawai($where, $table)
    {
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function updatePegawai($id, $form)
    {
        $this->db->where('id_pegawai', $id);
        $this->db->update('pegawai', $form);
    }
}