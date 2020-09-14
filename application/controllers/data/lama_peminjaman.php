<?php
defined('BASEPATH') or exit('No direct script access allowed');


class lama_peminjaman extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('m_lama_peminjaman');
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Daftar Sumber Koleksi | Portal FH';
        $data_lama_peminjaman = $this->m_lama_peminjaman->getData();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/data/lama_peminjaman', array('data_lama_peminjaman' => $data_lama_peminjaman));
        $this->load->view('templates/footer');
    }

    public function addData()
    {
        $res = $this->m_lama_peminjaman->insertData();
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data berhasil ditambahkan');
            redirect('data/lama_peminjaman');
        } else {
            $this->session->set_flashdata('warning', 'Gagal menambahkan data');
            redirect('data/lama_peminjaman');
        }
    }

    public function updateData()
    {
        $res = $this->m_lama_peminjaman->updateData();
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data berhasil diubah');
            redirect('data/lama_peminjaman');
        } else {
            $this->session->set_flashdata('warning', 'Gagal mengubah data');
            redirect('data/lama_peminjaman');
        }
    }

    function deleteData($id_lama_peminjaman)
    {
        $res = $this->m_lama_peminjaman->deleteData($id_lama_peminjaman);
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
            redirect('data/lama_peminjaman');
        } else {
            $this->session->set_flashdata('warning', 'Gagal menghapus data');
            redirect('data/lama_peminjaman');
        }
    }
}
