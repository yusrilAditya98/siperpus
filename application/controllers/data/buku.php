<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Buku extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('Ciqrcode');
        $this->load->model('m_katalog_buku');
        is_logged_in();
    }

    function get_ajax_admin()
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
            // add html for action
            $row[] = '<button class="btn btn-sm btn-default" data-toggle="modal" data-target="#btnDetailBuku' . $item->register . '"><i class="fa fa-info"></i></button>
            <a href="' . site_url('data/buku/ubah/' . $item->register) . '" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
            <a href="' . site_url('data/buku/deleteDataBuku/' . $item->register) . '" class="btn btn-sm btn btn-danger mr-2" title="Hapus Data Ini" onclick="return confirm(/"ANDA YAKIN AKAN MENGHAPUS DATA PENTING INI ... ?/")"><i class="fa fa-trash"></i></a>
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
            "recordsTotal" => $this->m_katalog_buku->count_all(),
            "recordsFiltered" => $this->m_katalog_buku->count_filtered(),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }

    function get_ajax()
    {
        $temp_role_id = $_POST['role_id'];
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
            // add html for action
            $temp = '<button class="btn btn-sm btn-default" data-toggle="modal" data-target="#btnDetailBuku' . $item->register . '"><i class="fa fa-info"></i></button>';
            $temp_btn_pinjam = "";
            if ($temp_role_id == "role_id_2") {
                $temp_btn_pinjam = '<a href="../../sirkulasi/peminjaman/pinjam/' . $item->register . '" class="btn btn-sm btn-success"><i class="fas fa-cart-plus"></i> Pinjam</a>';
            }

            $row[] = $temp . " " . $temp_btn_pinjam . ' <div class="modal fade" id="btnDetailBuku' . $item->register . '" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="btnDetailBukuLabel" aria-hidden="true">
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
        $data['title'] = 'Daftar Sumber Koleksi | Portal FH';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('page/katalog_buku');
        $this->load->view('templates/footer');
    }

    public function buku_anggota()
    {
        $data['title'] = 'Daftar Sumber Koleksi | Portal FH';
        $data_katalog_buku = $this->m_katalog_buku->getData();
        $data_bahasa = $this->m_katalog_buku->getBahasa();
        $data_circ = $this->m_katalog_buku->getCirc();
        $data_funding = $this->m_katalog_buku->getFunding();
        $data['buku_dipinjam'] = count($this->db->where(['jenis_sirkulasi' => 1, 'status_sirkulasi' => 0])->from('sirkulasi')->join('buku', 'buku.register = sirkulasi.b_register')->get()->result_array());

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('page/katalog_buku_anggota', array('data_katalog_buku' => $data_katalog_buku, 'data_bahasa' => $data_bahasa, 'data_circ' => $data_circ, 'data_funding' => $data_funding));
        $this->load->view('templates/footer');
    }

    public function list_buku()
    {
        $data['title'] = 'Daftar Buku | Portal FH';
        $data_katalog_buku = $this->m_katalog_buku->getData();
        $data_bahasa = $this->m_katalog_buku->getBahasa();
        $data_circ = $this->m_katalog_buku->getCirc();
        $data_funding = $this->m_katalog_buku->getFunding();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('page/katalog_buku', array('data_katalog_buku' => $data_katalog_buku, 'data_bahasa' => $data_bahasa, 'data_circ' => $data_circ, 'data_funding' => $data_funding));
        $this->load->view('templates/footer');
    }

    public function katalog_buku_admin()
    {
        $data['title'] = 'Daftar Sumber Koleksi | Portal FH';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/katalog_buku_admin');
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['title'] = 'Daftar Sumber Koleksi | Portal FH';

        $data_katalog_buku = $this->m_katalog_buku->getData();
        $data_bahasa = $this->m_katalog_buku->getBahasa();
        $data_circ = $this->m_katalog_buku->getCirc();
        $data_funding = $this->m_katalog_buku->getFunding();
        $data_sumber = $this->m_katalog_buku->getSumber();
        $data_kategori = $this->m_katalog_buku->getKategori();
        $data_jenis_akses = $this->m_katalog_buku->getJenisAkses();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/data/tambah_buku', array('data_katalog_buku' => $data_katalog_buku, 'data_bahasa' => $data_bahasa, 'data_circ' => $data_circ, 'data_funding' => $data_funding, 'data_sumber' => $data_sumber, 'data_kategori' => $data_kategori, 'data_jenis_akses' => $data_jenis_akses));
        $this->load->view('templates/footer');
    }

    public function ubah($register)
    {
        $data['title'] = 'Daftar Sumber Koleksi | Portal FH';

        $data_katalog_buku = $this->m_katalog_buku->getData($register);
        $data_bahasa = $this->m_katalog_buku->getBahasa();
        $data_circ = $this->m_katalog_buku->getCirc();
        $data_funding = $this->m_katalog_buku->getFunding();
        $data_sumber = $this->m_katalog_buku->getSumber();
        $data_kategori = $this->m_katalog_buku->getKategori();
        $data_jenis_akses = $this->m_katalog_buku->getJenisAkses();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/data/ubah_buku', array('data_katalog_buku' => $data_katalog_buku, 'data_bahasa' => $data_bahasa, 'data_circ' => $data_circ, 'data_funding' => $data_funding, 'data_sumber' => $data_sumber, 'data_kategori' => $data_kategori, 'data_jenis_akses' => $data_jenis_akses));
        $this->load->view('templates/footer');
    }

    public function addDataBuku()
    {
        $res = $this->m_katalog_buku->insertDataBuku();
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data berhasil ditambahkan');
            redirect('data/buku/katalog_buku_admin');
        } else {
            $this->session->set_flashdata('warning', 'Gagal menambahkan data');
            redirect('data/buku/katalog_buku_admin');
        }
    }

    public function ubahDataBuku()
    {
        $res = $this->m_katalog_buku->updateDataBuku();
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data berhasil diubah');
            redirect('data/buku/katalog_buku_admin');
        } else {
            $this->session->set_flashdata('warning', 'Gagal mengubah data');
            redirect('data/buku/katalog_buku_admin');
        }
    }

    public function deleteDataBuku($register)
    {
        $res = $this->m_katalog_buku->deleteDataBuku($register);
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
            redirect('data/buku/katalog_buku_admin');
        } else {
            $this->session->set_flashdata('warning', 'Gagal menghapus data');
            redirect('data/buku/katalog_buku_admin');
        }
    }


    public function addData()
    {
        $res = $this->m_katalog_buku->insertData();
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data berhasil ditambahkan');
            redirect('data/buku');
        } else {
            $this->session->set_flashdata('warning', 'Gagal menambahkan data');
            redirect('data/buku');
        }
    }

    public function updateData()
    {
        $res = $this->m_katalog_buku->updateData();
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data berhasil diubah');
            redirect('data/buku');
        } else {
            $this->session->set_flashdata('warning', 'Gagal mengubah data');
            redirect('data/buku');
        }
    }

    function deleteData($id_katalog_buku)
    {
        $res = $this->m_katalog_buku->deleteData($id_katalog_buku);
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
            redirect('data/buku');
        } else {
            $this->session->set_flashdata('warning', 'Gagal menghapus data');
            redirect('data/buku');
        }
    }

    public function opac()
    {
        $data['title'] = 'Daftar Sumber Koleksi | Portal FH';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('page/opac');
        $this->load->view('templates/footer');
    }

    function get_ajax_opac($keywords, $filter)
    {
        $list = $this->m_katalog_buku->get_datatables($keywords, $filter);
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
            $row[] = '<button class="btn btn-sm btn-default" data-toggle="modal" data-target="#btnDetailBuku' . $item->register . '"><i class="fa fa-info"></i></button>
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
            "recordsTotal" => $this->m_katalog_buku->count_all($keywords, $filter),
            "recordsFiltered" => $this->m_katalog_buku->count_filtered($keywords, $filter),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }

    public function cariOpac()
    {
        $keywords = $_POST['keywords'];
        $filter = $_POST['filter'];
        $this->get_ajax_opac($keywords, $filter);
    }
}
