<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Jenis_koleksi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('M_jenis_koleksi');
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Daftar Jenis Koleksi | Portal FH';
        $data['jenis_koleksi'] = $this->M_jenis_koleksi->getData();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/data/jenis_koleksi');
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $res = $this->M_jenis_koleksi->insertData();
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data berhasil ditambahkan');
            redirect('data/Jenis_koleksi');
        } else {
            $this->session->set_flashdata('danger', 'Gagal menambahkan data');
            redirect('data/Jenis_koleksi');
        }
    }

    public function ubah($id_jenis_akses)
    {
        $res = $this->M_jenis_koleksi->updateData($id_jenis_akses);
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data berhasil diubah');
            redirect('data/Jenis_koleksi');
        } else {
            $this->session->set_flashdata('danger', 'Gagal mengubah data');
            redirect('data/Jenis_koleksi');
        }
    }

    function hapus($id_jenis_akses)
    {
        $res = $this->M_jenis_koleksi->deleteData($id_jenis_akses);
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
            redirect('data/Jenis_koleksi');
        } else {
            $this->session->set_flashdata('danger', 'Gagal menghapus data');
            redirect('data/Jenis_koleksi');
        }
    }
}
