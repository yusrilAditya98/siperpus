<?php
defined('BASEPATH') or exit('No direct script access allowed');


class sumber_koleksi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('m_sumber_koleksi');
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Daftar Sumber Koleksi | Portal FH';
        $data_sumber_koleksi = $this->m_sumber_koleksi->getData();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/data/sumber_koleksi', array('data_sumber_koleksi' => $data_sumber_koleksi));
        $this->load->view('templates/footer');
    }

    public function addData()
    {
        $res = $this->m_sumber_koleksi->insertData();
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data berhasil ditambahkan');
            redirect('data/sumber_koleksi');
        } else {
            $this->session->set_flashdata('warning', 'Gagal menambahkan data');
            redirect('data/sumber_koleksi');
        }
    }

    public function updateData()
    {
        $res = $this->m_sumber_koleksi->updateData();
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data berhasil diubah');
            redirect('data/sumber_koleksi');
        } else {
            $this->session->set_flashdata('warning', 'Gagal mengubah data');
            redirect('data/sumber_koleksi');
        }
    }

    function deleteData($id_sumber)
    {
        $res = $this->m_sumber_koleksi->deleteData($id_sumber);
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
            redirect('data/sumber_koleksi');
        } else {
            $this->session->set_flashdata('warning', 'Gagal menghapus data');
            redirect('data/sumber_koleksi');
        }
    }
}
