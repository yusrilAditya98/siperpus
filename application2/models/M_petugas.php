<?php
defined('BASEPATH') or exit('No direct script access allowed');


class M_petugas extends CI_Model
{
    public function getData($id = null, $status = null)
    {
        $this->db->select('*');
        $this->db->from('petugas');
        if ($id != null) {
            $this->db->where('id', $id);
        }
        if ($status != null) {
            $this->db->where('status', $status);
        }
        return $this->db->get()->result_array();
    }

    public function insertData()
    {
        $data =  [
            'nama' => $this->input->post('nama'),
            'jenis_no_induk' => $this->input->post('jenis_no_induk'),
            'no_induk' => $this->input->post('no_induk'),
            'status' => $this->input->post('status'),
        ];
        $this->db->insert('petugas', $data);
        return true;
    }
    public function updateData($id)
    {
        $data =  [
            'nama' => $this->input->post('nama'),
            'jenis_no_induk' => $this->input->post('jenis_no_induk'),
            'no_induk' => $this->input->post('no_induk'),
            'status' => $this->input->post('status'),
        ];

        $this->db->update('petugas', $data, ['id' => $id]);
        return true;
    }

    public function deleteData($id)
    {
        $this->db->delete('petugas', ['id' => $id]);
        return true;
    }
}
