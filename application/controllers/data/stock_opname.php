<?php
defined('BASEPATH') or exit('No direct script access allowed');


class stock_opname extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        // $this->load->model('m_stock_opname');
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Daftar Sumber Koleksi | Portal FH';
        // $data_stock_opname = $this->m_stock_opname->getData();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/stock_opname');
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['title'] = 'Daftar Sumber Koleksi | Portal FH';
        // $data_stock_opname = $this->m_stock_opname->getData();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/add_stock_opname');
        $this->load->view('templates/footer');
    }

    // public function addData()
    // {
    //     $res = $this->m_stock_opname->insertData();
    //     if ($res >= 1) {
    //         $this->session->set_flashdata('success', 'Data berhasil ditambahkan');
    //         redirect('data/stock_opname');
    //     } else {
    //         $this->session->set_flashdata('warning', 'Gagal menambahkan data');
    //         redirect('data/stock_opname');
    //     }
    // }

    // public function updateData()
    // {
    //     $res = $this->m_stock_opname->updateData();
    //     if ($res >= 1) {
    //         $this->session->set_flashdata('success', 'Data berhasil diubah');
    //         redirect('data/stock_opname');
    //     } else {
    //         $this->session->set_flashdata('warning', 'Gagal mengubah data');
    //         redirect('data/stock_opname');
    //     }
    // }

    // function deleteData($id_sumber)
    // {
    //     $res = $this->m_stock_opname->deleteData($id_sumber);
    //     if ($res >= 1) {
    //         $this->session->set_flashdata('success', 'Data berhasil dihapus');
    //         redirect('data/stock_opname');
    //     } else {
    //         $this->session->set_flashdata('warning', 'Gagal menghapus data');
    //         redirect('data/stock_opname');
    //     }
    // }
}
