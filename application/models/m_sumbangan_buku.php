<?php
defined('BASEPATH') or exit('No direct script access allowed');


class m_sumbangan_buku extends CI_Model
{
    public function getData($where = "")
    {
        $data = $this->db->query('select * from sumbangan_buku ' . $where);
        return $data->result_array();
    }

    public function insertData()
    {
        $data =  [
            'u_username' => $this->input->post('u_username'),
            'b_register' => $this->input->post('b_register'),
            'status_sumbangan' => $this->input->post('status_sumbangan'),
        ];
        $this->db->insert('sumbangan_buku', $data);
        return true;
    }
    public function updateData()
    {
        $id_sumbangan = $this->input->post('id_sumbangan');
        $data =  [
            'u_username' => $this->input->post('u_username'),
            'b_register' => $this->input->post('b_register'),
            'status_sumbangan' => $this->input->post('status_sumbangan'),
        ];

        $this->db->update('sumbangan_buku', $data, ['id_sumbangan' => $id_sumbangan]);
        return true;
    }

    public function deleteData($id_sumbangan)
    {
        $this->db->delete('sumbangan_buku', ['id_sumbangan' => $id_sumbangan]);
        return true;
    }
}
