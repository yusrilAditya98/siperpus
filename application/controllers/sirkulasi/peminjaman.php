<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Peminjaman extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('m_user', 'u');
        $this->load->model('m_prodi', 'p');
        is_logged_in();
    }
    public function template($title)
    {
        $data['title'] = $title;
        $data['buku_dipinjam'] = count($this->db->where(['jenis_sirkulasi' => 1, 'status_sirkulasi' => 0, 'u_username' => $this->session->userdata('username')])->from('sirkulasi')->join('buku', 'buku.register = sirkulasi.b_register')->get()->result_array());
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
    }
    // public function peminjaman_buku()
    // {
    //     $title = 'Peminjaman Buku | Portal FH';
    //     $data['buku_dipinjam'] = $this->db->where(['jenis_sirkulasi' => 1, 'status_sirkulasi' => 1])->from('sirkulasi')->join('buku', 'buku.register = sirkulasi.b_register')->get()->result_array();
    //     $this->template($title);
    //     $this->load->view('peminjaman/daftar_peminjaman', $data);
    //     $this->load->view('templates/footer');
    // }
    public function pinjam($register)
    {
        $data = array(
            'u_username' => $this->session->userdata('username'),
            'b_register' => $register,
            'jenis_sirkulasi' => 1,
            'tanggal_sirkulasi' => date('Y-m-d'),
            'tanggal_mulai' => date('Y-m-d'),
            'tanggal_akhir' => '0000-00-00',
            'tanggal_pengembalian' => '0000-00-00',
            'tanggal_perpanjangan' => '0000-00-00',
            'status_sirkulasi' => 0,
        );

        $this->db->insert('sirkulasi', $data);
        $this->session->set_flashdata('message', 'Buku dimasukkan di keranjang');
        redirect(site_url('/data/buku/buku_anggota'));
    }
    public function pinjamBuku($id_sirkulasi)
    {
        $this->db->where('id_sirkulasi', $id_sirkulasi)->update('sirkulasi', ['status_sirkulasi' => 1]);
        $this->session->set_flashdata('message', 'Buku berhasil dipinjam');
        redirect(site_url('/sirkulasi/peminjaman/keranjang_peminjaman'));
    }
    public function pinjamSemua()
    {
        $data = $this->db->where(['jenis_sirkulasi' => 1, 'status_sirkulasi' => 0])->from('sirkulasi')->join('buku', 'buku.register = sirkulasi.b_register')->get()->result_array();
        for ($i = 0; $i < count($data); $i++) {
            $id_sirkulasi = $data[$i]['sirkulasi'];
            $this->db->where('id_sirkulasi', $id_sirkulasi)->update('sirkulasi', ['status_sirkulasi' => 1]);
        }
        $this->session->set_flashdata('message', 'Buku berhasil dipinjam');
        redirect(site_url('/sirkulasi/peminjaman/keranjang_peminjaman'));
    }
    public function hapusPinjam($id_sirkulasi)
    {
        $this->db->where('id_sirkulasi', $id_sirkulasi)->delete('sirkulasi');
        $this->session->set_flashdata('message', 'Keranjang buku sudah dihapus');
        redirect(site_url('/sirkulasi/peminjaman/keranjang_peminjaman'));
    }
    public function daftar_buku_dipinjam()
    {
        $title = 'Daftar Buku Dipinjam | Portal FH';
        $data['buku_dipinjam'] = $this->db->where(['status_sirkulasi' => 1])->from('sirkulasi')->join('buku', 'buku.register = sirkulasi.b_register')->get()->result_array();
        $this->template($title);
        $this->load->view('peminjaman/daftar_buku_dipinjam', $data);
        $this->load->view('templates/footer');
    }
    public function keranjang_peminjaman()
    {
        $title = 'Keranjang Peminjaman | Portal FH';
        $data['buku_dipinjam'] = $this->db->where(['jenis_sirkulasi' => 1, 'status_sirkulasi' => 0])->from('sirkulasi')->join('buku', 'buku.register = sirkulasi.b_register')->get()->result_array();
        $this->template($title);
        $this->load->view('peminjaman/keranjang_peminjaman', $data);
        $this->load->view('templates/footer');
    }
    public function perpanjangan_peminjaman()
    {
        $title = 'Perpanjangan Peminjaman | Portal FH';
        $data['buku_perpanjangan'] = $this->db->where(['jenis_sirkulasi' => 2, 'status_sirkulasi' => 0])->from('sirkulasi')->join('buku', 'buku.register = sirkulasi.b_register')->get()->result_array();
        $data['pinjaman'] = $this->db->where(['jenis_sirkulasi' => 1, 'status_sirkulasi' => 1])->from('sirkulasi')->join('buku', 'buku.register = sirkulasi.b_register')->get()->result_array();
        $this->template($title);
        $this->load->view('peminjaman/perpanjangan_peminjaman', $data);
        $this->load->view('templates/footer');
    }
    public function perpanjangan()
    {
        $id_sirkulasi = $this->input->post('sirkulasi');
        $tanggal = $this->input->post('jangka_waktu');
        $this->db->where('id_sirkulasi', $id_sirkulasi)->update('sirkulasi', ['jenis_sirkulasi' => 2, 'tanggal_perpanjangan' => $tanggal, 'status_sirkulasi' => 0]);
        $this->session->set_flashdata('message', 'Pengajuan perpanjangan berhasil');
        redirect(site_url('/sirkulasi/peminjaman/perpanjangan_peminjaman'));
    }
    public function validPinjam($id_sirkulasi)
    {
        $this->db->where('id_sirkulasi', $id_sirkulasi)->update('sirkulasi', ['status_sirkulasi' => 1]);
        $this->session->set_flashdata('message', 'Validasi perpanjangan berhasil');
        redirect(site_url('/sirkulasi/peminjaman/perpanjangan_peminjaman_admin'));
    }
    public function tolakPinjam($id_sirkulasi)
    {
        $this->db->where('id_sirkulasi', $id_sirkulasi)->update('sirkulasi', ['status_sirkulasi' => 2]);
        $this->session->set_flashdata('message', 'Validasi perpanjangan ditolak');
        redirect(site_url('/sirkulasi/peminjaman/perpanjangan_peminjaman_admin'));
    }
    public function pelanggaran_peminjaman()
    {
        $title = 'Pelanggaran Peminjaman | Portal FH';
        $this->template($title);
        $this->load->view('peminjaman/pelanggaran_peminjaman');
        $this->load->view('templates/footer');
    }
    public function pengembalian_peminjaman()
    {
        $title = 'Pengembalian Peminjaman | Portal FH';
        $this->template($title);
        $this->load->view('peminjaman/pengembalian_peminjaman');
        $this->load->view('templates/footer');
    }

    public function peminjaman_buku_admin()
    {
        $title = 'Peminjaman Buku | Portal FH';
        $this->template($title);
        $this->load->view('peminjaman/peminjaman_buku_admin');
        $this->load->view('templates/footer');
    }

    public function perpanjangan_peminjaman_admin()
    {
        $title = 'Daftar Buku Dipinjam | Portal FH';
        $data['buku_perpanjangan'] = $this->db->where(['jenis_sirkulasi' => 2])->from('sirkulasi')->join('buku', 'buku.register = sirkulasi.b_register')->join('user', 'user.username = sirkulasi.u_username')->get()->result_array();
        $this->template($title);
        $this->load->view('peminjaman/perpanjangan_peminjaman_admin', $data);
        $this->load->view('templates/footer');
    }
    public function pelanggaran_peminjaman_admin()
    {
        $title = 'Pelanggaran Peminjaman | Portal FH';
        $this->template($title);
        $this->load->view('peminjaman/pelanggaran_peminjaman_admin');
        $this->load->view('templates/footer');
    }
    public function pengembalian_peminjaman_admin()
    {
        $title = 'Pengembalian Peminjaman | Portal FH';
        $this->template($title);
        $this->load->view('peminjaman/pengembalian_peminjaman_admin');
        $this->load->view('templates/footer');
    }
}
