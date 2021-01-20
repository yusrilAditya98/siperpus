<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembayaran extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
    }
    private function template($title){
        $data['title'] = $title;
        $data['buku_dipinjam'] = count($this->db->where(['jenis_sirkulasi' => 1, 'status_sirkulasi' => 0, 'u_username' => $this->session->userdata('username')])->from('sirkulasi')->join('buku', 'buku.register = sirkulasi.b_register')->get()->result_array());
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
    }

    public function pembayaran_denda_admin(){
        $data['title'] = "Pembayaran";
        $this->template($data['title']);
        $this->load->view('pembayaran/pembayaran_denda_admin', $data);
        $this->load->view('templates/footer');
    }
}