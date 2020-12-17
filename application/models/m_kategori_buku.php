<?php
defined('BASEPATH') or exit('No direct script access allowed');


class M_kategori_buku extends CI_Model
{
    public function getData($nama_kategori = null)
    {
        $this->db->select('*');
        $this->db->from('kategori');
        if ($nama_kategori != null) {
            $this->db->where('nama_kategori', $nama_kategori);
        }
        return $this->db->get()->result_array();
    }

    public function insertData()
    {
        $data =  [
            'nama_kategori' => $this->input->post('nama_kategori'),
        ];
        $this->db->insert('kategori', $data);
        return true;
    }
    public function updateData($id_kategori)
    {
        $data =  [
            'nama_kategori' => $this->input->post('nama_kategori'),
        ];

        $this->db->update('kategori', $data, ['id_kategori' => $id_kategori]);
        return true;
    }

    public function deleteData($id_kategori)
    {
        $this->db->delete('kategori', ['id_kategori' => $id_kategori]);
        return true;
    }
}
