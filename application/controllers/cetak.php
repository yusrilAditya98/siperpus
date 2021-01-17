<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Cetak extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_cetak');
        $this->load->model('M_user');
        $this->load->library('Zend');
        $this->load->library('Ciqrcode');
        $this->load->model('M_katalog_buku');
        $this->load->model('M_petugas');
        $this->load->model('M_kop_surat');
        is_logged_in();
    }

    public function QRcode($register)
    {
        QRcode::png(
            $register,
            $outfile = false,
            $level = QR_ECLEVEL_H,
            $size = 12,
            $margin = 2
        );
    }
    public function QRtransak($register)
    {
        $transaksi = base_url('Cetak/cetak_transaksi/' . $register);
        QRcode::png(
            $transaksi,
            $outfile = false,
            $level = QR_ECLEVEL_H,
            $size = 12,
            $margin = 2
        );
    }
    public function Barcode($register)
    {
        $this->zend->load('Zend/Barcode');
        Zend_Barcode::render('code128', 'image', array('text' => $register));
    }

    function get_katalog()
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
            if ($item->status_buku == 1) {
                $row[] = '<span class="badge badge-success">tersedia</span>';
            } else {
                $row[] = '<span class="badge badge-secondary">dipinjam</span>';
            }
            // add html for action
            $temp = '<button class="btn btn-sm btn-default" data-toggle="modal" data-target="#btnDetailBuku' . $item->register . '"><i class="fa fa-info"></i></button>';
            // $temp_btn_pinjam = '<a href="" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Cetak</a>';
            $temp_btn_cetak = '<input type="hidden" class="form-control" name="register" id="register' . $item->register . '" value="' . $item->register . '" required>
            <span class="input-group-append">
                <button type="button" id="tambah_cetak' . $item->register . '" class="btn btn-success btn-sm"><i class="fas fa-plus mr-2"></i>Cetak</button>
            </span>';

            $row[] = $temp . " " . $temp_btn_cetak . ' <div class="modal fade" id="btnDetailBuku' . $item->register . '" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="btnDetailBukuLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="btnDetailBukuLabel">Detail Buku</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-4 col-12">
                            <img class="img-thumbnail" src="' . base_url('assets/sampul_buku/' . $item->sampul) . '">
                            <div class="row pt-4">
                            <div class="col-lg-12 text-center">
                                <img src="' . site_url('data/buku/QRcode/' . $item->register) . '">
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
        </div>
        ';
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

    function get_data_cetak()
    {
        $list = $this->M_cetak->get_datatables();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no . ".";
            $row[] = $item->register;
            $row[] = $item->judul_buku;
            $row[] = $item->pengarang;
            $row[] = ' <button type="button" id="btn_delete' . $item->id_cetak . '" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>';

            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->M_cetak->count_all(),
            "recordsFiltered" => $this->M_cetak->count_filtered(),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }

    function get_status_mahasiswa()
    {
        $list = $this->M_cetak->get_datatables2();
        $data = array();
        $no = @$_POST['start'];
        $mhs = [];
        $mhs_sirkulasi = [];
        $daftar_buku = [];
        $status = [];

        foreach ($list as $item) {
            $mhs[] = $item->username;
        }
        $mhs = array_unique($mhs);
        sort($mhs);
        // echo var_dump($mhs);
        // echo "<br>";
        // echo "<br>";
        for ($i = 0; $i < count($mhs); $i++) {
            $cek_sirkulasi = $this->M_cetak->getDataSirkulasi(null, $mhs[$i]);
            foreach ($cek_sirkulasi as $item) {
                $status[$mhs[$i]][] = $item['id_sirkulasi'] . "-" . $item['status_sirkulasi'];
                if ($item['status_sirkulasi'] == 6) {
                    $cek_pelanggaran = $this->M_cetak->getDataSirkulasiPelanggaran($item['id_sirkulasi']);
                    if ($cek_pelanggaran[0]['status_pelanggaran'] == 1) {
                        $mhs_sirkulasi[] = $item['u_username'];
                        $daftar_buku[$item['u_username']][] = $item['b_register'] . "/" . $item['status_sirkulasi'];
                    }
                }
                if ($item['status_sirkulasi'] == 4 || $item['status_sirkulasi'] == 9) {
                    $mhs_sirkulasi[] = $item['u_username'];
                    $daftar_buku[$item['u_username']][] = $item['b_register'] . "/" . $item['status_sirkulasi'];
                }
            }
        }
        $mhs_sirkulasi = array_unique($mhs_sirkulasi);
        sort($mhs_sirkulasi);
        // echo var_dump($daftar_buku);
        // echo "<br>";
        // echo "<br>";
        // echo var_dump($mhs_sirkulasi);
        // echo "<br>";
        // echo "<br>";
        $buku = [];
        $temp_buku = [];
        for ($i = 0; $i < count($mhs_sirkulasi); $i++) {
            for ($z = 0; $z < count($daftar_buku[$mhs_sirkulasi[$i]]); $z++) {
                $temp_daftar_buku[$mhs_sirkulasi[$i]][$z] = explode("/", $daftar_buku[$mhs_sirkulasi[$i]][$z]);
                $status_buku = '';
                if ($temp_daftar_buku[$mhs_sirkulasi[$i]][$z][1] == 4 || $temp_daftar_buku[$mhs_sirkulasi[$i]][$z][1] == 9) {
                    $status_buku = '<span class="badge bg-warning">Masih di pinjam</span>';
                } else {
                    $status_buku = '<span class="badge bg-danger">Belum menyelesaikan pelanggaran buku</span>';
                }
                $nama_buku = $this->M_katalog_buku->getData($temp_daftar_buku[$mhs_sirkulasi[$i]][$z][0]);
                $buku[$mhs_sirkulasi[$i]][] = "- " . $nama_buku[0]['judul_buku'] . " => " . $status_buku;
            }
        }
        // echo var_dump($buku);
        // echo "<br>";
        // echo "<br>";
        for ($i = 0; $i < count($mhs_sirkulasi); $i++) {
            $temp_buku[$mhs_sirkulasi[$i]] = implode("<br>", $buku[$mhs_sirkulasi[$i]]);
        }
        // echo var_dump($temp_buku);
        // echo "<br>";
        // echo "<br>";


        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no . ".";
            $row[] = $item->username;
            $row[] = $item->nama;
            if (in_array($item->username, $mhs_sirkulasi)) {
                $row[] = '<span class="badge bg-warning">Ada Tanggungan</span>';
                $row[] = '
                    <button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#staticBackdrop">
                        <i class="fas fa-info"></i>
                    </button>
                    <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Daftar Buku</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                ' . $temp_buku[$item->username] . '
                            </div>
                        </div>
                    </div>
                    </div>

                ';
                $row[] = '<a target="_blank" href="' . site_url() . 'Cetak/bebas_pustaka_view/' . $item->username . '/tanggungan" id="cetak_pustaka' . $item->username . '" class="btn btn-success btn-block">Cetak</a>';
            } else {
                $row[] = '<span class="badge bg-success">Bebas Tanggungan</span>';
                $row[] = '<span class="badge bg-success"><i class="fas fa-check"></i></span>';
                $row[] = '<a target="_blank" href="' . site_url() . 'Cetak/bebas_pustaka_view/' . $item->username . '/bebas" id="cetak_pustaka' . $item->username . '" class="btn btn-success btn-block">Cetak</a>';
            }
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->M_cetak->count_all2(),
            "recordsFiltered" => $this->M_cetak->count_filtered2(),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }



    // status sirkulasi terdiri dari
    // 0 Keranjang peminjaman
    // 1 proses peminjaman
    // 2 sedang dipersiapkan
    // 3 dapat diambil
    // 4 pinjam
    // 5 tolak peminjaman
    // 6 pelanggaran
    // 7 pengajuan perpajangan
    // 8 tolak perpanjangan
    // 9 valid perpanjangan
    // 10 selesai pengembalian
    public function code()
    {
        $data['title'] = 'Cetak Barcode & QR Code Buku | Portal FH';
        $data['cetak_code'] = $this->db->where(['status' => 0])->from('cetak')->join('buku', 'buku.register = cetak.b_register')->get()->result_array();
        $data['katalog_buku'] = $this->M_katalog_buku->getData();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/cetak_code', $data);
        $this->load->view('templates/footer');
    }
    public function tambahData()
    {
        $res = $this->M_cetak->insertData();
    }

    function hapusData($id_cetak)
    {
        $res = $this->M_cetak->deleteData($id_cetak);
    }
    public function view()
    {
        $data['title'] = 'Cetak Barcode & QR Code Buku | Portal FH';
        $data['cetak_code'] = $this->db->where(['status' => 0])->from('cetak')->join('buku', 'buku.register = cetak.b_register')->get()->result_array();
        $data['cetak_qr'] = '0';
        $data['cetak_bar'] = '0';
        $id_cetak = [];
        $register = [];
        foreach ($data['cetak_code'] as $cetak) {
            $id_cetak[] = $cetak['id_cetak'];
            $register[] = $cetak['b_register'];
        }
        // echo var_dump($id_cetak);

        // update database
        if ($_POST['pilihan'] == 1) {
            $data['cetak_qr'] = '1';
            $data['cetak_bar'] = '0';
            for ($i = 0; $i < count($id_cetak); $i++) {
                $data =  [
                    'qrcode' => '1',
                    'status' => '1',
                ];
                $res = $this->M_cetak->updateData($data, $id_cetak[$i]);
            }
        }
        if ($_POST['pilihan'] == 2) {
            $data['cetak_qr'] = '0';
            $data['cetak_bar'] = '1';
            for ($i = 0; $i < count($id_cetak); $i++) {
                $data =  [
                    'barcode' => '1',
                    'status' => '1',
                ];
                $res = $this->M_cetak->updateData($data, $id_cetak[$i]);
            }
        }
        if ($_POST['pilihan'] == 3) {
            $data['cetak_qr'] = '1';
            $data['cetak_bar'] = '1';
            for ($i = 0; $i < count($id_cetak); $i++) {
                $data =  [
                    'barcode' => '1',
                    'qrcode' => '1',
                    'status' => '1',
                ];
                $res = $this->M_cetak->updateData($data, $id_cetak[$i]);
            }
        }

        $data['cetak_buku'] = [];

        for ($i = 0; $i < count($register); $i++) {
            $buku_cetak = $this->M_katalog_buku->getData($register[$i]);
            if ($_POST['pilihan'] == 1) {
                $data['cetak_buku'][] = $buku_cetak[0]['register'] . "^" . $buku_cetak[0]['judul_buku'] . "^" . $buku_cetak[0]['no_dewey'] . "^" . $buku_cetak[0]['author_abrev'] . "^1^0";
            }
            if ($_POST['pilihan'] == 2) {
                $data['cetak_buku'][] = $buku_cetak[0]['register'] . "^" . $buku_cetak[0]['judul_buku'] . "^" . $buku_cetak[0]['no_dewey'] . "^" . $buku_cetak[0]['author_abrev'] . "^0^1";
            }
            if ($_POST['pilihan'] == 3) {
                $data['cetak_buku'][] = $buku_cetak[0]['register'] . "^" . $buku_cetak[0]['judul_buku'] . "^" . $buku_cetak[0]['no_dewey'] . "^" . $buku_cetak[0]['author_abrev'] . "^1^1";
            }
        }

        $this->load->view('admin/view_code', $data);
    }

    public function bebas_pustaka()
    {
        $data['title'] = 'Cetak Barcode & QR Code Buku | Portal FH';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/bebas_pustaka', $data);
        $this->load->view('templates/footer');
    }

    public function QRPustaka($username, $status)
    {
        $transaksi = base_url('Cetak/bebas_pustaka_view/' . $username . '/' . $status);
        QRcode::png(
            $transaksi,
            $outfile = false,
            $level = QR_ECLEVEL_H,
            $size = 12,
            $margin = 2
        );
    }

    public function bebas_pustaka_view($username, $status)
    {
        $data['title'] = 'Cetak Barcode & QR Code Buku | Portal FH';
        $data['mhs'] = $this->M_cetak->getUser($username);
        $data['petugas'] = $this->M_petugas->getData(null, 1);
        $data['status'] = "$status";
        $data['kop_surat'] = $this->M_kop_surat->getData(null, 1);
        $this->load->view('admin/bebas_pustaka_view', $data);
    }

    public function cetak_transaksi($no_transaksi)
    {
        $data['buku'] = $this->db->select('register,judul_buku,user.*,sirkulasi.*')->from('sirkulasi')->join('buku', 'buku.register=sirkulasi.b_register', 'left')->join('user', 'user.username=sirkulasi.u_username', 'left')->where('no_transaksi', $no_transaksi)->get()->result_array();
        $this->load->view('page/invoice_transaksi', $data);
    }
}
