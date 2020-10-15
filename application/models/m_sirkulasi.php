<?php
defined('BASEPATH') or exit('No direct script access allowed');


class M_sirkulasi extends CI_Model
{

    // start datatables
    var $column_order = array(null, 's.tanggal_sirkulasi', 's.u_username', 'u.nama', 'b.register', 'b.judul_buku', 'b.penerbit', 'b.pengarang');
    //set column field database for datatable orderable
    var $column_search = array('s.b_register', 'b.judul_buku', 'b.pengarang', 'b.penerbit', 'u.nama', 's.u_username');
    //set column field database for datatable searchable
    var $order = array('s.tanggal_sirkulasi' => 'desc'); // default order 

    private function _get_datatables_query($keywords = null, $filter = null)
    {
        $this->db->select('b.*,s.*,u.nama');
        $this->db->from('sirkulasi as s');
        $this->db->join('buku as b', 's.b_register=b.register', 'left');
        $this->db->join('user as u', 's.u_username=u.username', 'left');
        $this->db->where('s.jenis_sirkulasi', 2);
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
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
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
        $this->db->from('buku');
        if ($keywords != null && $filter != null) {
            $this->db->like($filter, $keywords);
        }
        return $this->db->count_all_results();
    }
    // end datatables


    public function insertBacaDitempat($data)
    {
        $result = [];
        $cekUser = $this->db->get_where('user', ['username' => $data['username']])->data_seek();

        if ($cekUser) {
            $buku = $this->db->get_where('buku', ['register' => $data['register']])->row_array();
            if ($buku != null) {
                $sirkulasi = [
                    'u_username' => $data['username'],
                    'b_register' =>  $data['register'],
                    'jenis_sirkulasi' => 2,
                    'tanggal_sirkulasi' => date('Y-m-d'),
                    'status_sirkulasi' => 8,
                ];
                $this->db->insert('sirkulasi', $sirkulasi);
                $result = [
                    'message' =>  $buku,
                    'status' => true
                ];
                return $result;
            } else {
                $result = [
                    'message' => 'buku tidak ditemukan',
                    'status' => false
                ];
                return $result;
            }
        } else {
            $result = [
                'message' => 'username tidak ditemukan',
                'status' => false
            ];
            return $result;
        }
    }

    public function listBukuBaca($username = null, $kategori = null)
    {

        $this->db->select('*');
        $this->db->from('sirkulasi as s');
        $this->db->join('buku as b', 'b.register=s.b_register', 'left');
        if ($username) {
            $this->db->where('s.u_username', $username);
        }

        if ($kategori == 'terkini') {
            $this->db->where_in('s.status_sirkulasi', 0);
        } else {
            $this->db->where_in('s.status_sirkulasi', 1);
            $this->db->or_where_in('s.status_sirkulasi', 2);
            $this->db->or_where_in('s.status_sirkulasi', 3);
            $this->db->or_where_in('s.status_sirkulasi', 8);
        }
        return $this->db->get()->result_array();
    }
}
