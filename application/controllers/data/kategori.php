<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Kategori extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('M_kategori_buku');
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Daftar Sumber Koleksi | Portal FH';
        $data_kategori = $this->M_kategori_buku->getData();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/data/kategori_buku', array('data_kategori' => $data_kategori));
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $res = $this->M_kategori_buku->insertData();
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data berhasil ditambahkan');
            redirect('data/Kategori');
        } else {
            $this->session->set_flashdata('danger', 'Gagal menambahkan data');
            redirect('data/Kategori');
        }
    }

    public function ubah($id_kategori)
    {
        $res = $this->M_kategori_buku->updateData($id_kategori);
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data berhasil diubah');
            redirect('data/Kategori');
        } else {
            $this->session->set_flashdata('danger', 'Gagal mengubah data');
            redirect('data/Kategori');
        }
    }

    function hapus($id_kategori)
    {
        $res = $this->M_kategori_buku->deleteData($id_kategori);
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
            redirect('data/Kategori');
        } else {
            $this->session->set_flashdata('danger', 'Gagal menghapus data');
            redirect('data/Kategori');
        }
    }
}
