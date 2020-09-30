<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Peminjaman extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        is_logged_in();
    }

    public function keranjangan_peminjaman()
    {
        $data['title'] = 'Dashboard';
        $this->load->view('templates/header');
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('page/keranjangan_peminjaman');
        $this->load->view('templates/footer');
    }
}
