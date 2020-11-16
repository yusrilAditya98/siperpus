<?php
defined('BASEPATH') or exit('No direct script access allowed');


class m_recall extends CI_Model
{
    var $column_order = array(null, 's.no_transaksi', 'b.register','b.judul_buku', 'u.nama', 'r.status_recall', 'r.keterangan', null);
    //set column field database for datatable orderable
    var $column_search = array('s.no_transaksi', 'b.register','b.judul_buku', 'u.nama', 'r.status_recall', 'r.keterangan');
    //set column field database for datatable searchable
    var $order_recall = array('r.id_recall' => 'asc'); // default order 

    private function _get_datatables_query($keywords = null, $filter = null)
    {
        $this->db->select('r.*, s.no_transaksi, b.register, b.judul_buku, u.nama');
        $this->db->from('recall as r');
        $this->db->join('sirkulasi as s', 's.id_sirkulasi = r.id_sirkulasi', 'left');
        $this->db->join('buku as b', 'b.register = s.b_register', 'left');
        $this->db->join('user as u', 'u.username = s.u_username', 'left');
        $this->db->where_in('s.status_sirkulasi', [4, 9]);
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
            $order_recall = $this->order;
            $this->db->order_by(key($order_recall), $order_recall[key($order_recall)]);
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
        $this->db->from('recall');
        if ($keywords != null && $filter != null) {
            $this->db->like($filter, $keywords);
        }
        return $this->db->count_all_results();
    }

    var $column_order2 = array(null, 's.no_transaksi', 's.register', 'b.judul', 'u.nama', null, null);
    //set column field database for datatable orderable
    var $column_search2 = array('s.no_transaksi', 's.register', 'b.judul', 'u.nama');
    //set column field database for datatable searchable
    var $order_mhs = array('s.id_sirkulasi' => 'asc'); // default order 

    private function _get_datatables_query2($keywords = null, $filter = null)
    {
        $this->db->select('s.*, b.register, b.judul_buku, u.nama');
        $this->db->from('sirkulasi as s');
        $this->db->join('buku as b', 'b.register = s.b_register', 'left');
        $this->db->join('user as u', 'u.username = s.u_username', 'left');
        $this->db->where_in('s.status_sirkulasi', [4, 9]);

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
        $this->db->from('sirkulasi as s');
        $this->db->where_in('s.status_sirkulasi', [4, 9]);

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

    public function insertData($id_sirkulasi)
    {
        $data =  [
            'status_recall' => 0,
            'keterangan' => '',
            'id_sirkulasi' => $id_sirkulasi,
        ];
        $this->db->insert('recall', $data);
        $this->db->update('sirkulasi', ['status_recall' => 1], ['id_sirkulasi' => $id_sirkulasi]);
        return true;
    }
    // Update Data Recall
    public function updateDataRecall($id_recall)
    {
        $data['keterangan'] = $this->input->post('keterangan');
        $data['status_recall'] = $this->input->post('status');
        $this->db->update('recall', $data, ['id_recall' => $id_recall]);
        return true;
    }

    public function deleteDataRecall($id_recall)
    {
        $this->db->delete('recall', ['id_recall' => $id_recall]);
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
