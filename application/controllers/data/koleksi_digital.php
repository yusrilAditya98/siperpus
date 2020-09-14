<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Koleksi_digital extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Koleksi Digital';
        $this->load->view('templates/header');
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('koleksi_digital/list_koleksi_digital');
        $this->load->view('templates/footer');
    }
}
