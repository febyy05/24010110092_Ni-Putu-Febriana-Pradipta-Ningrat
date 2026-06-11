<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProdiModel extends CI_Model {

    public function getAll()
    {
        $this->db->select('prodi.*, fakultas.fakultas_name');
        $this->db->from('prodi');
        $this->db->join('fakultas', 'fakultas.fakultas_id = prodi.fakultas_id');

        return $this->db->get()->result_array();
    }

    public function getById($idProdi)
    {
        return $this->db->get_where('prodi', [
            'prodi_id' => $idProdi
        ])->row_array();
    }

    public function getFakultas()
    {
        return $this->db->get('fakultas')->result_array();
    }

    public function insert($dataView)
    {
        return $this->db->insert('prodi', $dataView);
    }

    public function update($idProdi, $dataView)
    {
        $this->db->where('prodi_id', $idProdi);
        return $this->db->update('prodi', $dataView);
    }

    public function delete($idProdi)
    {
        $this->db->where('prodi_id', $idProdi);
        return $this->db->delete('prodi');
    }
}