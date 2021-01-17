<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Denda extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('M_jenis_denda');
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Daftar Sumber Koleksi | Portal FH';
        $data_denda = $this->M_jenis_denda->getData();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/data/jenis_denda', array('data_denda' => $data_denda));
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $res = $this->M_jenis_denda->insertData();
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data berhasil ditambahkan');
            redirect('data/Denda');
        } else {
            $this->session->set_flashdata('danger', 'Gagal menambahkan data');
            redirect('data/Denda');
        }
    }

    public function ubah($id_denda)
    {
        $res = $this->M_jenis_denda->updateData($id_denda);
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data berhasil diubah');
            redirect('data/Denda');
        } else {
            $this->session->set_flashdata('danger', 'Gagal mengubah data');
            redirect('data/Denda');
        }
    }

    function hapus($id_denda)
    {
        $res = $this->M_jenis_denda->deleteData($id_denda);
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
            redirect('data/Denda');
        } else {
            $this->session->set_flashdata('danger', 'Gagal menghapus data');
            redirect('data/Denda');
        }
    }

    public function get_ajax()
    {
        $data = $this->db->get('denda')->result_array();
        echo json_encode($data);
    }
}
