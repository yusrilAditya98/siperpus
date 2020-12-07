<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Peminjaman extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('m_user', 'u');
        $this->load->model('m_prodi', 'p');
        $this->load->model('m_katalog_buku');
        $this->load->model('m_sirkulasi');
        $this->load->model('m_pelanggaran');
        $this->load->library('Zend');
        $this->load->library('Ciqrcode');
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


    function get_ajax_peminjaman()
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
            if ($item->status_buku == 1) {
                $row[] = '<span class="badge badge-success">tersedia</span>';
            } else {
                $row[] = '<span class="badge badge-secondary">dipinjam</span>';
            }
            // add html for action
            $temp = '<button class="btn btn-sm btn-default" data-toggle="modal" data-target="#btnDetailBuku' . $item->register . '"><i class="fa fa-info"></i></button>';
            $temp_btn_pinjam = "";
            if ($temp_role_id == "role_id_2") {
                $temp_btn_pinjam = '<a href="../../sirkulasi/peminjaman/pinjam/' . $item->register . '" class="btn btn-sm btn-success"><i class="fas fa-cart-plus"></i> Pinjam</a>';
            }
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

    function get_ajax_validasi()
    {
        $list = $this->m_sirkulasi->get_daftarvalidasi();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $dataBuku = $this->db->select('register,judul_buku,status_sirkulasi')->from('sirkulasi')->join('buku', 'buku.register=sirkulasi.b_register', 'left')->where('no_transaksi', $item->no_transaksi)->get()->result_array();
            $btnValid = '';
            $no++;
            $row = array();
            $row[] = $no . ".";
            $row[] = $item->tanggal_sirkulasi;
            $row[] = $item->no_transaksi;
            $row[] = $item->username;
            $row[] = $item->nama;
            $row[] = $item->tanggal_mulai;
            $row[] = $item->tanggal_akhir;
            $minStatus =  $this->db->select('MIN(status_sirkulasi) as status_sirkulasi')->from('sirkulasi')->where('no_transaksi', $item->no_transaksi)->get()->row_array();


            if ($minStatus['status_sirkulasi'] == 1) {
                $row[] = '<span class="badge badge-primary">proses peminjaman</span>';
            } elseif ($minStatus['status_sirkulasi'] == 2) {
                $row[] = '<span class="badge badge-warning">sedang dipersiapkan</span>';
            } elseif ($minStatus['status_sirkulasi'] == 3) {
                $row[] = '<span class="badge badge-info">dapat segera diambil</span>';
                $btnValid = '<a href="' . base_url('sirkulasi/peminjaman/detailValidasiPeminjaman/' . $item->no_transaksi) . '" class="btn btn-sm btn-success"><i class="fa fa-check mr-2"></i>validasi</a>';
            } elseif ($minStatus['status_sirkulasi'] == 4) {
                $row[] = '<span class="badge badge-success">dipinjam</span>';
            } else {
                $row[] = '';
            }
            // add html for action
            $temp = '<button class="btn btn-sm btn-default" data-toggle="modal" data-target="#btnDetailTransaksi' . $item->no_transaksi . '"><i class="fa fa-info"></i></button>';
            $staSirkulasi = '';
            $valSirkulasi = '';
            $tempTr = "";
            $index = 1;
            foreach ($dataBuku as $b) {
                $status = "";
                if ($b['status_sirkulasi'] == 1) {
                    $staSirkulasi = '<a href="' . site_url('sirkulasi/peminjaman/ubahStatusPeminjaman/' . $item->no_transaksi . '?status=2') . '" class="btn btn-success btn-flat mb-2"><i class="fas fa-check mr-2"></i>Persiapkan Peminjaman</a><a href="' . site_url('sirkulasi/peminjaman/ubahStatusPeminjaman/' . $item->no_transaksi . '?status=5') . '" class="btn btn-danger btn-flat mb-2 mr-2"><i class="fas fa-times mr-2"></i>Tolak Peminjaman</a>';
                    $status = '<span class="badge badge-primary">proses peminjaman</span>';
                } elseif ($b['status_sirkulasi'] == 2) {
                    $staSirkulasi = '<a href="' . site_url('sirkulasi/peminjaman/ubahStatusPeminjaman/' . $item->no_transaksi . '?status=3') . '" class="btn btn-success btn-flat mb-2"><i class="fas fa-check mr-2"></i>Dapat Diambil</a>';
                    $status = '<span class="badge badge-warning">sedang dipersiapkan</span>';
                } elseif ($b['status_sirkulasi'] == 3) {
                    $staSirkulasi = '';
                    $status = '<span class="badge badge-info">dapat segera diambil</span>';
                } elseif ($b['status_sirkulasi'] == 4) {
                    $staSirkulasi = '';
                    $status = '<span class="badge badge-success">dipinjam</span>';
                } else {
                    $status = '';
                    $staSirkulasi = '';
                }

                $tempTr .= '<tr>
                    <td>' . $index++ . '</td>
                    <td>' . $b['register'] . '</td>
                    <td>' . $b['judul_buku'] . '</td>
                    <td>' . $status . '</td>
                </tr>';
            }
            $row[] = $temp . " " .  $btnValid . " " . ' <div class="modal fade" id="btnDetailTransaksi' . $item->no_transaksi . '" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="btnDetailTransaksiLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Detail Transaksi</h5>
                            
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <img src="' . site_url('sirkulasi/peminjaman/QRcode/' . $item->no_transaksi) . '">
                                </div>
                                <div class="col-lg-6"> 
                                    <div class="mt-4">
                                        <h6 class="text-secondary mb-n1">Nama</h6>
                                        <h2>' . $item->nama . '</h2>
                                    </div>
                                    <div class="mt-4">
                                        <h6 class="text-secondary mb-n1">Username</h6>
                                        <h2>' . $item->username . '</h2>
                                    </div>
                                    <div class="mt-4">
                                        <h6 class="text-secondary mb-n1">No Transaksi</h6>
                                        <h2>' . $item->no_transaksi . '</h2>
                                    </div>
                                    <div class="mt-4">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <h6 class="text-secondary mb-n1">Tanggal Mulai</h6>
                                            <h2>' . $item->tanggal_mulai . '</h2>
                                        </div>
                                        <div class="col-lg-6">
                                            <h6 class="text-secondary mb-n1">Tanggal Selesai</h6>
                                            <h2>' . $item->tanggal_akhir . '</h2>
                                        </div>
                                    </div>
                                      
                                        
                                    </div>
                                    
                                </div>
                                <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <a target="_blank" href="' . base_url('cetak/cetak_transaksi/' . $item->no_transaksi) . '" class="btn btn-warning btn-flat mb-2"><i class="fas fa-print mr-2"></i>Cetak Transaksi</a>
                                    </div>
                                    <div class="col-lg-6">
                                    ' . $valSirkulasi . '
                                    </div>
                                </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="table-responsive">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Register</th>
                                                    <th>Judul Buku</th>
                                                    <th>Status</th>
                                                <tr>
                                            </thead>
                                            <tbody>
                                            ' . $tempTr . '
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                </div>
                            </div>
                            ' . $staSirkulasi . '
                            
                        </div>
                    </div>
                </div>
            </div>';
            $row[] = '1';
            $row[] = '1';
            $data[] = $row;
        }

        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->m_sirkulasi->count_all_v(),
            "recordsFiltered" => $this->m_sirkulasi->count_filtered_v(),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }

    public function Barcode($id = 12332)
    {
        $this->zend->load('Zend/Barcode');
        Zend_Barcode::render('code128', 'image', array('text' => $id));
    }

    public function template($title)
    {
        $data['title'] = $title;
        $data['buku_dipinjam'] = count($this->db->where(['jenis_sirkulasi' => 1, 'status_sirkulasi' => 0, 'u_username' => $this->session->userdata('username')])->from('sirkulasi')->join('buku', 'buku.register = sirkulasi.b_register')->get()->result_array());
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
    }

    // status sirkulasi terdiri dari
    // 0 Keranjang peminjaman
    // 1 proses peminjaman
    // 2 pinjam
    // 3 tolak peminjaman
    // 4 telat (otomatis dari tanggal pengembalian melebihin tanggal sekarang.)
    // 5 pengajuan perpajangan
    // 6 tolak perpanjangan
    // 7 valid perpanjangan
    // 8 selesai pengembalian
    // 9 Denda dibayar
    // 10 denda belum dibayar

    // jenis sirkulasi 
    // 1 pinjaman
    // 2 baca ditempat
    // status buku
    // - buku ada / dipinjam


    public function detailValidasiPeminjaman($no_transaksi)
    {

        $data = [
            'buku_dipinjam' => $this->m_sirkulasi->bukuDipinjam($no_transaksi),
            'title' => 'Detail Validasi Peminjaman',
            'user' => $this->db->select('nama,username,no_transaksi,tanggal_mulai,tanggal_akhir')->from('sirkulasi')->join('user', 'user.username=sirkulasi.u_username', 'left')->where('sirkulasi.no_transaksi', $no_transaksi)->get()->row_array()
        ];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('peminjaman/detail_validasi_peminjaman', $data);
        $this->load->view('templates/footer');
    }

    public function validasiPeminjaman()
    {

        $register = $this->input->post('register');
        $no_transaksi = $this->input->post('no_transaksi');
        $status = $this->input->post('status');
        $data = [];
        // cek status
        $sirkulasi = $this->db->get_where('sirkulasi', ['b_register' => $register, 'no_transaksi' => $no_transaksi])->row_array();
        if ($sirkulasi) {
            if ($sirkulasi['status_sirkulasi'] == 3) {
                $this->db->set('status_sirkulasi', $status);
                $this->db->where('b_register', $register);
                $this->db->where('no_transaksi', $no_transaksi);
                $this->db->update('sirkulasi');
                $this->session->set_flashdata('success', 'Buku dengan nomer register ' . $register . ' berhasil divalidasi');
            } else {
                $this->session->set_flashdata('danger', 'Buku dengan nomer register ' . $register . ' gagal divalidasi!');
            }
        } else {
            $this->session->set_flashdata('danger', 'Buku dengan nomer register ' . $register . ' gagal divalidasi!');
        }

        // cek riderec 
        $afterValid = $this->db->get_where('sirkulasi', ['no_transaksi' => $no_transaksi])->result_array();
        $cek = true;
        foreach ($afterValid as $a) {
            if ($a['status_sirkulasi'] != 4) {
                $cek = false;
            }
        }
        if ($cek) {
            redirect('sirkulasi/peminjaman/validasi_peminjaman');
        } else {
            redirect('sirkulasi/peminjaman/detailValidasiPeminjaman/' . $no_transaksi);
        }
        echo json_encode($data);
    }

    public function pinjam($register)
    {
        $buku = $this->db->get_where('buku', ['register' => $register])->row_array();
        $status_buku = $buku['status_buku'];
        // Status Buku
        // 1 = Buku Ada
        // 2 = Buku tidak tersedia / Sedang Dipinjam
        if ($status_buku == 1) {
            $data = array(
                'u_username' => $this->session->userdata('username'),
                'b_register' => $register,
                'jenis_sirkulasi' => 1,
                'tanggal_sirkulasi' => date('Y-m-d'),
                'tanggal_mulai' => date('Y-m-d'),
                'tanggal_akhir' => '0000-00-00',
                'tanggal_pengembalian' => '0000-00-00',
                'tanggal_perpanjangan' => '0000-00-00',
                'status_sirkulasi' => 0,
            );
            $this->db->insert('sirkulasi', $data);
            $this->db->where('register', $register)->update('buku', ['status_buku' => 2]);
            $this->session->set_flashdata('success', 'Buku dimasukkan di keranjang');
        } else {
            $this->session->set_flashdata('danger', 'Buku tidak tersedia untuk dipinjam');
        }
        redirect(site_url('/data/buku/buku_anggota'));
    }
    public function pinjamBuku($id_sirkulasi)
    {
        $this->db->where('id_sirkulasi', $id_sirkulasi)->update('sirkulasi', ['status_sirkulasi' => 2]);
        $this->session->set_flashdata('success', 'Buku berhasil dipinjam');
        redirect(site_url('/sirkulasi/peminjaman/keranjang_peminjaman'));
    }
    public function pinjamSemua()
    {
        if ($this->session->userdata('role_id') == 'role_id_1') {
            $status_sirkulasi = 4;
            $username = $this->input->get('username');
            $data = $this->db->where(['jenis_sirkulasi' => 1, 'status_sirkulasi' => 0, 'u_username' => $username])->from('sirkulasi')->join('buku', 'buku.register = sirkulasi.b_register')->get()->result_array();
        } else {
            $status_sirkulasi = 1;
            $data = $this->db->where(['jenis_sirkulasi' => 1, 'status_sirkulasi' => 0])->from('sirkulasi')->join('buku', 'buku.register = sirkulasi.b_register')->get()->result_array();
        }
        $lama_peminjaman = $this->db->where(['status_peminjaman' => 1])->from('lama_peminjaman')->get()->row_array();
        $lama_pinjam = $lama_peminjaman['durasi_peminjaman'];
        $hari = '+' . $lama_pinjam . ' days';
        $no_transaksi = uniqid();
        $cek = true;
        // cek no transaksi
        while ($cek) {
            $cek = $this->db->get_where('sirkulasi', ['no_transaksi' => $no_transaksi])->data_seek();
            if ($cek) {
                $no_transaksi = uniqid();
            } else {
                $cek = false;
            }
        }
        for ($i = 0; $i < count($data); $i++) {
            $id_sirkulasi = $data[$i]['id_sirkulasi'];
            $tanggal_pinjam = $this->input->post('tanggal_pinjam');
            $tanggal_akhir = date('Y-m-d', strtotime($tanggal_pinjam . $hari));
            $this->db->where('id_sirkulasi', $id_sirkulasi)->update('sirkulasi', ['status_sirkulasi' => $status_sirkulasi, 'tanggal_mulai' => $tanggal_pinjam, 'tanggal_akhir' => $tanggal_akhir, 'no_transaksi' => $no_transaksi]);
        }
        $this->session->set_flashdata('success', 'Peminjaman buku berhasil diajukan');
        if ($this->session->userdata('role_id') == 'role_id_1') {
            redirect(site_url('/sirkulasi/peminjaman/validasi_peminjaman'));
        } else {
            redirect(site_url('/sirkulasi/peminjaman/keranjang_peminjaman'));
        }
    }
    public function hapusPinjam($id_sirkulasi)
    {
        $sirkulasi = $this->db->get_where('sirkulasi', ['id_sirkulasi' => $id_sirkulasi])->row_array();
        $buku = $this->db->get_where('buku', ['register' => $sirkulasi['b_register']])->row_array();
        $this->db->where('register', $sirkulasi['b_register'])->update('buku', ['status_buku' => 1]);

        $this->db->where('id_sirkulasi', $id_sirkulasi)->delete('sirkulasi');

        $this->session->set_flashdata('success', 'Keranjang buku sudah dihapus');
        if ($this->session->userdata('role_id') == 'role_id_1') {
            $username = $this->input->get('username');
            redirect(site_url('/sirkulasi/peminjaman/peminjaman_buku_admin?username=' . $username));
        } else {
            redirect(site_url('/sirkulasi/peminjaman/keranjang_peminjaman'));
        }
    }
    public function daftar_buku_dipinjam()
    {
        $title = 'Daftar Buku Dipinjam | Portal FH';
        if ($this->session->userdata('role_id') == 'role_id_1') {
            $data['buku_dipinjam'] =  $this->m_katalog_buku->getBukuDipinjam(null, $this->input->get('status_sirkulasi'), $this->input->get('start_date'), $this->input->get('end_date'));
        } else {
            $data['buku_dipinjam'] =  $this->m_katalog_buku->getBukuDipinjam($this->session->userdata('username'), $this->input->get('status_sirkulasi'), $this->input->get('start_date'), $this->input->get('end_date'));
        }
        $this->template($title);
        $this->load->view('peminjaman/daftar_buku_dipinjam', $data);
        $this->load->view('templates/footer');
    }
    public function keranjang_peminjaman()
    {
        $title = 'Keranjang Peminjaman | Portal FH';
        $data['buku_dipinjam'] = $this->db->where(['u_username' => $this->session->userdata('username')])->where(['jenis_sirkulasi' => 1, 'status_sirkulasi' => 0])->from('sirkulasi')->join('buku', 'buku.register = sirkulasi.b_register')->get()->result_array();
        $this->template($title);
        $this->load->view('peminjaman/keranjang_peminjaman', $data);
        $this->load->view('templates/footer');
    }
    public function perpanjangan_peminjaman()
    {
        $title = 'Perpanjangan Peminjaman | Portal FH';
        $data['buku_perpanjangan'] = $data['buku_perpanjangan'] = $this->m_katalog_buku->getBukuPerpanjangan($this->session->userdata('username'), $this->input->get('status_sirkulasi'), $this->input->get('start_date'), $this->input->get('end_date'));

        $data['pinjaman'] = $this->db->where(['jenis_sirkulasi' => 1, 'status_sirkulasi' => 4, 'u_username' => $this->session->userdata('username')])->from('sirkulasi')->join('buku', 'buku.register = sirkulasi.b_register')->get()->result_array();
        $this->template($title);
        $this->load->view('peminjaman/perpanjangan_peminjaman', $data);
        $this->load->view('templates/footer');
    }
    public function perpanjangan()
    {
        if ($this->session->userdata('role_id') == 'role_id_1') {
            $status_sirkulasi = 9;
        } else {
            $status_sirkulasi = 7;
        }
        $id_sirkulasi = $this->input->post('sirkulasi');
        // $tanggal = $this->input->post('jangka_waktu');
        $data = $this->db->get_where('sirkulasi', ['id_sirkulasi' => $id_sirkulasi])->row_array();
        $lama_peminjaman = $this->db->where(['status_peminjaman' => 1])->from('lama_peminjaman')->get()->row_array();
        $lama_pinjam = $lama_peminjaman['durasi_peminjaman'];
        $hari = '+' . $lama_pinjam . ' days';

        $tanggal_perpanjangan = date('Y-m-d', strtotime($data['tanggal_akhir'] . $hari));
        $this->db->where('id_sirkulasi', $id_sirkulasi)->update('sirkulasi', ['status_sirkulasi' => $status_sirkulasi, 'tanggal_perpanjangan' => $tanggal_perpanjangan]);
        $this->session->set_flashdata('success', 'Pengajuan perpanjangan berhasil');
        if ($this->session->userdata('role_id') == 'role_id_1') {
            redirect(site_url('/sirkulasi/peminjaman/perpanjangan_peminjaman_admin'));
        } else {
            redirect(site_url('/sirkulasi/peminjaman/perpanjangan_peminjaman'));
        }
    }
    public function validPinjam($id_sirkulasi)
    {
        $status = $this->input->get('valid');
        $this->db->set('status_sirkulasi', $status);
        $this->db->where('id_sirkulasi', $id_sirkulasi);
        $this->db->update('sirkulasi');
        $this->session->set_flashdata('success', 'Validasi perpanjangan berhasil');
        redirect(site_url('/sirkulasi/peminjaman/perpanjangan_peminjaman_admin'));
    }
    public function pelanggaran_peminjaman()
    {
        $title = 'Pelanggaran Peminjaman | Portal FH';
        $buku = $this->m_pelanggaran->getListPelanggaran();
        for ($i = 0; $i < count($buku); $i++) {
            if ($buku[$i]['d_id_denda'] == 3) {
                if ($buku[$i]['tanggal_pengembalian'] > $buku[$i]['tanggal_akhir']) {
                    $awal  = date_create($buku[$i]['tanggal_akhir']);
                    $akhir = date_create($buku[$i]['tanggal_pengembalian']); // waktu sekarang
                    $diff  = date_diff($awal, $akhir);
                    $buku[$i]['denda'] = 'Membayar denda sebesar Rp.1000 x ' . $diff->days . ' = Rp. ' . (1000 * intval($diff->days));
                } else {
                    $buku[$i]['denda'] = 'Membayar denda sebesar Rp.1000 x ' . 0 . ' = Rp. ' . (1000 * 0);
                }
            } else {
                $buku[$i]['denda'] = '';
            }
        }
        $data['buku'] = $buku;
        $this->template($title);
        $this->load->view('peminjaman/pelanggaran_peminjaman', $data);
        $this->load->view('templates/footer');
    }
    public function pengembalian_peminjaman()
    {
        $title = 'Pengembalian Peminjaman | Portal FH';
        $data['buku_dipinjam'] = $this->db->where(['jenis_sirkulasi' => 1])->where_in('status_sirkulasi', [2, 7])->from('sirkulasi')->join('buku', 'buku.register = sirkulasi.b_register')->get()->result_array();
        $this->template($title);
        $this->load->view('peminjaman/pengembalian_peminjaman', $data);
        $this->load->view('templates/footer');
    }
    public function kembalikan()
    {
        $register = $this->input->post('register');
        $no_transaksi = $this->input->post('no_transaksi');
        $pelanggaran = $this->input->post('pelanggaran');
        $denda = $this->input->post('denda');
        $username = $this->input->post('username');
        // cek no transaksi 
        $sirkulasi = $this->db->get_where('sirkulasi', ['b_register' => $register, 'no_transaksi' => $no_transaksi])->row_array();
        if ($sirkulasi['status_sirkulasi'] == 4 || $sirkulasi['status_sirkulasi'] == 8 || $sirkulasi['status_sirkulasi'] == 9) {
            if ($pelanggaran == '' && $denda == '') {
                $data = [
                    'status' => 10,
                    'no_transaksi' => $no_transaksi,
                    'register' => $register
                ];
            } else {
                $data = [
                    'status' => 6,
                    'no_transaksi' => $no_transaksi,
                    'register' => $register
                ];

                // status planggaran 1 = belum diselesaikan
                // status pelangara 2 = sudah diselesaikan
                $dataPelanggaran = [
                    's_id_sirkulasi' => $sirkulasi['id_sirkulasi'],
                    'p_id_pelanggaran' => $pelanggaran,
                    'd_id_denda' => $denda,
                    'status_pelanggaran' => 1,
                ];
                $this->m_sirkulasi->insertSirkulasiPelanggaran($dataPelanggaran);
            }
            $this->m_sirkulasi->updatePengembalianBuku($data);
            $this->db->where('register', $register)->update('buku', ['status_buku' => 1]);
            $this->session->set_flashdata('success', 'Buku dengan no register ' . $register . ' berhasil dikembalikan');
        } else {
            $this->session->set_flashdata('danger', 'Buku dengan no register ' . $register . ' gagal dikembalikan');
        }

        if ($this->session->userdata('role_id') == 'role_id_1') {
            redirect(site_url('/sirkulasi/peminjaman/pengembalian_peminjaman_admin?username=' . $username));
        } else {
            redirect(site_url('/sirkulasi/peminjaman/pengembalian_peminjaman'));
        }
    }

    public function peminjaman_buku_admin()
    {
        $title = 'Peminjaman Buku | Portal FH';
        if ($this->input->get('username')) {
            $username = $this->input->get('username');
            $data['user'] = $this->db->get_where('user', ['username' => $username])->row_array();
            $data['keranjang_pinjam'] = $this->db->where(['jenis_sirkulasi' => 1, 'status_sirkulasi' => 0, 'u_username' => $username])->from('sirkulasi')->join('buku', 'buku.register = sirkulasi.b_register')->get()->result_array();
            if ($data['user'] == null) {
                $data['user'] = 'Kosong';
                $data['keranjang_pinjam'] = null;
            }
        } else {
            $data['user'] = null;
        }
        $this->template($title);
        $this->load->view('peminjaman/peminjaman_buku_admin', $data);
        $this->load->view('templates/footer');
    }
    public function pinjam_admin()
    {
        $username = $this->input->post('username');
        $register = $this->input->post('register');
        $buku = $this->db->get_where('buku', ['register' => $register])->row_array();
        $status_buku = $buku['status_buku'];
        // Status Buku
        // 1 = Buku Ada
        // 2 = Buku tidak tersedia / Sedang Dipinjam
        if ($status_buku == 1) {
            $data = array(
                'u_username' => $username,
                'b_register' => $register,
                'jenis_sirkulasi' => 1,
                'tanggal_sirkulasi' => date('Y-m-d'),
                'tanggal_mulai' => date('Y-m-d'),
                'tanggal_akhir' => '0000-00-00',
                'tanggal_pengembalian' => '0000-00-00',
                'tanggal_perpanjangan' => '0000-00-00',
                'status_sirkulasi' => 0,
            );
            $this->db->insert('sirkulasi', $data);
            $this->db->where('register', $register)->update('buku', ['status_buku' => 2]);
            $this->session->set_flashdata('success', 'Buku dimasukkan di keranjang');
        } else {
            $this->session->set_flashdata('danger', 'Buku tidak tersedia untuk dipinjam');
        }
        redirect(site_url('/sirkulasi/peminjaman/peminjaman_buku_admin?username=' . $username));
    }

    public function perpanjangan_peminjaman_admin()
    {
        $title = 'Daftar Buku Dipinjam | Portal FH';
        $data['buku_perpanjangan'] = $this->m_katalog_buku->getBukuPerpanjangan(null, $this->input->get('status_sirkulasi'), $this->input->get('start_date'), $this->input->get('end_date'));
        $data['anggota'] = $this->db->get_where('user', ['ru_role_id' => 2]);
        $this->template($title);
        $this->load->view('peminjaman/perpanjangan_peminjaman_admin', $data);
        $this->load->view('templates/footer');
    }
    public function validasi_peminjaman()
    {
        $title = 'Validasi Peminjaman | Portal FH';
        $this->template($title);
        $this->load->view('peminjaman/validasi_peminjaman');
        $this->load->view('templates/footer');
    }
    public function valid_pinjam($id_sirkulasi)
    {
        $this->db->where('id_sirkulasi', $id_sirkulasi)->update('sirkulasi', ['status_sirkulasi' => 2]);
        $this->session->set_flashdata('success', 'Validasi peminjaman berhasil');
        redirect(site_url('/sirkulasi/peminjaman/validasi_peminjaman'));
    }
    public function tolak_pinjam($id_sirkulasi)
    {
        $this->db->where('id_sirkulasi', $id_sirkulasi)->update('sirkulasi', ['status_sirkulasi' => 3]);

        $sirkulasi = $this->db->get_where('sirkulasi', ['id_sirkulasi' => $id_sirkulasi])->row_array();
        $this->db->where('register', $sirkulasi['b_register'])->update('buku', ['status_buku' => 1]);

        $this->session->set_flashdata('success', 'Validasi peminjaman ditolak');
        redirect(site_url('/sirkulasi/peminjaman/validasi_peminjaman'));
    }
    public function pelanggaran_peminjaman_admin()
    {
        $title = 'Pelanggaran Peminjaman | Portal FH';
        $buku = $this->m_pelanggaran->getListPelanggaran();
        for ($i = 0; $i < count($buku); $i++) {
            if ($buku[$i]['d_id_denda'] == 3) {
                if ($buku[$i]['tanggal_pengembalian'] > $buku[$i]['tanggal_akhir']) {
                    $awal  = date_create($buku[$i]['tanggal_akhir']);
                    $akhir = date_create($buku[$i]['tanggal_pengembalian']); // waktu sekarang
                    $diff  = date_diff($awal, $akhir);
                    $buku[$i]['denda'] = 'Membayar denda sebesar Rp.1000 x ' . $diff->days . ' = Rp. ' . (1000 * intval($diff->days));
                } else {
                    $buku[$i]['denda'] = 'Membayar denda sebesar Rp.1000 x ' . 0 . ' = Rp. ' . (1000 * 0);
                }
            } else {
                $buku[$i]['denda'] = '';
            }
        }
        $data['buku'] = $buku;
        $this->template($title);
        $this->load->view('peminjaman/pelanggaran_peminjaman_admin', $data);
        $this->load->view('templates/footer');
    }
    public function validasiPelanggaran()
    {
        $id_sirkulasi = $this->input->post('id_sirkulasi');
        $id_pelanggaran = $this->input->post('id_pelanggaran');
        $keterangan = $this->input->post('keterangan');
        $data = [
            's_id_sirkulasi' => $id_sirkulasi,
            'p_id_pelanggaran' => $id_pelanggaran,
            'keterangan' => $keterangan,
            'status_pelanggaran' => 2
        ];

        $this->m_sirkulasi->updateSirkulasiPelanggarang($data);
        $this->session->set_flashdata('success', 'Validasi Pelanggaran berhasil');
        redirect(site_url('/sirkulasi/peminjaman/pelanggaran_peminjaman_admin'));
    }
    public function pengembalian_peminjaman_admin()
    {
        $title = 'Pengembalian Peminjaman | Portal FH';
        $username = $this->input->get('username');
        if ($username) {
            $data['user'] = $this->db->get_where('user', ['username' => $username])->row_array();
            $data['buku_dipinjam'] = $this->db->where(['jenis_sirkulasi' => 1, 'u_username' => $username])->where_in('status_sirkulasi', [4, 8, 9])->from('sirkulasi')->join('buku', 'buku.register = sirkulasi.b_register')->get()->result_array();
            $data['pelanggaran'] = $this->db->get('pelanggaran')->result_array();
            if ($data['user'] == null) {
                $data['user'] = 'Kosong';
                $data['buku_dipinjam'] = null;
            }
        } else {
            $data['user'] = null;
        }
        $this->template($title);
        $this->load->view('peminjaman/pengembalian_peminjaman_admin', $data);
        $this->load->view('templates/footer');
    }

    public function ubahStatusPeminjaman($no_transaksi)
    {
        $status = $this->input->get('status');
        if ($status == 5) {
            $buku = $this->db->get_where('sirkulasi', ['no_transaksi' => $no_transaksi])->row_array();
            $this->db->set('status_buku', 1);
            $this->db->where('register', $buku['b_register']);
            $this->db->update('buku');
        }
        $this->db->set('status_sirkulasi', $status);
        $this->db->where('no_transaksi', $no_transaksi);
        $this->db->update('sirkulasi');
        redirect('sirkulasi/peminjaman/validasi_peminjaman');
    }

    public function ajax_perpanjangan($username)
    {
        $tempData = $this->db->where(['jenis_sirkulasi' => 1, 'status_sirkulasi' => 4, 'u_username' => $username])->from('sirkulasi')->join('buku', 'buku.register = sirkulasi.b_register')->join('user', 'user.username = sirkulasi.u_username')->get()->result_array();
        $data = [];
        foreach ($tempData as $b) {
            if (date('Y-m-d') <= $b['tanggal_akhir']) {
                $data = $tempData;
            }
        }

        if ($data) {
            $result = [
                'data' => $data,
                'message' => true
            ];
        } else {
            $result = [
                'data' => $data,
                'message' => false
            ];
        }
        echo json_encode($result);
    }
}
