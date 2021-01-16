<?php
defined('BASEPATH') or exit('No direct script access allowed');


class M_stock_opname extends CI_Model
{
    public function getData($id_opname = null)
    {
        $this->db->select('*,u.nama');
        $this->db->from('opname');
        $this->db->join('user as u', 'opname.pj_entry_opname = u.username', 'left');
        if ($id_opname != null) {
            $this->db->where('opname.id_opname', $id_opname);
            return $this->db->get()->row();
        }
        return $this->db->get()->result_array();
    }

    public function getDataOpname($id_buku_opname = null, $o_id_opname = null)
    {
        $this->db->select('*');
        $this->db->from('buku_opname');
        if ($o_id_opname != null) {
            $this->db->where('o_id_opname', $o_id_opname);
        }
        if ($id_buku_opname != null) {
            $this->db->where('id_buku_opname', $id_buku_opname);
        }

        return $this->db->get()->result_array();
    }

    public function getDataLaporanOpname($id_opname = null, $start_date = null, $end_date = null)
    {
        $this->db->select('*');
        $this->db->from('opname');
        $this->db->join('buku_opname', 'buku_opname.o_id_opname = opname.id_opname', 'left');
        if ($id_opname != null) {
            $this->db->where('opname.id_opname', $id_opname);
            return $this->db->get()->row();
        }
        if ($start_date) {
            $this->db->where('opname.tanggal >=', $start_date);
        }
        if ($end_date) {
            $this->db->where('opname.tanggal <=', $end_date);
        }
        return $this->db->get()->result_array();
    }

    public function getRegisterOpname($where = "")
    {
        $data = $this->db->query('select b_register from buku_opname ' . $where);
        return $data->result_array();
    }

    public function getStockStatus($id_opname)
    {
        $this->db->select('b.*, j.nama_jenis, sb.nama_status');
        $this->db->from('buku as b');
        $this->db->join('jenis_akses as j', 'b.jenis_akses = j.id_jenis', 'left');
        $this->db->join('status_buku as sb', 'b.status_buku = sb.id_status', 'left');

        $temp = $this->getRegisterOpname(" where o_id_opname = '$id_opname'");
        $test = [];
        for ($i = 0; $i < count($temp); $i++) {
            $test[] = $temp[$i]['b_register'];
        }
        $this->db->where_in('register', $test);

        return $this->db->get()->result_array();
    }

    public function insertData()
    {
        $data =  [
            'tahun' => $this->input->post('tahun'),
            'tanggal' => $this->input->post('tanggal'),
            'keterangan' => $this->input->post('keterangan'),
            'pj_entry_opname' => $this->session->userdata('username')
        ];
        $this->db->insert('opname', $data);
        return true;
    }
    public function updateData($id_opname)
    {
        $data =  [
            'tahun' => $this->input->post('tahun'),
            'tanggal' => $this->input->post('tanggal'),
            'keterangan' => $this->input->post('keterangan'),
        ];

        $this->db->update('opname', $data, ['id_opname' => $id_opname]);
        return true;
    }

    public function deleteData($id_opname)
    {
        $this->db->delete('opname', ['id_opname' => $id_opname]);
        return true;
    }

    public function insertDataOpname($status, $akses)
    {
        $data =  [
            'o_id_opname' => $this->input->post('o_id_opname'),
            'b_register' => $this->input->post('b_register'),
            'status' => $status,
            'status_now' => $status,
            'akses' => $akses,
            'akses_now' => $akses,
        ];
        $this->db->insert('buku_opname', $data);
        return true;
    }

    public function updateDataOpnameStatus($register)
    {
        $data =  [
            'status_buku' => $this->input->post('status_buku'),
        ];
        $this->db->update('buku', $data, ['register' => $register]);

        $data =  [
            'status_now' => $this->input->post('status_buku'),
        ];
        $this->db->update('buku_opname', $data, ['id_buku_opname' => $this->input->post('id_buku_opname')]);
        return true;
    }

    public function updateDataOpnameAkses($register)
    {
        $data =  [
            'jenis_akses' => $this->input->post('jenis_akses'),
        ];
        $this->db->update('buku', $data, ['register' => $register]);

        $data =  [
            'akses_now' => $this->input->post('jenis_akses'),
        ];
        $this->db->update('buku_opname', $data, ['id_buku_opname' => $this->input->post('id_buku_opname')]);

        return true;
    }

    public function deleteDataOpname($id_buku_opname)
    {
        $this->db->delete('buku_opname', ['id_buku_opname' => $id_buku_opname]);
        return true;
    }

