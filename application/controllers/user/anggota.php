<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Anggota extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('m_user', 'u');
        $this->load->model('m_cetak');
        $this->load->model('m_prodi', 'p');
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Dashboard';
        $this->db->select('r.*, s.no_transaksi, b.register, b.judul_buku, u.nama');
        $this->db->from('recall as r');
        $this->db->join('sirkulasi as s', 's.id_sirkulasi = r.id_sirkulasi', 'left');
        $this->db->join('buku as b', 'b.register = s.b_register', 'left');
        $this->db->join('user as u', 'u.username = s.u_username', 'left');
        $this->db->where('s.u_username', $this->session->userdata('username'));
        $this->db->where('r.status_recall', 1);
        $this->db->where_in('s.status_sirkulasi', [4, 9]);
        $data['recall'] = $this->db->get()->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('anggota/dashboard_anggota');
        $this->load->view('templates/footer');
    }

    public function list()
    {
        $data['title'] = 'Manajemen Anggota';
        $data['list_user'] =  $this->u->getUser(null, 2);

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('anggota/list_anggota');
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Anggota';
        $data['list_prodi'] = $this->p->getProdi();
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|min_length[3]|is_unique[user.username]');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('no_hp', 'No HP', 'required');
        $this->form_validation->set_rules('status_aktif', 'Status Aktif', 'required');
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'password dont matches!',
            'min_length' => 'Password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar');
            $this->load->view('templates/sidebar');
            $this->load->view('anggota/add_anggota');
            $this->load->view('templates/footer');
        } else {
            $addUser = $this->u->insertUser(2);
            if ($addUser == true) {
                $this->session->set_flashdata('success', 'Data berhasil ditambah');
                redirect('user/anggota/list');
            } else {
                $this->session->set_flashdata('danger', 'Data gagal ditambah');
                redirect('user/anggota/tambah');
            }
        }
    }

    public function hapus($username)
    {
        $data = $this->u->getUser($username);
        if ($data['foto'] != 'default.png') {
            unlink(FCPATH . 'assets/foto_profil/' . $data['foto']);
        }
        $this->db->delete('user', ['username' => $username]);
        $this->session->set_flashdata('success', 'Data berhasil dihapus');
        redirect('user/anggota/list');
    }

    public function ubah($username)
    {
        $data['title'] = 'Ubah Anggota';
        $data['list_prodi'] = $this->p->getProdi();
        $data['list_user'] = $this->u->getUser($username);

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        if ($this->input->post('username') != $data['list_user']['username']) {
            $this->form_validation->set_rules('username', 'Username', 'required|min_length[3]|is_unique[user.username]');
        }
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('no_hp', 'No HP', 'required');
        $this->form_validation->set_rules('status_aktif', 'Status Aktif', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar');
            $this->load->view('templates/sidebar');
            if ($this->session->userdata('role_id') == 'role_id_1') {
                $this->load->view('anggota/edit_anggota');
            } else {
                $this->load->view('anggota/profil_anggota');
            }

            $this->load->view('templates/footer');
        } else {
            $updateUser = $this->u->updateUser();
            if ($updateUser == true) {
                $this->session->set_flashdata('success', 'Data berhasil diubah');
                if ($this->session->userdata('role_id') == 'role_id_1') {
                    redirect('user/anggota/list');
                } else {
                    redirect('user/anggota/ubah/' . $username);
                }
            } else {
                $this->session->set_flashdata('danger', 'Data gagal diubah');
                if ($this->session->userdata('role_id') == 'role_id_1') {
                    redirect('user/anggota/list');
                } else {
                    redirect('user/anggota/ubah/' . $username);
                }
            }
        }
    }

    public function ubahPassword()
    {
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'password dont matches!',
            'min_length' => 'Password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
        if ($this->form_validation->run() == false) {
            $this->session->set_flashdata('danger', 'Password tidak sesuai!');
        } else {
            $this->u->updatePassword();
            $this->session->set_flashdata('success', 'Password berhasil diubah');
        }

        if ($this->session->userdata('role_id') == 'role_id_1') {
            redirect('user/anggota/list');
        } else {
            redirect('user/anggota/ubah/' . $this->input->post('username'));
        }
    }


    public function import(){
        // upload file xls
        $target = basename($_FILES['import-data']['name']);
        if ($_FILES['import-data']['name']) {
            $config['allowed_types'] = 'xls';
            $config['max_size']     = '4096'; //kb
            $config['upload_path'] = FCPATH . 'assets/berkas/';
            $config['overwrite'] = true;
            $config['file_name'] = $_FILES['import-data']['name'];
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $this->upload->do_upload('import-data');
        };

        // beri permisi agar file xls dapat di baca
        chmod(FCPATH . 'assets/berkas/' .  $target, 0777);
        // mengambil isi file xls
        $path = FCPATH . 'assets/berkas/' .  $target;
        $data = new Spreadsheet_Excel_Reader($path, false);
        // menghitung jumlah baris data yang ada
        $jumlah_baris = $data->rowcount($sheet_index = 0);
        $input_data = [];
        for ($i = 3; $i < $jumlah_baris; $i++) {
            if(str_replace("\0", "", $data->val($i, 2)) == ""){
                break;
            }
            // menangkap data dan memasukkan ke variabel sesuai dengan kolumnya masing-masing
            $result = [
                "username" => str_replace("\0", "", $data->val($i, 2)),
                "nama" => str_replace("\0", "", $data->val($i, 3)),
                "alamat" => intval(str_replace("\0", "", $data->val($i, 4))),
                "no_hp" => str_replace("\0", "", $data->val($i, 5)),
                "password" => 'p'.str_replace("\0", "", $data->val($i, 2)),
                "status_aktif" => str_replace("\0", "", $data->val($i, 6)),
                "foto" => '',
                "date_created" => date('Y-m-d'),
                "p_id_prodi" => str_replace("\0", "", $data->val($i, 7)),
                "ru_role_id" => str_replace("\0", "", $data->val($i, 8)),
            ];
            array_push($input_data, $result);
        };
        // var_dump($input_data);die;
        $this->db->insert_batch('user', $input_data);
        // hapus kembali file .xls yang di upload tadi
        unlink($path);
        // alihkan halaman ke index.php
        $this->session->set_flashdata('success', 'Impor data Anggota berhasil');
        redirect('user/anggota/list');
    }
    public function export()
    {
        $data['list_user'] =  $this->u->getUser(null, 2);
        $data['tag'] = 2;
        $data['title'] = "Data Anggota";
        $data['filename'] = "Anggota";
        $this->load->view('export', $data);

    function get_status_mahasiswa()
    {
        $username_siswa = $this->session->userdata('username');
        $list = $this->m_user->get_datatables2($username_siswa);
        $data = array();
        $no = @$_POST['start'];
        $mhs = [];
        $mhs_sirkulasi = [];
        $status = [];
        // echo var_dump($list);
        // echo "<br>";
        // echo "<br>";
        foreach ($list as $item) {
            $mhs[] = $item->username;
        }
        $mhs = array_unique($mhs);
        sort($mhs);
        // echo var_dump($mhs);
        // echo "<br>";
        // echo "<br>";
        for ($i = 0; $i < count($mhs); $i++) {
            $cek_sirkulasi = $this->m_cetak->getDataSirkulasi(null, $mhs[$i]);
            foreach ($cek_sirkulasi as $item) {
                $status[$mhs[$i]][] = $item['id_sirkulasi'] . "-" . $item['status_sirkulasi'];
                if ($item['status_sirkulasi'] == 6) {
                    $cek_pelanggaran = $this->m_cetak->getDataSirkulasiPelanggaran($item['id_sirkulasi']);
                    if ($cek_pelanggaran[0]['status_pelanggaran'] == 1) {
                        $mhs_sirkulasi[] = $item['u_username'];
                    }
                }
                if ($item['status_sirkulasi'] == 4 || $item['status_sirkulasi'] == 9) {
                    $mhs_sirkulasi[] = $item['u_username'];
                }
            }
        }
        // $mhs_sirkulasi = array_unique($mhs_sirkulasi);
        // sort($mhs_sirkulasi);
        // echo var_dump($mhs_sirkulasi);
        // echo "<br>";
        // echo "<br>";
        // echo var_dump($status);
        // echo "<br>";
        // echo "<br>";

        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no . ".";
            $row[] = $item->username;
            $row[] = $item->nama;
            if (in_array($item->username, $mhs_sirkulasi)) {
                $row[] = '<span class="badge bg-warning">Ada Tanggungan</span>';
                $row[] = '<button type="button" class="btn btn-sm btn-default"><i class="fas fa-info"></i></button>';
                $row[] = '<a target="_blank" href="' . site_url() . 'cetak/bebas_pustaka_view/' . $item->username . '/tanggungan" id="cetak_pustaka' . $item->username . '" class="btn btn-success btn-block">Cetak</a>';
            } else {
                $row[] = '<span class="badge bg-success">Bebas Tanggungan</span>';
                $row[] = '<button type="button" class="btn btn-sm btn-default"><i class="fas fa-info"></i></button>';
                $row[] = '<a target="_blank" href="' . site_url() . 'cetak/bebas_pustaka_view/' . $item->username . '/bebas" id="cetak_pustaka' . $item->username . '" class="btn btn-success btn-block">Cetak</a>';
            }
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->m_user->count_all2($username_siswa),
            "recordsFiltered" => $this->m_user->count_filtered2($username_siswa),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }

    public function bebas_pustaka()
    {
        $data['title'] = 'Cetak Bebas Pustaka | Portal FH';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('anggota/bebas_pustaka', $data);
        $this->load->view('templates/footer');

    }
}
