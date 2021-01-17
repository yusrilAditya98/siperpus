<?php
defined('BASEPATH') or exit('No direct script access allowed');


class M_lama_peminjaman extends CI_Model
{
    public function getData($durasi_peminjaman = null, $status_peminjaman = null)
    {
        $this->db->select('*');
        $this->db->from('lama_peminjaman');
        if ($durasi_peminjaman != null || $status_peminjaman = null) {
            $this->db->where('durasi_peminjaman', $durasi_peminjaman);
            $this->db->where('status_peminjaman', $status_peminjaman);
        }
        return $this->db->get()->result_array();
    }

    public function insertData()
    {
        $data =  [
            'durasi_peminjaman' => $this->input->post('durasi_peminjaman'),
            'status_peminjaman' => $this->input->post('status_peminjaman'),
        ];
        $this->db->insert('lama_peminjaman', $data);
        return true;
    }
    public function updateData($id_lama_peminjaman)
    {
        $data =  [
            'durasi_peminjaman' => $this->input->post('durasi_peminjaman'),
            'status_peminjaman' => $this->input->post('status_peminjaman'),
        ];

        $this->db->update('lama_peminjaman', $data, ['id_lama_peminjaman' => $id_lama_peminjaman]);
        return true;
    }

    public function deleteData($id_lama_peminjaman)
    {
        $this->db->delete('lama_peminjaman', ['id_lama_peminjaman' => $id_lama_peminjaman]);
        return true;
    }
}
