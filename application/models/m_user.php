<?php
defined('BASEPATH') or exit('No direct script access allowed');


class M_user extends CI_Model
{

    var $column_order2 = array(null, 'u.username', 'u.nama', null, null, null);
    //set column field database for datatable orderable
    var $column_search2 = array('u.username', 'u.nama');
    //set column field database for datatable searchable
    var $order_mhs = array('u.username' => 'asc'); // default order 

    private function _get_datatables_query2($username = null)
    {
        $this->db->select('u.*');
        $this->db->from('user as u');

        if ($username != null) {
            $this->db->where('username', $username);
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

    function get_datatables2($username = null)
    {
        $this->_get_datatables_query2($username);
        if (@$_POST['length'] != -1)
            $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered2($username = null)
    {
        $this->_get_datatables_query2($username);
        $query = $this->db->get();
        return $query->num_rows();
    }
    function count_all2($username = null)
    {
        $this->db->from('user');
        $this->db->where('status_aktif', 1);
        $this->db->where('ru_role_id', 2);

        if ($username != null) {
            $this->db->where('username', $username);
        }
        return $this->db->count_all_results();
    }

    public function getUser($username = null, $role_id = null)
    {
        $this->db->select('*');
        $this->db->from('user');
        if ($username != null) {
            $this->db->where('user.username', $username);
            return $this->db->get()->row_array();
        }
        if ($role_id != null) {
            $this->db->where('user.ru_role_id', $role_id);
        }
        $this->db->join('prodi as p', 'p.id_prodi = user.p_id_prodi');
        $this->db->join('role_user as ru', 'ru.role_id = user.ru_role_id');
        return $this->db->get()->result_array();
    }

    public function insertUser($role_id)
    {

        $data =  [
            'username' => $this->input->post('username'),
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'no_hp' => $this->input->post('no_hp'),
            'email' => $this->input->post('email'),
            'password' =>  password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
            'status_aktif' => $this->input->post('status_aktif'),
            'date_created' => date("Y-m-d"),
            'p_id_prodi' => $this->input->post('prodi'),
            'ru_role_id' => $role_id,
            'date_ended' => $this->input->post('date_ended'),
        ];
        var_dump($data);

        // cek jika ada gambar yang di upload
        $upload_image = $_FILES['foto'];
        if ($upload_image['error'] != 4) {
            $config['allowed_types'] = 'jpg|png|jpeg|JPG|PNG|JPEG';
            $config['max_size']     = '1024'; //kb
            $config['upload_path'] = './assets/foto_profil/';
            $config['file_name'] = 'foto_profil_' . $data['username'];
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('foto')) {
                $data['foto'] = $this->upload->data('file_name');
            } else {
                return false;
            }
        }
        $this->db->insert('user', $data);
        return true;
    }
    public function updateUser()
    {
        $old_username = $this->input->post('old_username');
        $data =  [
            'username' => $this->input->post('username'),
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'email' => $this->input->post('email'),
            'no_hp' => $this->input->post('no_hp'),
            'status_aktif' => $this->input->post('status_aktif'),
            'p_id_prodi' => $this->input->post('prodi'),
            'date_ended' => $this->input->post('date_ended'),
        ];


        // cek jika ada gambar yang di upload
        $upload_image = $_FILES['foto'];
        if ($upload_image['error'] != 4) {
            $config['allowed_types'] = 'jpg';
            $config['max_size']     = '1024'; //kb
            $config['upload_path'] = './assets/foto_profil/';
            $config['file_name'] = 'foto_profil_' . $data['username'];
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('foto')) {
                $old_image = $this->input->post('old_foto');
                if ($old_image != 'default.png') {
                    unlink(FCPATH . 'assets/foto_profil/' . $old_image);
                }
                $data['foto'] = $this->upload->data('file_name');
            } else {
                return false;
            }
        }
        $this->db->update('user', $data, ['username' => $old_username]);
        return true;
    }

    public function updatePassword()
    {
        $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
        $username = $this->input->post('username');
        $this->db->set('password', $password);
        $this->db->where('username', $username);
        $this->db->update('user');
    }

    public function updateStatusUser($username)
    {
        $this->db->set('status_aktif', 0);
        $this->db->where('username', $username);
        $this->db->update('user');
        return true;
    }

    public function dataRecall()
    {
        $this->db->select('r.*, s.no_transaksi, b.register, b.judul_buku, u.nama');
        $this->db->from('recall as r');
        $this->db->join('sirkulasi as s', 's.id_sirkulasi = r.id_sirkulasi', 'left');
        $this->db->join('buku as b', 'b.register = s.b_register', 'left');
        $this->db->join('user as u', 'u.username = s.u_username', 'left');
        $this->db->where('s.u_username', $this->session->userdata('username'));
        $this->db->where('r.status_recall', 1);
        $this->db->where_in('s.status_sirkulasi', [4, 9]);
        return $this->db->get()->result_array();
    }

    public function dataCardStatus($username)
    {
        $this->db->select('COUNT(s.b_register) as total');
        $this->db->from('sirkulasi as s');
        $this->db->where('s.u_username', $username);
        $this->db->where('s.jenis_sirkulasi', 1);
        $this->db->where_not_in('s.status_sirkulasi', [0]);
        $data['buku_dipinjam'] =  $this->db->get()->row_array();

        $this->db->select('COUNT(s.b_register) as total');
        $this->db->from('sirkulasi as s');
        $this->db->where('s.u_username', $username);
        $this->db->where('s.jenis_sirkulasi', 2);
        $data['buku_dibaca'] =  $this->db->get()->row_array();

        $this->db->select('COUNT(s.b_register) as total');
        $this->db->from('sirkulasi as s');
        $this->db->where('s.u_username', $username);
        $this->db->where('s.jenis_sirkulasi', 1);
        $this->db->where('s.status_sirkulasi', 6);
        $this->db->join('sirkulasi_pelanggaran as sp', 'sp.s_id_sirkulasi = s.id_sirkulasi', 'left');
        $data['pelanggaran_buku'] =  $this->db->get()->row_array();

        return $data;
    }

    public function dataBukuTerkini($username)
    {
        $this->db->select('*');
        $this->db->from('sirkulasi as s');
        $this->db->join('buku as b', 's.b_register=b.register', 'left');
        $this->db->join('user as u', 's.u_username=u.username', 'left');
        $this->db->order_by('s.status_sirkulasi', 'asc');
        $this->db->where('s.jenis_sirkulasi', 1);
        $this->db->where_not_in('s.status_sirkulasi', [0]);
        $this->db->where('u.username', $username);
        return $this->db->get()->result_array();
    }
}
