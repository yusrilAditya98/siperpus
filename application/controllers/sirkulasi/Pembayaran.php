<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembayaran extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model("M_sirkulasi");
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
        $data['pembayaran'] = $this->M_sirkulasi->getSirkulasiPembayaran();
        $this->template($data['title']);
        $this->load->view('pembayaran/pembayaran_denda_admin', $data);
        $this->load->view('templates/footer');
    }

    public function detail_transaksi_pembayaran($no_transaksi){
        $data['title'] = "Pembayaran";
        $data['transaksi'] = $this->M_sirkulasi->getSirkulasiPembayaran($no_transaksi);
        $data['sirkulasi'] = $this->M_sirkulasi->getDetailSirkulasiPembayaran($no_transaksi);
     
        $this->template($data['title']);
        $this->load->view('pembayaran/detail_transaksi_pembayaran', $data);
        $this->load->view('templates/footer');
    }
}