    // start datatables
    var $column_order_opname = array(null, 'b.register', 'b.judul_buku', 'b.pengarang', 'b.penerbit', 'b.tahun_terbit', 'sb.nama_status', null, 'j.nama_jenis', null, null);
    var $column_search_opname = array('b.register', 'b.judul_buku', 'b.pengarang', 'b.penerbit', 'b.tahun_terbit', 'sb.nama_status', 'j.nama_jenis');
    var $order_opname = array('o.id_buku_opname' => 'asc');

    private function _get_datatables_query_opname($id_opname)
    {
        $this->db->select('o.*, b.*, j.nama_jenis, sb.nama_status');
        $this->db->from('buku_opname as o');
        $this->db->join('buku as b', 'o.b_register = b.register', 'left');
        $this->db->join('jenis_akses as j', 'o.akses = j.id_jenis', 'left');
        $this->db->join('status_buku as sb', 'o.status = sb.id_status', 'left');
        $this->db->where('o.o_id_opname', $id_opname);
        $i = 0;
        foreach ($this->column_search_opname as $item) { // loop column 
            if (@$_POST['search']['value']) { // if datatable send POST for search
                if ($i === 0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search_opname) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if (isset($_POST['order'])) { // here order processing
            $this->db->order_by($this->column_order_opname[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order_opname = $this->order;
            $this->db->order_by(key($order_opname), $order_opname[key($order_opname)]);
        }
    }
    function get_datatables_opname($id_opname)
    {
        $this->_get_datatables_query_opname($id_opname);
        if (@$_POST['length'] != -1)
            $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered_opname($id_opname)
    {
        $this->_get_datatables_query_opname($id_opname);
        $query = $this->db->get();
        return $query->num_rows();
    }
    function count_all_opname($id_opname)
    {
        $this->db->from('buku_opname');
        $this->db->where('o_id_opname', $id_opname);
        return $this->db->count_all_results();
    }

    var $column_order = array(null, 'b.register', 'b.judul_buku', 'b.pengarang', 'b.penerbit', 'b.tahun_terbit', 'sb.nama_status', 'j.nama_jenis');
    var $column_search = array('b.register', 'b.judul_buku', 'b.pengarang', 'b.penerbit', 'b.tahun_terbit', 'sb.nama_status', 'j.nama_jenis');
    var $order = array('b.register' => 'asc');

    private function _get_datatables_query($id_opname = null)
    {
        $this->db->select('b.*, j.nama_jenis, sb.nama_status');
        $this->db->from('buku as b');
        $this->db->join('jenis_akses as j', 'b.jenis_akses = j.id_jenis', 'left');
        $this->db->join('status_buku as sb', 'b.status_buku = sb.id_status', 'left');

        $temp = $this->getRegisterOpname(" where o_id_opname = '$id_opname'");

        if ($temp != null) {
            $test = [];
            for ($i = 0; $i < count($temp); $i++) {
                $test[] = $temp[$i]['b_register'];
            }
            $this->db->where_not_in('register', $test);
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
    function get_datatables($id_opname)
    {
        $this->_get_datatables_query($id_opname);
        if (@$_POST['length'] != -1)
            $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered($id_opname)
    {
        $this->_get_datatables_query($id_opname);
        $query = $this->db->get();
        return $query->num_rows();
    }
    function count_all($id_opname)
    {
        $this->db->from('buku');
        $temp = $this->getRegisterOpname(" where o_id_opname = '$id_opname'");
        if ($temp != null) {
            $test = [];
            for ($i = 0; $i < count($temp); $i++) {
                $test[] = $temp[$i]['b_register'];
            }
            $this->db->where_not_in('register', $test);
        }
        return $this->db->count_all_results();
    }
    // end datatables

    public function getDataBuku($register = null)
    {
        // $data = $this->db->query('select * from buku ' . $where);
        // $this->db->select('*');
        // $this->db->from('buku');
        $this->db->select('b.*, k.nama_kategori, ba.nama_bahasa, c.nama_circ_type, f.nama_funding, sk.nama_sumber, j.nama_jenis');
        $this->db->from('buku as b');
        $this->db->join('kategori as k', 'b.k_id_kategori = k.id_kategori', 'left');
        $this->db->join('bahasa as ba', 'b.b_id_bahasa = ba.id_bahasa', 'left');
        $this->db->join('circ_type as c', 'b.ct_id_circ_type = c.id_circ_type', 'left');
        $this->db->join('funding as f', 'b.f_id_funding = f.id_funding', 'left');
        $this->db->join('sumber_koleksi as sk', 'b.sk_id_sumber = sk.id_sumber', 'left');
        $this->db->join('jenis_akses as j', 'b.jenis_akses = j.id_jenis', 'left');
        if ($register != null) {
            $this->db->where('register', $register);
        }
        return $this->db->get()->result_array();
        // return $data->result_array();
    }
}
