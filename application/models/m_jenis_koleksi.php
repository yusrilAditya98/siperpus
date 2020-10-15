<?php
defined('BASEPATH') or exit('No direct script access allowed');


class m_jenis_koleksi extends CI_Model
{

    public function getData($id_jenis = null)
    {
        $this->db->select('*');
        $this->db->from('jenis_koleksi');
        if ($id_jenis) {
            $this->db->where('id_jenis', $id_jenis);
            return $this->db->get()->row_array();
        }
        return $this->db->get()->result_array();
    }

    public function insertData()
    {
        $data =  [
            'nama_jenis' => $this->input->post('nama_jenis'),
        ];
        $this->db->insert('jenis_koleksi', $data);
        return true;
    }
    public function updateData($id_jenis)
    {
        $data =  [
            'nama_jenis' => $this->input->post('nama_jenis'),
        ];

        $this->db->update('jenis_koleksi', $data, ['id_jenis' => $id_jenis]);
        return true;
    }

    public function deleteData($id_jenis)
    {
        $this->db->delete('jenis_koleksi', ['id_jenis' => $id_jenis]);
        return true;
    }
}
