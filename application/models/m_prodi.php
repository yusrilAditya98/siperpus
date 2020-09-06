<?php
defined('BASEPATH') or exit('No direct script access allowed');


class M_prodi extends CI_Model
{
    public function getProdi($id_prodi = null)
    {
        $this->db->select('*');
        $this->db->from('prodi');
        if ($id_prodi != null) {
            $this->db->where('prodi.id_prodi', $id_prodi);
            return $this->db->get()->row();
        }
        return $this->db->get()->result_array();
    }
}
