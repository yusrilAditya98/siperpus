<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Welcome extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('Ciqrcode');
        $this->load->model('M_katalog_buku');
    }
    function get_ajax()
    {
        $list = $this->M_katalog_buku->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no . ".";
            $row[] = $item->register;
            $row[] = $item->judul_buku;
            $row[] = $item->pengarang;
            $row[] = $item->penerbit;
            $row[] = $item->tahun_terbit;
            // add html for action
            $row[] = '<button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#btnDetailBuku' . $item->register . '"><i class="fa fa-info"></i></button>
            <div class="modal fade" id="btnDetailBuku' . $item->register . '" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="btnDetailBukuLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="btnDetailBukuLabel">Detail Buku</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <div class="row text-left">
                        <div class="col-sm-4 col-12">
                            <img class="img-thumbnail" src="' . base_url('assets/sampul_buku/' . $item->sampul) . '">
                            <div class="row pt-4">
                            <div class="col-lg-12 text-center">
                                <img src="' . site_url('Welcome/QRcode/' . $item->register) . '">
                            </div>
                        </div>
                        </div>
                        <div class="col-sm-8 col-12">
                            <h5>' . $item->judul_buku . '</h5>
                            <p>' . $item->pengarang . '</p>
                            <div class="row bg-light">
                            <div class="col-sm-6">
                                Register
                            </div>
                            <div class="col-sm-6">
                                ' . $item->register . '
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                isbn
                            </div>
                            <div class="col-sm-6">
                                ' . $item->isbn . '
                            </div>
                        </div>
                        <div class="row bg-light">
                            <div class="col-sm-6">
                                Dewey Number
                            </div>
                            <div class="col-sm-6">
                                ' . $item->no_dewey . '
                            </div>
                        </div>
                        <div class="row bg-light">
                            <div class="col-sm-6">
                                Pengarang
                            </div>
                            <div class="col-sm-6">
                                ' . $item->pengarang . '
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                Penerbit
                            </div>
                            <div class="col-sm-6">
                                ' . $item->penerbit . '
                            </div>
                        </div>
                        <div class="row bg-light">
                            <div class="col-sm-6">
                                Tahun Terbit
                            </div>
                            <div class="col-sm-6">
                                ' . $item->tahun_terbit . '
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                Kota Terbit
                            </div>
                            <div class="col-sm-6">
                                ' . $item->kota_terbit . '
                            </div>
                        </div>
                        <div class="row bg-light">
                            <div class="col-sm-6">
                                Bahasa
                            </div>
                            <div class="col-sm-6">
                                ' . $item->nama_bahasa . '
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                CIRCTYPE
                            </div>
                            <div class="col-sm-6">
                                ' . $item->nama_circ_type . '
                            </div>
                        </div>
                        <div class="row bg-light">
                            <div class="col-sm-6">
                                Funding
                            </div>
                            <div class="col-sm-6">
                                ' . $item->nama_funding . '
                            </div>
                        </div>
                        <div class="row bg-light">
                            <div class="col-sm-6">
                                Sumber Koleksi
                            </div>
                            <div class="col-sm-6">
                                ' . $item->nama_sumber . '
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                Author Abrev
                            </div>
                            <div class="col-sm-6">
                                ' . $item->author_abrev . '
                            </div>
                        </div>
                        <div class="row bg-light">
                            <div class="col-sm-6">
                                Title Abrev
                            </div>
                            <div class="col-sm-6">
                                ' . $item->title_abrev . '
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                Volume
                            </div>
                            <div class="col-sm-6">
                                ' . $item->volume . '
                            </div>
                        </div>
                        <div class="row bg-light">
                            <div class="col-sm-6">
                                Kondisi Fisik
                            </div>
                            <div class="col-sm-6">
                                ' . $item->kondisi_fisik . '
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                Bibliography
                            </div>
                            <div class="col-sm-6">
                                ' . $item->bibliography . '
                            </div>
                        </div>
                        <div class="row bg-light">
                            <div class="col-sm-6">
                                Subject
                            </div>
                            <div class="col-sm-6">
                                ' . $item->subject . '
                            </div>
                        </div>
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
            "recordsTotal" => $this->M_katalog_buku->count_all(),
            "recordsFiltered" => $this->M_katalog_buku->count_filtered(),
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
        $data['title'] = "Welcome - Siperpus";
        $this->load->view('welcome/landing_page', $data);
    }
}
