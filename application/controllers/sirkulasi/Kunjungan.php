<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kunjungan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('form_validation');
        $this->load->library('Ciqrcode');
        $this->load->model('M_katalog_buku');
        $this->load->model('M_sirkulasi', 'sirkulasi');
        is_logged_in();
    }

    function list_ajax()
    {
        $list = $this->sirkulasi->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = date("d-m-Y", strtotime($item->tanggal_sirkulasi));
            $row[] = $item->u_username;
            $row[] = $item->nama;
            $row[] = $item->register;
            $row[] = $item->judul_buku;
            $row[] = $item->penerbit;
            $row[] = $item->pengarang;
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->sirkulasi->count_all(),
            "recordsFiltered" => $this->sirkulasi->count_filtered(),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }

    public function index()
    {
        $this->load->view('admin/kunjungan');
    }

    public function tambah()
    {
        $data = [
            'username' => $this->input->post('username'),
        ];

        $result = [];
        $cekUser = $this->db->get_where('user', ['username' => $data['username']])->data_seek();
        $user = $this->db->get_where('user', ['username' => $data['username']])->row_array();

        if ($cekUser) {
            $pengunjung = [
                'username' => $data['username'],
                'tanggal' => date('Y-m-d'),
            ];
            $this->db->insert('pengunjung', $pengunjung);
            $result = [
                'message' =>  $user,
                'status' => true
            ];
        } else {
            $result = [
                'message' => 'Username tidak ditemukan',
                'status' => false
            ];
        }
        echo json_encode($result);
    }

    public function list()
    {
        $data = [
            'title' => 'List Baca Ditempat'
        ];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('baca_ditempat/list_baca_ditempat');
        $this->load->view('templates/footer');
    }
}
