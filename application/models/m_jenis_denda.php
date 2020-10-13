<?php
defined('BASEPATH') or exit('No direct script access allowed');


class m_jenis_denda extends CI_Model
{
    public function getData($nama_denda = null)
    {
        $this->db->select('*');
        $this->db->from('denda');
        if ($nama_denda != null) {
            $this->db->where('nama_denda', $nama_denda);
        }
        return $this->db->get()->result_array();
    }

    public function insertData()
    {
        $data =  [
            'nama_denda' => $this->input->post('nama_denda'),
        ];
        $this->db->insert('denda', $data);
        return true;
    }
    public function updateData($id_denda)
    {
        $data =  [
            'nama_denda' => $this->input->post('nama_denda'),
        ];

        $this->db->update('denda', $data, ['id_denda' => $id_denda]);
        return true;
    }

    public function deleteData($id_denda)
    {
        $this->db->delete('denda', ['id_denda' => $id_denda]);
        return true;
    }
}
