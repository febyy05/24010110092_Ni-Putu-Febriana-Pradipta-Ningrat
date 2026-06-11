<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FakultasModel extends CI_Model {

    public function getAll()
    {
        return $this->db->get('fakultas')->result_array();
    }

    public function getById($id)
    {
        return $this->db->get_where('fakultas', [
            'fakultas_id' => $idFakultas
        ])->row_array();
    }

    public function insert($data)
    {
        return $this->db->insert('fakultas', $data);
    }

    public function update($idFakultas, $data)
    {
        $this->db->where('fakultas_id', $idFakultas);
        return $this->db->update('fakultas', $data);
    }

    public function delete($idFakultas)
    {
        $this->db->where('fakultas_id', $idFakultas);
        return $this->db->delete('fakultas');
    }

}