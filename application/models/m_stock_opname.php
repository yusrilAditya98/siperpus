<?php
defined('BASEPATH') or exit('No direct script access allowed');


class M_stock_opname extends CI_Model
{
    public function getStock($id_stock_opname = null)
    {
        $this->db->select('*');
        $this->db->from('stock_opname');
        if ($id_stock_opname != null) {
            $this->db->where('stock_opname.id_stock_opname', $id_stock_opname);
            return $this->db->get()->row();
        }
        return $this->db->get()->result_array();
    }
}
