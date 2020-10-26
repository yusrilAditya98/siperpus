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

    public function getListPelanggaran($status_pelanggaran = null, $nama_pelanggaran = null, $denda = null)
    {

        $this->db->select('*');
        $this->db->from('sirkulasi');
        $this->db->join('buku', 'buku.register = sirkulasi.b_register', 'left');
        $this->db->join('user', 'user.username = sirkulasi.u_username', 'left');
        $this->db->join('sirkulasi_pelanggaran', 'sirkulasi_pelanggaran.s_id_sirkulasi = sirkulasi.id_sirkulasi', 'left');
        $this->db->join('pelanggaran', 'sirkulasi_pelanggaran.p_id_pelanggaran = pelanggaran.id_pelanggaran', 'left');
        $this->db->join('denda', 'sirkulasi_pelanggaran.d_id_denda = denda.id_denda', 'left');
        $this->db->where(['jenis_sirkulasi' => 1]);
        $this->db->where_in('status_sirkulasi', [6]);
        if ($this->session->userdata('role_id') != 'role_id_1') {
            $this->db->where('sirkulasi.u_username', $this->session->userdata('username'));
        }
        if ($status_pelanggaran != null) {
            $this->db->where('sirkulasi_pelanggaran.status_pelanggaran', $status_pelanggaran);
        }
        if ($nama_pelanggaran != null) {
            $this->db->where('sirkulasi_pelanggaran.p_id_pelanggaran', $nama_pelanggaran);
        }
        if ($denda != null) {
            $this->db->where('sirkulasi_pelanggaran.d_id_denda', $denda);
        }
        return $this->db->get()->result_array();
    }
}
