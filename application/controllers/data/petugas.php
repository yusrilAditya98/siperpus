<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Petugas extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('M_petugas');
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Daftar Sumber Koleksi | Portal FH';
        $data_petugas = $this->M_petugas->getData();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/data/petugas', array('data_petugas' => $data_petugas));
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $res = $this->M_petugas->insertData();
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data berhasil ditambahkan');
            redirect('data/petugas');
        } else {
            $this->session->set_flashdata('danger', 'Gagal menambahkan data');
            redirect('data/petugas');
        }
    }

    public function ubah($id_petugas)
    {
        $res = $this->M_petugas->updateData($id_petugas);
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data berhasil diubah');
            redirect('data/petugas');
        } else {
            $this->session->set_flashdata('danger', 'Gagal mengubah data');
            redirect('data/petugas');
        }
    }

    function hapus($id_petugas)
    {
        $res = $this->M_petugas->deleteData($id_petugas);
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
            redirect('data/petugas');
        } else {
            $this->session->set_flashdata('danger', 'Gagal menghapus data');
            redirect('data/petugas');
        }
    }

    public function get_ajax()
    {
        $data = $this->db->get('petugas')->result_array();
        echo json_encode($data);
    }
}
