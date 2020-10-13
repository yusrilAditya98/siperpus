<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Baca_ditmpt extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('form_validation');
        $this->load->library('Ciqrcode');
        $this->load->model('m_katalog_buku');
        $this->load->model('m_sirkulasi', 'sirkulasi');
        is_logged_in();
    }
    function get_ajax()
    {
        $list = $this->m_katalog_buku->get_datatables();
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
            if ($item->status_buku == 1) {
                $row[] = '<span class="badge badge-success">tersedia</span>';
            } else {
                $row[] = '<span class="badge badge-secondary">dipinjam</span>';
            }

            // add html for action
            $row[] = '<div class="btn-group"><button class="btn btn-sm btn-default" data-toggle="modal" data-target="#btnDetailBuku' . $item->register . '"><i class="fa fa-info"></i></button><a class="btn btn-sm btn-success" href="' . base_url('sirkulasi/baca_ditmpt/tambah/' . $item->register) . '"><i class="fa fa-plus"></i></a></div>
            <div class="modal fade" id="btnDetailBuku' . $item->register . '" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="btnDetailBukuLabel" aria-hidden="true">
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
                                    <img src="' . base_url('assets/sampul_buku/' . $item->sampul) . '">
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
                                    <img src="' . site_url('sirkulasi/baca_ditmpt/QRcode/' . $item->register) . '">
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
            "recordsTotal" => $this->m_katalog_buku->count_all(),
            "recordsFiltered" => $this->m_katalog_buku->count_filtered(),
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
        $username = $this->session->userdata('username');
        $data['title'] = "Baca Ditempat";
        $data['baca_ditempat'] = $this->sirkulasi->listBukuBaca($username, 'terkini');
        $data['riwayat_baca'] = $this->sirkulasi->listBukuBaca($username, 'riwayat');
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('baca_ditempat/pengajuan_baca_ditempat');
        $this->load->view('templates/footer');
    }

    public function tambah($register)
    {
        // memeriksa apakah buku telah dilakuakn pengajuan apa belum dengan status tidak sedang dipinjam
        $cek = $this->sirkulasi->cekBacaDitempat($register);
        if ($cek) {
            $this->sirkulasi->insertBacaDitempat($register);
            $this->session->set_flashdata('success', 'Data berhasil ditambah');
        } else {
            $this->session->set_flashdata('danger', 'Data gagal ditambah');
        }
        redirect('sirkulasi/baca_ditmpt');
    }

    public function hapus($id_baca)
    {
        $this->db->delete('sirkulasi', ['id_sirkulasi' => $id_baca]);
        $this->session->set_flashdata('success', 'Data berhasil dihapus');
        redirect('sirkulasi/baca_ditmpt');
    }

    public function pengajuan()
    {
        $username = $this->session->userdata('username');
        $this->sirkulasi->updateBacaDiTempat($username);
        $this->session->set_flashdata('success', 'Buku bacaan berhasil diajukan');
        redirect('sirkulasi/baca_ditmpt');
    }
}
