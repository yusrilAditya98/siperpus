<?php
defined('BASEPATH') or exit('No direct script access allowed');


class M_sumbangan_buku extends CI_Model
{
    var $column_order = array(null, 'b.register', 'b.judul_buku', 'u.nama', 'sb.tanggal_sumbangan', 'sb.status_sumbangan', null);
    //set column field database for datatable orderable
    var $column_search = array('b.register', 'b.judul_buku', 'u.nama', 'sb.tanggal_sumbangan', 'sb.status_sumbangan');
    //set column field database for datatable searchable
    var $order = array('sb.tanggal_sumbangan' => 'asc'); // default order 

    private function _get_datatables_query($role_id, $username = null)
    {
        $this->db->select('sb.*, u.username, u.nama, b.*, k.nama_kategori, ba.nama_bahasa, c.nama_circ_type, f.nama_funding, sk.nama_sumber');
        $this->db->from('sumbangan_buku as sb');
        $this->db->join('user as u', 'sb.u_username = u.username', 'left');
        $this->db->join('buku as b', 'sb.b_register = b.register', 'left');
        $this->db->join('kategori as k', 'b.k_id_kategori = k.id_kategori', 'left');
        $this->db->join('bahasa as ba', 'b.b_id_bahasa = ba.id_bahasa', 'left');
        $this->db->join('circ_type as c', 'b.ct_id_circ_type = c.id_circ_type', 'left');
        $this->db->join('funding as f', 'b.f_id_funding = f.id_funding', 'left');
        $this->db->join('sumber_koleksi as sk', 'b.sk_id_sumber = sk.id_sumber', 'left');
        $this->db->where('sb.r_role_id', $role_id);
        if ($username != null) {
            $this->db->where('sb.u_username', $username);
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
    function get_datatables($role_id, $username = null)
    {
        $this->_get_datatables_query($role_id, $username);
        if (@$_POST['length'] != -1)
            $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered($role_id, $username = null)
    {
        $this->_get_datatables_query($role_id, $username);
        $query = $this->db->get();
        return $query->num_rows();
    }
    function count_all($role_id, $username = null)
    {
        $this->db->from('sumbangan_buku');
        $this->db->where('r_role_id', $role_id);
        if ($username != null) {
            $this->db->where('u_username', $username);
        }
        return $this->db->count_all_results();
    }
    // end datatables

    public function getData($id_sumbangan = null)
    {
        $this->db->select('sb.*, u.username, u.nama, b.*');
        $this->db->from('sumbangan_buku as sb');
        $this->db->join('user as u', 'sb.u_username = u.username', 'left');
        $this->db->join('buku as b', 'sb.b_register = b.register', 'left');
        if ($id_sumbangan != null) {
            $this->db->where('id_sumbangan', $id_sumbangan);
        }
        return $this->db->get()->result_array();

        // $data = $this->db->query('select * from sumbangan_buku ' . $where);
        // return $data->result_array();
    }
    public function getDataUser($id_sumbangan = null, $username = null)
    {
        $this->db->select('sb.*, u.username, u.nama, b.*');
        $this->db->from('sumbangan_buku as sb');
        $this->db->join('user as u', 'sb.u_username = u.username', 'left');
        $this->db->join('buku as b', 'sb.b_register = b.register', 'left');
        if ($id_sumbangan != null) {
            $this->db->where('id_sumbangan', $id_sumbangan);
        }
        if ($username != null) {
            $this->db->where('u.username', $username);
        }

        return $this->db->get()->result_array();

        // $data = $this->db->query('select * from sumbangan_buku ' . $where);
        // return $data->result_array();
    }

    public function insertData()
    {
        $data =  [
            'register' => $this->input->post('register'),
            'judul_buku' => $this->input->post('judul_buku'),
            'pengarang' => $this->input->post('pengarang'),
            'penerbit' => $this->input->post('penerbit'),
            'tahun_terbit' => $this->input->post('tahun_terbit'),
            'kondisi_fisik' => $this->input->post('kondisi_fisik'),
            'status_buku' => $this->input->post('status_buku'),
            'jenis_akses' => $this->input->post('jenis_akses'),
            'kota_terbit' => $this->input->post('kota_terbit'),
            'isbn' => $this->input->post('isbn'),
            'no_dewey' => $this->input->post('no_dewey'),
            'author_abrev' => $this->input->post('author_abrev'),
            'title_abrev' => $this->input->post('title_abrev'),
            'sampul' => $this->input->post('sampul'),
            'volume' => $this->input->post('volume'),
            'bibliography' => $this->input->post('bibliography'),
            'subject' => $this->input->post('subject'),
            'b_id_bahasa' => $this->input->post('b_id_bahasa'),
            'ct_id_circ_type' => $this->input->post('ct_id_circ_type'),
            'f_id_funding' => $this->input->post('f_id_funding'),
            'sk_id_sumber' => $this->input->post('sk_id_sumber'),
            'k_id_kategori' => $this->input->post('k_id_kategori'),
        ];

        // upload sampul
        $upload_image = $_FILES['sampul'];
        if ($upload_image) {
            $config['allowed_types'] = 'jpg|JPG|jpeg|JPEG|png|PNG';
            $config['max_size']     = '1024'; //kb
            $config['upload_path'] = './assets/sampul_buku/';
            $config['file_name'] = 'sampul_buku_' . $data['judul_buku'];
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('sampul')) {
                $data['sampul'] = $this->upload->data('file_name');
            } else {
                return false;
            }
        }
        $this->db->insert('buku', $data);

        $status_sumbangan = '';
        if ($this->input->post('role_id') == 1) {
            $status_sumbangan = '2';
        } else {
            $status_sumbangan = '1';
        }
        $data_sumbangan =  [
            'tanggal_sumbangan' => $this->input->post('tanggal_sumbangan'),
            'u_username' => $this->input->post('username'),
            'b_register' => $this->input->post('register'),
            'status_sumbangan' => $status_sumbangan,
            'r_role_id' => $this->input->post('role_id'),
        ];
        $this->db->insert('sumbangan_buku', $data_sumbangan);

        return true;
    }
    public function updateData()
    {
        $id_sumbangan = $this->input->post('id_sumbangan');
        $data =  [
            'u_username' => $this->input->post('u_username'),
            'b_register' => $this->input->post('b_register'),
            'status_sumbangan' => $this->input->post('status_sumbangan'),
        ];

        $this->db->update('sumbangan_buku', $data, ['id_sumbangan' => $id_sumbangan]);
        return true;
    }

    public function deleteDataSumbangan($id_sumbangan, $register)
    {
        $this->db->delete('sumbangan_buku', ['id_sumbangan' => $id_sumbangan]);
        $this->db->delete('buku', ['register' => $register]);
        return true;
    }

    public function batal_sumbangan($id_sumbangan)
    {
        $data =  [
            'status_sumbangan' => '1',
        ];

        $this->db->update('sumbangan_buku', $data, ['id_sumbangan' => $id_sumbangan]);
        return true;
    }
    public function terima_sumbangan($id_sumbangan)
    {
        $data =  [
            'status_sumbangan' => '2',
        ];

        $this->db->update('sumbangan_buku', $data, ['id_sumbangan' => $id_sumbangan]);
        return true;
    }

    public function tolak_sumbangan($id_sumbangan)
    {
        $data =  [
            'status_sumbangan' => '3',
        ];

        $this->db->update('sumbangan_buku', $data, ['id_sumbangan' => $id_sumbangan]);
        return true;
    }
}
