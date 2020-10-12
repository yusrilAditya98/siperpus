<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Status_Buku extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('m_status_buku');
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Daftar Status Buku | Portal FH';
        $data_status_buku = $this->m_status_buku->getData();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/data/status_buku', array('data_status_buku' => $data_status_buku));
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $res = $this->m_status_buku->insertData();
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data berhasil ditambahkan');
            redirect('data/status_buku');
        } else {
            $this->session->set_flashdata('danger', 'Gagal menambahkan data');
            redirect('data/status_buku');
        }
    }

    public function ubah($id_status)
    {
        $res = $this->m_status_buku->updateData($id_status);
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data berhasil diubah');
            redirect('data/status_buku');
        } else {
            $this->session->set_flashdata('danger', 'Gagal mengubah data');
            redirect('data/status_buku');
        }
    }

    function hapus($id_status)
    {
        $res = $this->m_status_buku->deleteData($id_status);
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
            redirect('data/status_buku');
        } else {
            $this->session->set_flashdata('danger', 'Gagal menghapus data');
            redirect('data/status_buku');
        }
    }
}
