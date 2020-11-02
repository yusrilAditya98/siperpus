<?php
defined('BASEPATH') or exit('No direct script access allowed');


class cetak extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_cetak');
        $this->load->model('m_user');
        $this->load->library('Zend');
        $this->load->library('Ciqrcode');
        $this->load->model('m_katalog_buku');
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
    public function Barcode($register)
    {
        $this->zend->load('Zend/Barcode');
        Zend_Barcode::render('code128', 'image', array('text' => $register));
    }

    function get_katalog()
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
            $temp = '<button class="btn btn-sm btn-default" data-toggle="modal" data-target="#btnDetailBuku' . $item->register . '"><i class="fa fa-info"></i></button>';
            $temp_btn_pinjam = "";

            $row[] = $temp . " " . $temp_btn_pinjam . ' <div class="modal fade" id="btnDetailBuku' . $item->register . '" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="btnDetailBukuLabel" aria-hidden="true">
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
            "recordsTotal" => $this->m_katalog_buku->count_all(),
            "recordsFiltered" => $this->m_katalog_buku->count_filtered(),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }

    function get_data_cetak()
    {
        $list = $this->m_cetak->get_datatables();
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
            "recordsTotal" => $this->m_cetak->count_all(),
            "recordsFiltered" => $this->m_cetak->count_filtered(),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }

    function get_status_mahasiswa()
    {
        $list = $this->m_cetak->get_datatables2();
        $data = array();
        $no = @$_POST['start'];
        $mhs = [];
        $mhs_sirkulasi = [];
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
            $cek_sirkulasi = $this->m_cetak->getDataSirkulasi(null, $mhs[$i]);
            foreach ($cek_sirkulasi as $item) {
                $status[$mhs[$i]][] = $item['id_sirkulasi'] . "-" . $item['status_sirkulasi'];
                if ($item['status_sirkulasi'] == 6) {
                    $cek_pelanggaran = $this->m_cetak->getDataSirkulasiPelanggaran($item['id_sirkulasi']);
                    if ($cek_pelanggaran[0]['status_pelanggaran'] == 1) {
                        $mhs_sirkulasi[] = $item['u_username'];
                    }
                }
                if ($item['status_sirkulasi'] == 4 || $item['status_sirkulasi'] == 9) {
                    $mhs_sirkulasi[] = $item['u_username'];
                }
            }
        }
        $mhs_sirkulasi = array_unique($mhs_sirkulasi);
        sort($mhs_sirkulasi);
        // echo var_dump($mhs_sirkulasi);
        // echo "<br>";
        // echo "<br>";
        // echo var_dump($status);
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
                $row[] = '<button type="button" class="btn btn-sm btn-default"><i class="fas fa-info"></i></button>';
                $row[] = '<a target="_blank" href="' . site_url() . 'cetak/bebas_pustaka_view/' . $item->username . '/tanggungan" id="cetak_pustaka' . $item->username . '" class="btn btn-success btn-block">Cetak</a>';
            } else {
                $row[] = '<span class="badge bg-success">Bebas Tanggungan</span>';
                $row[] = '<button type="button" class="btn btn-sm btn-default"><i class="fas fa-info"></i></button>';
                $row[] = '<a target="_blank" href="' . site_url() . 'cetak/bebas_pustaka_view/' . $item->username . '/bebas" id="cetak_pustaka' . $item->username . '" class="btn btn-success btn-block">Cetak</a>';
            }
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->m_cetak->count_all2(),
            "recordsFiltered" => $this->m_cetak->count_filtered2(),
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
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/cetak_code', $data);
        $this->load->view('templates/footer');
    }
    public function tambahData()
    {
        $res = $this->m_cetak->insertData();
    }

    function hapusData($id_cetak)
    {
        $res = $this->m_cetak->deleteData($id_cetak);
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
                $res = $this->m_cetak->updateData($data, $id_cetak[$i]);
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
                $res = $this->m_cetak->updateData($data, $id_cetak[$i]);
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
                $res = $this->m_cetak->updateData($data, $id_cetak[$i]);
            }
        }

        $data['cetak_buku'] = [];

        for ($i = 0; $i < count($register); $i++) {
            $buku_cetak = $this->m_katalog_buku->getData($register[$i]);
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

    public function bebas_pustaka_view($username, $status)
    {
        $data['title'] = 'Cetak Barcode & QR Code Buku | Portal FH';
        $data['mhs'] = $this->m_cetak->getUser($username);
        $data['status'] = "$status";
        $this->load->view('admin/bebas_pustaka_view', $data);
    }
}
