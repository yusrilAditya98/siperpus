<?php
defined('BASEPATH') or exit('No direct script access allowed');


class jenis_akses extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('m_jenis_akses');
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Daftar Sumber Koleksi | Portal FH';
        $data_jenis_akses = $this->m_jenis_akses->getData();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/data/jenis_akses', array('data_jenis_akses' => $data_jenis_akses));
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $res = $this->m_jenis_akses->insertData();
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data berhasil ditambahkan');
            redirect('data/jenis_akses');
        } else {
            $this->session->set_flashdata('danger', 'Gagal menambahkan data');
            redirect('data/jenis_akses');
        }
    }

    public function ubah($id_jenis_akses)
    {
        $res = $this->m_jenis_akses->updateData($id_jenis_akses);
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data berhasil diubah');
            redirect('data/jenis_akses');
        } else {
            $this->session->set_flashdata('danger', 'Gagal mengubah data');
            redirect('data/jenis_akses');
        }
    }

    function hapus($id_jenis_akses)
    {
        $res = $this->m_jenis_akses->deleteData($id_jenis_akses);
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
            redirect('data/jenis_akses');
        } else {
            $this->session->set_flashdata('danger', 'Gagal menghapus data');
            redirect('data/jenis_akses');
        }
    }
}
