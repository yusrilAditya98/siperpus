<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Sumbangan_buku extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('Ciqrcode');
        $this->load->model('M_sumbangan_buku');
        $this->load->model('M_katalog_buku');
        is_logged_in();
    }

    function get_ajax_admin()
    {
        $role_id = '1';
        $list = $this->M_sumbangan_buku->get_datatables($role_id);
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no . ".";
            $row[] = $item->register;
            $row[] = $item->judul_buku;
            $row[] = $item->nama;
            $date = date_create($item->tanggal_sumbangan);
            $row[] = date_format($date, "M d, Y");
            if ($item->status_sumbangan == 1) {
                $row[] = '<span class="badge bg-info">Diproses</span>';
            } else if ($item->status_sumbangan == 2) {
                $row[] = '<span class="badge bg-success">Diterima</span>';
            } else {
                $row[] = '<span class="badge bg-danger">Ditolak</span>';
            }
            // add html for action
            $row[] = '<button class="btn btn-sm btn-default" data-toggle="modal" data-target="#btnDetailBuku' . $item->id_sumbangan . '"><i class="fa fa-info"></i></button>
            <a href="' . site_url('sirkulasi/sumbangan_buku/ubah/' . $item->id_sumbangan) . '" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
            <a href="' . site_url('sirkulasi/sumbangan_buku/deleteDataSumbangan/' . $item->id_sumbangan . '/' . $item->register) . '" class="btn btn-sm btn btn-danger mr-2" title="Hapus Data Ini" onclick="return confirm(/"ANDA YAKIN AKAN MENGHAPUS DATA PENTING INI ... ?/")"><i class="fa fa-trash"></i></a>
            <div class="modal fade" id="btnDetailBuku' . $item->id_sumbangan . '" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="btnDetailBukuLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="btnDetailBukuLabel">Detail Buku</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-4 col-12 text-center">
                                    <img height="100" src="' . base_url('assets/sampul_buku/' . $item->sampul) . '">
                                </div>
                                <div class="col-lg-8 col-12">
                                    <h5>' . $item->judul_buku . '</h5>
                                    <p>' . $item->pengarang . '</p>
                                </div>
                            </div>
                            <div class="row bg-light">
                                <div class="col-lg-6">
                                    Register
                                </div>
                                <div class="col-lg-6">
                                    ' . $item->register . '
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    isbn
                                </div>
                                <div class="col-lg-6">
                                    ' . $item->isbn . '
                                </div>
                            </div>
                            <div class="row bg-light">
                                <div class="col-lg-6">
                                    Dewey Number
                                </div>
                                <div class="col-lg-6">
                                    ' . $item->no_dewey . '
                                </div>
                            </div>
                            <div class="row bg-light">
                                <div class="col-lg-6">
                                    Pengarang
                                </div>
                                <div class="col-lg-6">
                                    ' . $item->pengarang . '
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    Penerbit
                                </div>
                                <div class="col-lg-6">
                                    ' . $item->penerbit . '
                                </div>
                            </div>
                            <div class="row bg-light">
                                <div class="col-lg-6">
                                    Tahun Terbit
                                </div>
                                <div class="col-lg-6">
                                    ' . $item->tahun_terbit . '
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    Kota Terbit
                                </div>
                                <div class="col-lg-6">
                                    ' . $item->kota_terbit . '
                                </div>
                            </div>
                            <div class="row bg-light">
                                <div class="col-lg-6">
                                    Bahasa
                                </div>
                                <div class="col-lg-6">
                                    ' . $item->nama_bahasa . '
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    CIRCTYPE
                                </div>
                                <div class="col-lg-6">
                                    ' . $item->nama_circ_type . '
                                </div>
                            </div>
                            <div class="row bg-light">
                                <div class="col-lg-6">
                                    Funding
                                </div>
                                <div class="col-lg-6">
                                    ' . $item->nama_funding . '
                                </div>
                            </div>
                            <div class="row bg-light">
                                <div class="col-lg-6">
                                    Sumber Koleksi
                                </div>
                                <div class="col-lg-6">
                                    ' . $item->nama_sumber . '
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    Author Abrev
                                </div>
                                <div class="col-lg-6">
                                    ' . $item->author_abrev . '
                                </div>
                            </div>
                            <div class="row bg-light">
                                <div class="col-lg-6">
                                    Title Abrev
                                </div>
                                <div class="col-lg-6">
                                    ' . $item->title_abrev . '
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    Volume
                                </div>
                                <div class="col-lg-6">
                                    ' . $item->volume . '
                                </div>
                            </div>
                            <div class="row bg-light">
                                <div class="col-lg-6">
                                    Kondisi Fisik
                                </div>
                                <div class="col-lg-6">
                                    ' . $item->kondisi_fisik . '
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    Bibliography
                                </div>
                                <div class="col-lg-6">
                                    ' . $item->bibliography . '
                                </div>
                            </div>
                            <div class="row bg-light">
                                <div class="col-lg-6">
                                    Subject
                                </div>
                                <div class="col-lg-6">
                                    ' . $item->subject . '
                                </div>
                            </div>
                            <div class="row pt-4">
                                <div class="col-lg-12 text-center">
                                    <img src="' . site_url('data/buku/QRcode/' . $item->register) . '">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            ';
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->M_sumbangan_buku->count_all($role_id),
            "recordsFiltered" => $this->M_sumbangan_buku->count_filtered($role_id),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }

    function get_ajax()
    {
        $role_id = $_POST['role_id'];
        $list = $this->M_sumbangan_buku->get_datatables($role_id);
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no . ".";
            $row[] = $item->register;
            $row[] = $item->judul_buku;
            $row[] = $item->nama;
            $date = date_create($item->tanggal_sumbangan);
            $row[] = date_format($date, "M d, Y");
            if ($item->status_sumbangan == 1) {
                $row[] = '<span class="badge bg-info">Diproses</span>';
            } else if ($item->status_sumbangan == 2) {
                $row[] = '<span class="badge bg-success">Diterima</span>';
            } else {
                $row[] = '<span class="badge bg-danger">Ditolak</span>';
            }
            // add html for action
            if ($item->status_sumbangan == 1) {
                $row[] = '<button class="btn btn-sm btn-default" data-toggle="modal" data-target="#btnDetailBuku' . $item->id_sumbangan . '"><i class="fa fa-info"></i></button>
                    <a href="' . site_url('sirkulasi/sumbangan_buku/terima_sumbangan/' . $item->id_sumbangan) . '" class="btn btn-sm btn-success"><i class="fa fa-check"></i></a>
                    <a href="' . site_url('sirkulasi/sumbangan_buku/tolak_sumbangan/' . $item->id_sumbangan) . '" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a>
                    <div class="modal fade" id="btnDetailBuku' . $item->id_sumbangan . '" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="btnDetailBukuLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="btnDetailBukuLabel">Detail Buku</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-lg-4 col-12">
                                            <img height="100" src="' . base_url('assets/sampul_buku/' . $item->sampul) . '">
                                        </div>
                                        <div class="col-lg-8 col-12">
                                            <h5>' . $item->judul_buku . '</h5>
                                            <p>' . $item->pengarang . '</p>
                                        </div>
                                    </div>
                                    <div class="row bg-light">
                                        <div class="col-lg-6">
                                            Register
                                        </div>
                                        <div class="col-lg-6">
                                            ' . $item->register . '
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            isbn
                                        </div>
                                        <div class="col-lg-6">
                                            ' . $item->isbn . '
                                        </div>
                                    </div>
                                    <div class="row bg-light">
                                        <div class="col-lg-6">
                                            Dewey Number
                                        </div>
                                        <div class="col-lg-6">
                                            ' . $item->no_dewey . '
                                        </div>
                                    </div>
                                    <div class="row bg-light">
                                        <div class="col-lg-6">
                                            Pengarang
                                        </div>
                                        <div class="col-lg-6">
                                            ' . $item->pengarang . '
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            Penerbit
                                        </div>
                                        <div class="col-lg-6">
                                            ' . $item->penerbit . '
                                        </div>
                                    </div>
                                    <div class="row bg-light">
                                        <div class="col-lg-6">
                                            Tahun Terbit
                                        </div>
                                        <div class="col-lg-6">
                                            ' . $item->tahun_terbit . '
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            Kota Terbit
                                        </div>
                                        <div class="col-lg-6">
                                            ' . $item->kota_terbit . '
                                        </div>
                                    </div>
                                    <div class="row bg-light">
                                        <div class="col-lg-6">
                                            Bahasa
                                        </div>
                                        <div class="col-lg-6">
                                            ' . $item->nama_bahasa . '
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            CIRCTYPE
                                        </div>
                                        <div class="col-lg-6">
                                            ' . $item->nama_circ_type . '
                                        </div>
                                    </div>
                                    <div class="row bg-light">
                                        <div class="col-lg-6">
                                            Funding
                                        </div>
                                        <div class="col-lg-6">
                                            ' . $item->nama_funding . '
                                        </div>
                                    </div>
                                    <div class="row bg-light">
                                        <div class="col-lg-6">
                                            Sumber Koleksi
                                        </div>
                                        <div class="col-lg-6">
                                            ' . $item->nama_sumber . '
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            Author Abrev
                                        </div>
                                        <div class="col-lg-6">
                                            ' . $item->author_abrev . '
                                        </div>
                                    </div>
                                    <div class="row bg-light">
                                        <div class="col-lg-6">
                                            Title Abrev
                                        </div>
                                        <div class="col-lg-6">
                                            ' . $item->title_abrev . '
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            Volume
                                        </div>
                                        <div class="col-lg-6">
                                            ' . $item->volume . '
                                        </div>
                                    </div>
                                    <div class="row bg-light">
                                        <div class="col-lg-6">
                                            Kondisi Fisik
                                        </div>
                                        <div class="col-lg-6">
                                            ' . $item->kondisi_fisik . '
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            Bibliography
                                        </div>
                                        <div class="col-lg-6">
                                            ' . $item->bibliography . '
                                        </div>
                                    </div>
                                    <div class="row bg-light">
                                        <div class="col-lg-6">
                                            Subject
                                        </div>
                                        <div class="col-lg-6">
                                            ' . $item->subject . '
                                        </div>
                                    </div>
                                    <div class="row pt-4">
                                        <div class="col-lg-12 text-center">
                                            <img src="' . site_url('data/buku/QRcode/' . $item->register) . '">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
            } else {
                $row[] = '<button class="btn btn-sm btn-default" data-toggle="modal" data-target="#btnDetailBuku' . $item->id_sumbangan . '"><i class="fa fa-info"></i></button>
                    <a href="' . site_url('sirkulasi/sumbangan_buku/batal_sumbangan/' . $item->id_sumbangan) . '" class="btn btn-sm btn-warning text-white">Batalkan</a>
                    <div class="modal fade" id="btnDetailBuku' . $item->id_sumbangan . '" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="btnDetailBukuLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="btnDetailBukuLabel">Detail Buku</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-lg-4 col-12">
                                            <img height="100" src="' . base_url('assets/sampul_buku/' . $item->sampul) . '">
                                        </div>
                                        <div class="col-lg-8 col-12">
                                            <h5>' . $item->judul_buku . '</h5>
                                            <p>' . $item->pengarang . '</p>
                                        </div>
                                    </div>
                                    <div class="row bg-light">
                                        <div class="col-lg-6">
                                            Register
                                        </div>
                                        <div class="col-lg-6">
                                            ' . $item->register . '
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            isbn
                                        </div>
                                        <div class="col-lg-6">
                                            ' . $item->isbn . '
                                        </div>
                                    </div>
                                    <div class="row bg-light">
                                        <div class="col-lg-6">
                                            Dewey Number
                                        </div>
                                        <div class="col-lg-6">
                                            ' . $item->no_dewey . '
                                        </div>
                                    </div>
                                    <div class="row bg-light">
                                        <div class="col-lg-6">
                                            Pengarang
                                        </div>
                                        <div class="col-lg-6">
                                            ' . $item->pengarang . '
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            Penerbit
                                        </div>
                                        <div class="col-lg-6">
                                            ' . $item->penerbit . '
                                        </div>
                                    </div>
                                    <div class="row bg-light">
                                        <div class="col-lg-6">
                                            Tahun Terbit
                                        </div>
                                        <div class="col-lg-6">
                                            ' . $item->tahun_terbit . '
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            Kota Terbit
                                        </div>
                                        <div class="col-lg-6">
                                            ' . $item->kota_terbit . '
                                        </div>
                                    </div>
                                    <div class="row bg-light">
                                        <div class="col-lg-6">
                                            Bahasa
                                        </div>
                                        <div class="col-lg-6">
                                            ' . $item->nama_bahasa . '
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            CIRCTYPE
                                        </div>
                                        <div class="col-lg-6">
                                            ' . $item->nama_circ_type . '
                                        </div>
                                    </div>
                                    <div class="row bg-light">
                                        <div class="col-lg-6">
                                            Funding
                                        </div>
                                        <div class="col-lg-6">
                                            ' . $item->nama_funding . '
                                        </div>
                                    </div>
                                    <div class="row bg-light">
                                        <div class="col-lg-6">
                                            Sumber Koleksi
                                        </div>
                                        <div class="col-lg-6">
                                            ' . $item->nama_sumber . '
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            Author Abrev
                                        </div>
                                        <div class="col-lg-6">
                                            ' . $item->author_abrev . '
                                        </div>
                                    </div>
                                    <div class="row bg-light">
                                        <div class="col-lg-6">
                                            Title Abrev
                                        </div>
                                        <div class="col-lg-6">
                                            ' . $item->title_abrev . '
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            Volume
                                        </div>
                                        <div class="col-lg-6">
                                            ' . $item->volume . '
                                        </div>
                                    </div>
                                    <div class="row bg-light">
                                        <div class="col-lg-6">
                                            Kondisi Fisik
                                        </div>
                                        <div class="col-lg-6">
                                            ' . $item->kondisi_fisik . '
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            Bibliography
                                        </div>
                                        <div class="col-lg-6">
                                            ' . $item->bibliography . '
                                        </div>
                                    </div>
                                    <div class="row bg-light">
                                        <div class="col-lg-6">
                                            Subject
                                        </div>
                                        <div class="col-lg-6">
                                            ' . $item->subject . '
                                        </div>
                                    </div>
                                    <div class="row pt-4">
                                        <div class="col-lg-12 text-center">
                                            <img src="' . site_url('data/buku/QRcode/' . $item->register) . '">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';
            }

            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->M_sumbangan_buku->count_all($role_id),
            "recordsFiltered" => $this->M_sumbangan_buku->count_filtered($role_id),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }

    function get_ajax_anggota()
    {
        $role_id = $_POST['role_id'];
        $username = $_POST['username'];
        $list = $this->M_sumbangan_buku->get_datatables($role_id, $username);
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no . ".";
            $row[] = $item->register;
            $row[] = $item->judul_buku;
            $row[] = $item->nama;
            $date = date_create($item->tanggal_sumbangan);
            $row[] = date_format($date, "M d, Y");
            if ($item->status_sumbangan == 1) {
                $row[] = '<span class="badge bg-info">Diproses</span>';
            } else if ($item->status_sumbangan == 2) {
                $row[] = '<span class="badge bg-success">Diterima</span>';
            } else {
                $row[] = '<span class="badge bg-danger">Ditolak</span>';
            }
            // add html for action
            $row[] = '<button class="btn btn-sm btn-default" data-toggle="modal" data-target="#btnDetailBuku' . $item->id_sumbangan . '"><i class="fa fa-info"></i></button>
                <a href="' . site_url('sirkulasi/sumbangan_buku/ubah/' . $item->id_sumbangan) . '" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
                <a href="' . site_url('sirkulasi/sumbangan_buku/deleteDataSumbanganAdmin/' . $item->id_sumbangan . '/' . $item->register) . '" class="btn btn-sm btn btn-danger mr-2" title="Hapus Data Ini" onclick="return confirm(/"ANDA YAKIN AKAN MENGHAPUS DATA PENTING INI ... ?/")"><i class="fa fa-trash"></i></a>
                <div class="modal fade" id="btnDetailBuku' . $item->id_sumbangan . '" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="btnDetailBukuLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="btnDetailBukuLabel">Detail Buku</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-lg-4 col-12 text-center">
                                        <img height="100" src="' . base_url('assets/sampul_buku/' . $item->sampul) . '">
                                    </div>
                                    <div class="col-lg-8 col-12">
                                        <h5>' . $item->judul_buku . '</h5>
                                        <p>' . $item->pengarang . '</p>
                                    </div>
                                </div>
                                <div class="row bg-light">
                                    <div class="col-lg-6">
                                        Register
                                    </div>
                                    <div class="col-lg-6">
                                        ' . $item->register . '
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        isbn
                                    </div>
                                    <div class="col-lg-6">
                                        ' . $item->isbn . '
                                    </div>
                                </div>
                                <div class="row bg-light">
                                    <div class="col-lg-6">
                                        Dewey Number
                                    </div>
                                    <div class="col-lg-6">
                                        ' . $item->no_dewey . '
                                    </div>
                                </div>
                                <div class="row bg-light">
                                    <div class="col-lg-6">
                                        Pengarang
                                    </div>
                                    <div class="col-lg-6">
                                        ' . $item->pengarang . '
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        Penerbit
                                    </div>
                                    <div class="col-lg-6">
                                        ' . $item->penerbit . '
                                    </div>
                                </div>
                                <div class="row bg-light">
                                    <div class="col-lg-6">
                                        Tahun Terbit
                                    </div>
                                    <div class="col-lg-6">
                                        ' . $item->tahun_terbit . '
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        Kota Terbit
                                    </div>
                                    <div class="col-lg-6">
                                        ' . $item->kota_terbit . '
                                    </div>
                                </div>
                                <div class="row bg-light">
                                    <div class="col-lg-6">
                                        Bahasa
                                    </div>
                                    <div class="col-lg-6">
                                        ' . $item->nama_bahasa . '
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        CIRCTYPE
                                    </div>
                                    <div class="col-lg-6">
                                        ' . $item->nama_circ_type . '
                                    </div>
                                </div>
                                <div class="row bg-light">
                                    <div class="col-lg-6">
                                        Funding
                                    </div>
                                    <div class="col-lg-6">
                                        ' . $item->nama_funding . '
                                    </div>
                                </div>
                                <div class="row bg-light">
                                    <div class="col-lg-6">
                                        Sumber Koleksi
                                    </div>
                                    <div class="col-lg-6">
                                        ' . $item->nama_sumber . '
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        Author Abrev
                                    </div>
                                    <div class="col-lg-6">
                                        ' . $item->author_abrev . '
                                    </div>
                                </div>
                                <div class="row bg-light">
                                    <div class="col-lg-6">
                                        Title Abrev
                                    </div>
                                    <div class="col-lg-6">
                                        ' . $item->title_abrev . '
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        Volume
                                    </div>
                                    <div class="col-lg-6">
                                        ' . $item->volume . '
                                    </div>
                                </div>
                                <div class="row bg-light">
                                    <div class="col-lg-6">
                                        Kondisi Fisik
                                    </div>
                                    <div class="col-lg-6">
                                        ' . $item->kondisi_fisik . '
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        Bibliography
                                    </div>
                                    <div class="col-lg-6">
                                        ' . $item->bibliography . '
                                    </div>
                                </div>
                                <div class="row bg-light">
                                    <div class="col-lg-6">
                                        Subject
                                    </div>
                                    <div class="col-lg-6">
                                        ' . $item->subject . '
                                    </div>
                                </div>
                                <div class="row pt-4">
                                    <div class="col-lg-12 text-center">
                                        <img src="' . site_url('data/buku/QRcode/' . $item->register) . '">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';

            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->M_sumbangan_buku->count_all($role_id, $username),
            "recordsFiltered" => $this->M_sumbangan_buku->count_filtered($role_id, $username),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }


    public function QRcode($register)
    {
        QRcode::png(
            $register,
            $outfile = false,
            $level = QR_ECLEVEL_H,
            $size = 5,
            $margin = 2
        );
    }

    public function index()
    {
        $data['title'] = 'Daftar Sumber Koleksi | Portal FH';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('page/sumbangan_buku');
        $this->load->view('templates/footer');
    }

    public function admin()
    {
        $data['title'] = 'Daftar Sumber Koleksi | Portal FH';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/list_sumbangan_buku_admin');
        $this->load->view('templates/footer');
    }

    public function tambah_sumbangan_buku_admin()
    {
        $data['title'] = 'Daftar Sumber Koleksi | Portal FH';
        $data_sumbangan_buku = $this->M_sumbangan_buku->getData();
        $data_bahasa = $this->M_katalog_buku->getBahasa();
        $data_circ = $this->M_katalog_buku->getCirc();
        $data_funding = $this->M_katalog_buku->getFunding();
        $data_sumber = $this->M_katalog_buku->getSumber();
        $data_kategori = $this->M_katalog_buku->getKategori();
        $data_jenis_akses = $this->M_katalog_buku->getJenisAkses();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/add_sumbangan_buku_admin', array('data_sumbangan_buku' => $data_sumbangan_buku, 'data_bahasa' => $data_bahasa, 'data_circ' => $data_circ, 'data_funding' => $data_funding, 'data_sumber' => $data_sumber, 'data_kategori' => $data_kategori, 'data_jenis_akses' => $data_jenis_akses));
        $this->load->view('templates/footer');
    }

    public function terima_sumbangan($id_sumbangan)
    {
        $res = $this->M_sumbangan_buku->terima_sumbangan($id_sumbangan);
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data berhasil diubah');
            redirect('sirkulasi/sumbangan_buku/admin');
        } else {
            $this->session->set_flashdata('warning', 'Gagal mengubah data');
            redirect('sirkulasi/sumbangan_buku/admin');
        }
    }

    public function tolak_sumbangan($id_sumbangan)
    {
        $res = $this->M_sumbangan_buku->tolak_sumbangan($id_sumbangan);
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data berhasil diubah');
            redirect('sirkulasi/sumbangan_buku/admin');
        } else {
            $this->session->set_flashdata('warning', 'Gagal mengubah data');
            redirect('sirkulasi/sumbangan_buku/admin');
        }
    }

    public function batal_sumbangan($id_sumbangan)
    {
        $res = $this->M_sumbangan_buku->batal_sumbangan($id_sumbangan);
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data berhasil diubah');
            redirect('sirkulasi/sumbangan_buku/admin');
        } else {
            $this->session->set_flashdata('warning', 'Gagal mengubah data');
            redirect('sirkulasi/sumbangan_buku/admin');
        }
    }

    public function addDataSumbanganAdmin()
    {
        $res = $this->M_sumbangan_buku->insertData();
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data berhasil ditambahkan');
            redirect('sirkulasi/sumbangan_buku/admin');
        } else {
            $this->session->set_flashdata('warning', 'Gagal menambahkan data');
            redirect('sirkulasi/sumbangan_buku/tambah_sumbangan_buku_admin');
        }
    }

    public function deleteDataSumbanganAdmin($id_sumbangan, $register)
    {
        $res = $this->M_sumbangan_buku->deleteDataSumbangan($id_sumbangan, $register);
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
            redirect('sirkulasi/sumbangan_buku/admin');
        } else {
            $this->session->set_flashdata('warning', 'Gagal menghapus data');
            redirect('sirkulasi/sumbangan_buku/admin');
        }
    }

    public function tambah_sumbangan_buku()
    {
        $data['title'] = 'Daftar Sumber Koleksi | Portal FH';
        $data_sumbangan_buku = $this->M_sumbangan_buku->getData();
        $data_bahasa = $this->M_katalog_buku->getBahasa();
        $data_circ = $this->M_katalog_buku->getCirc();
        $data_funding = $this->M_katalog_buku->getFunding();
        $data_sumber = $this->M_katalog_buku->getSumber();
        $data_kategori = $this->M_katalog_buku->getKategori();
        $data_jenis_akses = $this->M_katalog_buku->getJenisAkses();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('page/add_sumbangan_buku', array('data_sumbangan_buku' => $data_sumbangan_buku, 'data_bahasa' => $data_bahasa, 'data_circ' => $data_circ, 'data_funding' => $data_funding, 'data_sumber' => $data_sumber, 'data_kategori' => $data_kategori, 'data_jenis_akses' => $data_jenis_akses));
        $this->load->view('templates/footer');
    }

    public function addDataSumbangan()
    {
        $res = $this->M_sumbangan_buku->insertData();
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data berhasil ditambahkan');
            redirect('sirkulasi/sumbangan_buku');
        } else {
            $this->session->set_flashdata('warning', 'Gagal menambahkan data');
            redirect('sirkulasi/sumbangan_buku/tambah_sumbangan_buku');
        }
    }

    public function deleteDataSumbangan($id_sumbangan, $register)
    {
        $res = $this->M_sumbangan_buku->deleteDataSumbangan($id_sumbangan, $register);
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
            redirect('sirkulasi/sumbangan_buku');
        } else {
            $this->session->set_flashdata('warning', 'Gagal menghapus data');
            redirect('sirkulasi/sumbangan_buku');
        }
    }
}
