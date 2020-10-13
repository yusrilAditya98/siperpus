<?php
defined('BASEPATH') or exit('No direct script access allowed');


class m_status_buku extends CI_Model
{
    public function getData($id_status = null)
    {
        $this->db->select('*');
        $this->db->from('status_buku');
        if ($id_status != null) {
            $this->db->where('status_buku.id_status', $id_status);
        }
        return $this->db->get()->result_array();
    }

    public function insertData()
    {
        $data =  [
            'nama_status' => $this->input->post('nama_status'),
        ];
        $this->db->insert('status_buku', $data);
        return true;
    }
    public function updateData($id_status)
    {
        $data =  [
            'nama_status' => $this->input->post('nama_status'),
        ];

        $this->db->update('status_buku', $data, ['id_status' => $id_status]);
        return true;
    }

    public function deleteData($id_status)
    {
        $this->db->delete('status_buku', ['id_status' => $id_status]);
        return true;
    }
}
