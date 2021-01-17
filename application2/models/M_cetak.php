<?php
defined('BASEPATH') or exit('No direct script access allowed');


class M_cetak extends CI_Model
{
    var $column_order = array(null, 'c.b_register', 'b.judul_buku', 'b.pengarang', null);
    //set column field database for datatable orderable
    var $column_search = array('c.b_register', 'b.judul_buku', 'b.pengarang');
    //set column field database for datatable searchable
    var $order_cetak = array('c.id_cetak' => 'asc'); // default order 

    private function _get_datatables_query($keywords = null, $filter = null)
    {
        // $this->db->select('*');
        $this->db->select('c.*, b.register, b.judul_buku, b.pengarang');
        $this->db->from('cetak as c');
        $this->db->join('buku as b', 'b.register = c.b_register', 'left');
        $this->db->where('c.status', 0);
        if ($keywords != null && $filter != null) {
            $this->db->like($filter, $keywords);
        }
        $i = 0;
        foreach ($this->column_search as $item) { // loop column 
            if (@$_POST['search']['value']) { // if datatable send POST for search
                if ($i === 0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) { // here order processing
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order_cetak = $this->order;
            $this->db->order_by(key($order_cetak), $order_cetak[key($order_cetak)]);
        }
    }


    function get_datatables($keywords = null, $filter = null)
    {
        if ($keywords != null && $filter != null) {
            $this->_get_datatables_query($keywords, $filter);
        } else {
            $this->_get_datatables_query();
        }
        if (@$_POST['length'] != -1)
            $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered($keywords = null, $filter = null)
    {
        if ($keywords != null && $filter != null) {
            $this->_get_datatables_query($keywords, $filter);
        } else {
            $this->_get_datatables_query();
        }
        $query = $this->db->get();
        return $query->num_rows();
    }
    function count_all($keywords = null, $filter = null)
    {
        $this->db->from('cetak');
        $this->db->where('status', 0);
        if ($keywords != null && $filter != null) {
            $this->db->like($filter, $keywords);
        }
        return $this->db->count_all_results();
    }

    var $column_order2 = array(null, 'u.username', 'u.nama', null, null, null);
    //set column field database for datatable orderable
    var $column_search2 = array('u.username', 'u.nama');
    //set column field database for datatable searchable
    var $order_mhs = array('u.username' => 'asc'); // default order 

    private function _get_datatables_query2($keywords = null, $filter = null)
    {
        $this->db->select('u.*');
        $this->db->from('user as u');

        if ($keywords != null && $filter != null) {
            $this->db->like($filter, $keywords);
        }
        $this->db->where('status_aktif', 1);
        $this->db->where('ru_role_id', 2);

        $i = 0;
        foreach ($this->column_search2 as $item) { // loop column 
            if (@$_POST['search']['value']) { // if datatable send POST for search
                if ($i === 0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search2) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) { // here order processing
            $this->db->order_by($this->column_order2[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order_mhs = $this->order;
            $this->db->order_by(key($order_mhs), $order_mhs[key($order_mhs)]);
        }
    }

    function get_datatables2($keywords = null, $filter = null)
    {
        if ($keywords != null && $filter != null) {
            $this->_get_datatables_query2($keywords, $filter);
        } else {
            $this->_get_datatables_query2();
        }
        if (@$_POST['length'] != -1)
            $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered2($keywords = null, $filter = null)
    {
        if ($keywords != null && $filter != null) {
            $this->_get_datatables_query2($keywords, $filter);
        } else {
            $this->_get_datatables_query2();
        }
        $query = $this->db->get();
        return $query->num_rows();
    }
    function count_all2($keywords = null, $filter = null)
    {
        $this->db->from('user');
        $this->db->where('status_aktif', 1);
        $this->db->where('ru_role_id', 2);

        if ($keywords != null && $filter != null) {
            $this->db->like($filter, $keywords);
        }
        return $this->db->count_all_results();
    }



    public function getData($id_cetak = null)
    {
        $this->db->select('*');
        $this->db->from('cetak');
        if ($id_cetak != null) {
            $this->db->where('id_cetak', $id_cetak);
        }
        return $this->db->get()->result_array();
    }

    public function getDataSirkulasi($id_sirkulasi = null, $u_username = null)
    {
        $this->db->select('*');
        $this->db->from('sirkulasi as s');
        if ($id_sirkulasi != null) {
            $this->db->where('id_sirkulasi', $id_sirkulasi);
        }
        if ($u_username != null) {
            $this->db->where('u_username', $u_username);
        }
        return $this->db->get()->result_array();
    }
    public function getDataSirkulasiPelanggaran($s_id_sirkulasi = null)
    {
        $this->db->select('*');
        $this->db->from('sirkulasi_pelanggaran');
        if ($s_id_sirkulasi != null) {
            $this->db->where('s_id_sirkulasi', $s_id_sirkulasi);
        }
        return $this->db->get()->result_array();
    }

    public function insertData()
    {
        $data =  [
            'b_register' => $this->input->post('register'),
        ];
        $this->db->insert('cetak', $data);
        return true;
    }
    public function updateData($data, $id_cetak)
    {
        $this->db->update('cetak', $data, ['id_cetak' => $id_cetak]);
        return true;
    }

    public function deleteData($id_cetak)
    {
        $this->db->delete('cetak', ['id_cetak' => $id_cetak]);
        return true;
    }

    public function getUser($username = null, $role_id = null)
    {
        $this->db->select('u.*, b.nama_prodi');
        $this->db->from('user as u');
        $this->db->join('prodi as b', 'b.id_prodi=u.p_id_prodi', 'left');
        if ($username != null) {
            $this->db->where('u.username', $username);
            return $this->db->get()->row_array();
        }
        if ($role_id != null) {
            $this->db->where('u.ru_role_id', $role_id);
        }
        return $this->db->get()->result_array();
    }
}
