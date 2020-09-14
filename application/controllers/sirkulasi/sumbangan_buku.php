<?php
defined('BASEPATH') or exit('No direct script access allowed');


class sumbangan_buku extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('m_sumbangan_buku');
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Daftar Sumber Koleksi | Portal FH';
        $data_sumbangan_buku = $this->m_sumbangan_buku->getData();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('page/sumbangan_buku', array('data_sumbangan_buku' => $data_sumbangan_buku));
        $this->load->view('templates/footer');
    }

    public function admin()
    {
        $data['title'] = 'Daftar Sumber Koleksi | Portal FH';
        $data_sumbangan_buku = $this->m_sumbangan_buku->getData();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/sumbangan_buku', array('data_sumbangan_buku' => $data_sumbangan_buku));
        $this->load->view('templates/footer');
    }
}
