<?php
defined('BASEPATH') or exit('No direct script access allowed');


class m_sumber_koleksi extends CI_Model
{
    public function getData($nama_sumber = null)
    {
        $this->db->select('*');
        $this->db->from('sumber_koleksi');
        if ($nama_sumber != null) {
            $this->db->where('sumber_koleksi.nama_sumber', $nama_sumber);
            return $this->db->get()->row_array();
        }
        return $this->db->get()->result_array();
    }

    public function insertData()
    {
        $data =  [
            'nama_sumber' => $this->input->post('nama_sumber'),
        ];
        $this->db->insert('sumber_koleksi', $data);
        return true;
    }
    public function updateData($id_sumber)
    {
        $data =  [
            'nama_sumber' => $this->input->post('nama_sumber'),
        ];

        $this->db->update('sumber_koleksi', $data, ['id_sumber' => $id_sumber]);
        return true;
    }

    public function deleteData($id_sumber)
    {
        $this->db->delete('sumber_koleksi', ['id_sumber' => $id_sumber]);
        return true;
    }
}
