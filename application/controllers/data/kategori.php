<?php
defined('BASEPATH') or exit('No direct script access allowed');


class kategori extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('m_kategori_buku');
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Daftar Sumber Koleksi | Portal FH';
        $data_kategori = $this->m_kategori_buku->getData();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/data/kategori_buku', array('data_kategori' => $data_kategori));
        $this->load->view('templates/footer');
    }

    public function addData()
    {
        $res = $this->m_kategori_buku->insertData();
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data berhasil ditambahkan');
            redirect('data/kategori');
        } else {
            $this->session->set_flashdata('warning', 'Gagal menambahkan data');
            redirect('data/kategori');
        }
    }

    public function updateData()
    {
        $res = $this->m_kategori_buku->updateData();
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data berhasil diubah');
            redirect('data/kategori');
        } else {
            $this->session->set_flashdata('warning', 'Gagal mengubah data');
            redirect('data/kategori');
        }
    }

    function deleteData($id_kategori)
    {
        $res = $this->m_kategori_buku->deleteData($id_kategori);
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
            redirect('data/kategori');
        } else {
            $this->session->set_flashdata('warning', 'Gagal menghapus data');
            redirect('data/kategori');
        }
    }
}
