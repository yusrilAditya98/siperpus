<?php
defined('BASEPATH') or exit('No direct script access allowed');


class denda extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('m_jenis_denda');
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Daftar Sumber Koleksi | Portal FH';
        $data_denda = $this->m_jenis_denda->getData();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/data/jenis_denda', array('data_denda' => $data_denda));
        $this->load->view('templates/footer');
    }

    public function addData()
    {
        $res = $this->m_jenis_denda->insertData();
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data berhasil ditambahkan');
            redirect('data/denda');
        } else {
            $this->session->set_flashdata('warning', 'Gagal menambahkan data');
            redirect('data/denda');
        }
    }

    public function updateData()
    {
        $res = $this->m_jenis_denda->updateData();
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data berhasil diubah');
            redirect('data/denda');
        } else {
            $this->session->set_flashdata('warning', 'Gagal mengubah data');
            redirect('data/denda');
        }
    }

    function deleteData($id_denda)
    {
        $res = $this->m_jenis_denda->deleteData($id_denda);
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
            redirect('data/denda');
        } else {
            $this->session->set_flashdata('warning', 'Gagal menghapus data');
            redirect('data/denda');
        }
    }
}
