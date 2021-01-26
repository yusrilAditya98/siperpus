<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembayaran extends CI_Controller
{
    /*
        Status sirkulasi pembayaran :
        0 => Belum Validasi
        1 => Telah Upload Bukti Pembayaran
        2 => Pembayaran valid
        3 => Revisi Pembayaran 
    */
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model("M_sirkulasi");
    }
    private function template($title)
    {
        $data['title'] = $title;
        $data['buku_dipinjam'] = count($this->db->where(['jenis_sirkulasi' => 1, 'status_sirkulasi' => 0, 'u_username' => $this->session->userdata('username')])->from('sirkulasi')->join('buku', 'buku.register = sirkulasi.b_register')->get()->result_array());
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
    }

    public function pembayaran_denda_admin()
    {
        $data['title'] = "Pembayaran";
        $data['pembayaran'] = $this->M_sirkulasi->getSirkulasiPembayaran();
        $this->template($data['title']);
        $this->load->view('pembayaran/pembayaran_denda_admin', $data);
        $this->load->view('templates/footer');
    }

    public function detail_transaksi_pembayaran($no_transaksi)
    {
        $data['title'] = "Pembayaran";
        $data['transaksi'] = $this->M_sirkulasi->getSirkulasiPembayaran($no_transaksi);
        $data['sirkulasi'] = $this->M_sirkulasi->getDetailSirkulasiPembayaran($no_transaksi);

        $this->template($data['title']);
        $this->load->view('pembayaran/detail_transaksi_pembayaran', $data);
        $this->load->view('templates/footer');
    }

    public function validasiPembayaran()
    {
        $idSirkulasi = $this->input->post('id_sirkulasi');
        $noTransaksi = $this->input->post('no_transaksi');
        $jumlahBayar = $this->input->post('jumlah_bayar');
        $dataSirkulasi = [
            'status_pelanggaran' => 2,
            'pj_entry_pembayaran' => $this->session->userdata('username')
        ];
        foreach ($idSirkulasi as $is) {
            $this->db->update('sirkulasi_pelanggaran', $dataSirkulasi, ['s_id_sirkulasi' => $is]);
        }

        $dataTransaksi = [
            'status' => 1,
            'jumlah_bayar' => $jumlahBayar
        ];
        $this->db->update('sirkulasi_transaksi', $dataTransaksi, ['no_transaksi' => $noTransaksi]);

        redirect('sirkulasi/Pembayaran/detail_transaksi_pembayaran/' . $noTransaksi);
    }

    public function pembayaran_denda_anggota()
    {
        $data['title'] = "Pembayaran";
        $username = $this->session->userdata('username');
        $data['pembayaran'] = $this->M_sirkulasi->getSirkulasiPembayaranAnggota($username);
        $this->template($data['title']);
        $this->load->view('pembayaran/pembayaran_denda_anggota', $data);
        $this->load->view('templates/footer');
    }

    public function detail_transaksi($no_transaksi)
    {
        $data['title'] = "Pembayaran";
        $data['transaksi'] = $this->M_sirkulasi->getSirkulasiPembayaran($no_transaksi);
        $data['sirkulasi'] = $this->M_sirkulasi->getDetailSirkulasiPembayaran($no_transaksi);

        $this->template($data['title']);
        $this->load->view('pembayaran/detail_transaksi_pembayaran_anggota', $data);
        $this->load->view('templates/footer');
    }

    public function uploadPembayaran()
    {
        $noTransaksi = $this->input->post('no_transaksi');
        $jumlahBayar = $this->input->post('jumlah_bayar');
        $statusOld   = $this->input->post('status');
        if($statusOld == 0 || $statusOld == 3){
            $statusOld = 1;
        }

        $dataTransaksi = [
            'status' =>  $statusOld,
            'jumlah_bayar' => $jumlahBayar
        ];
        $upload_image = $_FILES['bukti_foto'];
        if ($upload_image['error'] != 4) {
            $config['allowed_types'] = 'jpg|png|jpeg|JPG|PNG|JPEG';
            $config['max_size']     = '1024'; //kb
            $config['upload_path'] = './assets/bukti_bayar/';
            $config['file_name'] = $this->session->userdata('username').'_'.$noTransaksi.'_'.time();
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('bukti_foto')) {
                $dataTransaksi['bukti_foto'] = $this->upload->data('file_name');
                $this->db->update('sirkulasi_transaksi', $dataTransaksi, ['no_transaksi' => $noTransaksi]);
            } else {
                redirect('sirkulasi/Pembayaran/detail_transaksi/' . $noTransaksi);
            }
        }
        redirect('sirkulasi/Pembayaran/detail_transaksi/' . $noTransaksi);
    }
}
