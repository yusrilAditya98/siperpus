<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pelanggaran extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('M_pelanggaran', 'p');
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Jenis Pelanggaran';
        $data['list_pelanggaran'] = $this->p->getPelanggaran();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('data/jenis_pelanggaran');
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $this->p->insertPelanggaran();
        $this->session->set_flashdata('success', 'Data berhasil ditambah');
        redirect('data/Pelanggaran');
    }

    public function hapus($id)
    {
        $this->db->delete('pelanggaran', ['id_pelanggaran' => $id]);
        $this->session->set_flashdata('success', 'Data berhasil dihapus');
        redirect('data/Pelanggaran');
    }

    public function ubah($id)
    {
        $this->p->editPelanggaran($id);
        $this->session->set_flashdata('success', 'Data berhasil diubah');
        redirect('data/Pelanggaran');
    }
}
