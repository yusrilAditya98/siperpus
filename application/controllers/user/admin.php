<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('m_user', 'u');
        $this->load->model('m_prodi', 'p');
        $this->load->model('m_sirkulasi');
        $this->load->model('m_katalog_buku');
        is_logged_in();
        cek_admin();
    }

    public function index()
    {

        $data['title'] = 'Dashboard';
        $data['status'] = $this->m_sirkulasi->dataAdmin();
        $data['jenis_koleksi'] = $this->m_katalog_buku->dataJenisBuku();
        $data['baca_ditempat'] = $this->m_katalog_buku->dataHotBuku(2);
        $data['dipinjam'] = $this->m_katalog_buku->dataHotBuku(1);
        $data['buku_today'] = $this->m_katalog_buku->bukuToday();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/dashboard_admin');
        $this->load->view('templates/footer');
    }

    public function list()
    {
        $data['title'] = 'Manajemen Admin';
        $data['list_admin'] =  $this->u->getUser(null, 1);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/list_admin');
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Admin';
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
            $this->load->view('admin/add_admin');
            $this->load->view('templates/footer');
        } else {
            $addUser = $this->u->insertUser(1);
            if ($addUser == true) {
                $this->session->set_flashdata('success', 'Data berhasil ditambah');
                redirect('user/admin/list');
            } else {
                $this->session->set_flashdata('danger', 'Data gagal ditambah');
                redirect('user/admin/tambah');
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
        redirect('user/admin/list');
    }

    public function ubah($username)
    {
        $data['title'] = 'Ubah Admin';
        $data['list_prodi'] = $this->p->getProdi();
        $data['list_admin'] = $this->u->getUser($username);

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        if ($this->input->post('username') != $data['list_admin']['username']) {
            $this->form_validation->set_rules('username', 'Username', 'required|min_length[3]|is_unique[user.username]');
        }
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('no_hp', 'No HP', 'required');
        $this->form_validation->set_rules('status_aktif', 'Status Aktif', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar');
            $this->load->view('templates/sidebar');
            $this->load->view('admin/edit_admin');
            $this->load->view('templates/footer');
        } else {
            $updateUser = $this->u->updateUser();
            if ($updateUser == true) {
                $this->session->set_flashdata('success', 'Data berhasil diubah');
                redirect('user/admin/list');
            } else {
                $this->session->set_flashdata('danger', 'Data gagal diubah');
                redirect('user/admin/ubah/' . $username);
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
        redirect('user/admin/list');
    }
    public function import()
    {
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
            if (str_replace("\0", "", $data->val($i, 2)) == "") {
                break;
            }
            // menangkap data dan memasukkan ke variabel sesuai dengan kolumnya masing-masing
            $result = [
                "username" => str_replace("\0", "", $data->val($i, 2)),
                "nama" => str_replace("\0", "", $data->val($i, 3)),
                "alamat" => intval(str_replace("\0", "", $data->val($i, 4))),
                "no_hp" => str_replace("\0", "", $data->val($i, 5)),
                "password" => 'p' . str_replace("\0", "", $data->val($i, 2)),
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
        redirect('user/admin/list');
    }
    public function export()
    {
        $data['list_user'] =  $this->u->getUser(null, 1);
        $data['tag'] = 1;
        $data['title'] = "Data Admin";
        $data['filename'] = "Admin";
        $this->load->view('export', $data);
    }
}
