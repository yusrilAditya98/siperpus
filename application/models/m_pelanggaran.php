<?php
defined('BASEPATH') or exit('No direct script access allowed');


class M_pelanggaran extends CI_Model
{
    public function getPelanggaran($id_pelanggaran = null)
    {
        $this->db->select('*');
        $this->db->from('pelanggaran');

        if ($id_pelanggaran) {
            $this->db->where('id_pelanggaran', $id_pelanggaran);
            return $this->db->get()->row_array();
        }
        return $this->db->get()->result_array();
    }

    public function insertPelanggaran()
    {
        $nama_pelanggaran = $this->input->post('nama_pelanggaran');
        $this->db->set('nama_pelanggaran', $nama_pelanggaran);
        $this->db->insert('pelanggaran');
    }

    public function editPelanggaran($id)
    {
        $nama_pelanggaran = $this->input->post('nama_pelanggaran');
        $this->db->set('nama_pelanggaran', $nama_pelanggaran);
        $this->db->where('id_pelanggaran', $id);
        $this->db->update('pelanggaran');
    }
}
