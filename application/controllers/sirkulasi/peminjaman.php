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
        is_logged_in();
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
            } else if ($temp_role_id == "role_id_1") {
                $temp_btn_pinjam = '<a href="../../sirkulasi/peminjaman/pinjam_admin/' . $item->register . '?username=' . $_POST['username'] . '" class="btn btn-sm btn-success"><i class="fas fa-cart-plus"></i> Pinjam</a>';
                // $temp_btn_pinjam = '<input type="checkbox" name="peminjaman_admin[]" class="form-control check" value="'.$item->register.'">';
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


    // public function peminjaman_buku()
    // {
    //     $title = 'Peminjaman Buku | Portal FH';
    //     $data['buku_dipinjam'] = $this->db->where(['jenis_sirkulasi' => 1, 'status_sirkulasi' => 1])->from('sirkulasi')->join('buku', 'buku.register = sirkulasi.b_register')->get()->result_array();
    //     $this->template($title);
    //     $this->load->view('peminjaman/daftar_peminjaman', $data);
    //     $this->load->view('templates/footer');
    // }
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
            $username = $this->input->get('username');
            $data = $this->db->where(['jenis_sirkulasi' => 1, 'status_sirkulasi' => 0, 'u_username' => $username])->from('sirkulasi')->join('buku', 'buku.register = sirkulasi.b_register')->get()->result_array();
        } else {
            $data = $this->db->where(['jenis_sirkulasi' => 1, 'status_sirkulasi' => 0])->from('sirkulasi')->join('buku', 'buku.register = sirkulasi.b_register')->get()->result_array();
        }
        $lama_peminjaman = $this->db->where(['status_peminjaman' => 1])->from('lama_peminjaman')->get()->row_array();
        $lama_pinjam = $lama_peminjaman['durasi_peminjaman'];
        $hari = '+' . $lama_pinjam . ' days';

        for ($i = 0; $i < count($data); $i++) {
            $id_sirkulasi = $data[$i]['id_sirkulasi'];
            $tanggal_pinjam = $this->input->post('tanggal_pinjam');
            $tanggal_akhir = date('Y-m-d', strtotime($tanggal_pinjam . $hari));
            $this->db->where('id_sirkulasi', $id_sirkulasi)->update('sirkulasi', ['status_sirkulasi' => 1, 'tanggal_mulai' => $tanggal_pinjam, 'tanggal_akhir' => $tanggal_akhir]);
        }
        $this->session->set_flashdata('success', 'Peminjaman buku berhasil diajukan');
        if ($this->session->userdata('role_id') == 'role_id_1') {
            $username = $this->input->get('username');
            redirect(site_url('/sirkulasi/peminjaman/peminjaman_buku_admin?username=' . $username));
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
            $data['buku_dipinjam'] = $this->db->where(['jenis_sirkulasi' => 1])->where_in('status_sirkulasi', [1, 2, 3, 4, 7, 8, 9])->from('sirkulasi')->join('user', 'user.username = sirkulasi.u_username', 'left')->join('buku', 'buku.register = sirkulasi.b_register')->order_by('status_sirkulasi', 'asc')->get()->result_array();
        } else {
            $data['buku_dipinjam'] = $this->db->where(['u_username' => $this->session->userdata('username')])->where(['jenis_sirkulasi' => 1])->where_in('status_sirkulasi', [1, 2, 3, 4, 7, 8, 9])->from('sirkulasi')->join('buku', 'buku.register = sirkulasi.b_register')->order_by('status_sirkulasi', 'asc')->get()->result_array();
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
        $data['buku_perpanjangan'] = $this->db->where(['u_username' => $this->session->userdata('username')])->where(['jenis_sirkulasi' => 1])->where_in('status_sirkulasi', [5, 6, 7])->from('sirkulasi')->join('buku', 'buku.register = sirkulasi.b_register')->get()->result_array();
        $data['pinjaman'] = $this->db->where(['jenis_sirkulasi' => 1, 'status_sirkulasi' => 2])->from('sirkulasi')->join('buku', 'buku.register = sirkulasi.b_register')->get()->result_array();
        $this->template($title);
        $this->load->view('peminjaman/perpanjangan_peminjaman', $data);
        $this->load->view('templates/footer');
    }
    public function perpanjangan()
    {
        $id_sirkulasi = $this->input->post('sirkulasi');
        // $tanggal = $this->input->post('jangka_waktu');
        $data = $this->db->get_where('sirkulasi', ['id_sirkulasi' => $id_sirkulasi])->row_array();
        $lama_peminjaman = $this->db->where(['status_peminjaman' => 1])->from('lama_peminjaman')->get()->row_array();
        $lama_pinjam = $lama_peminjaman['durasi_peminjaman'];
        $hari = '+' . $lama_pinjam . ' days';

        $tanggal_perpanjangan = date('Y-m-d', strtotime($data['tanggal_akhir'] . $hari));
        $this->db->where('id_sirkulasi', $id_sirkulasi)->update('sirkulasi', ['status_sirkulasi' => 5, 'tanggal_perpanjangan' => $tanggal_perpanjangan]);
        $this->session->set_flashdata('success', 'Pengajuan perpanjangan berhasil');
        if ($this->session->userdata('role_id') == 'role_id_1') {
            redirect(site_url('/sirkulasi/peminjaman/perpanjangan_peminjaman_admin'));
        } else {
            redirect(site_url('/sirkulasi/peminjaman/perpanjangan_peminjaman'));
        }
    }
    public function validPinjam($id_sirkulasi)
    {
        $this->db->where('id_sirkulasi', $id_sirkulasi)->update('sirkulasi', ['status_sirkulasi' => 7]);
        $this->session->set_flashdata('success', 'Validasi perpanjangan berhasil');
        redirect(site_url('/sirkulasi/peminjaman/perpanjangan_peminjaman_admin'));
    }
    public function tolakPinjam($id_sirkulasi)
    {
        $this->db->where('id_sirkulasi', $id_sirkulasi)->update('sirkulasi', ['status_sirkulasi' => 6]);
        $this->session->set_flashdata('success', 'Validasi perpanjangan ditolak');
        redirect(site_url('/sirkulasi/peminjaman/perpanjangan_peminjaman_admin'));
    }
    public function pelanggaran_peminjaman()
    {
        $title = 'Pelanggaran Peminjaman | Portal FH';
        $buku = $this->db->where(['u_username' => $this->session->userdata('username')])->where(['jenis_sirkulasi' => 1])->where_in('status_sirkulasi', [4, 9])->from('sirkulasi')->join('buku', 'buku.register = sirkulasi.b_register')->get()->result_array();
        for ($i = 0; $i < count($buku); $i++) {
            $awal  = date_create($buku[$i]['tanggal_akhir']);
            $akhir = date_create($buku[$i]['tanggal_pengembalian']); // waktu sekarang
            $diff  = date_diff($awal, $akhir);
            $buku[$i]['denda'] = 'Membayar denda sebesar Rp.1000 x ' . $diff->days . ' = ' . (1000 * intval($diff->days));
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
    public function kembalikan($id_sirkulasi)
    {
        $sirkulasi = $this->db->get_where('sirkulasi', ['id_sirkulasi' => $id_sirkulasi])->row_array();
        $buku = $this->db->get_where('buku', ['register' => $sirkulasi['b_register']])->row_array();
        $status_buku = $buku['status_buku'];
        // Status Buku
        // 1 = Buku Ada
        // 2 = Buku tidak tersedia / Sedang Dipinjam
        if ($sirkulasi['tanggal_akhir'] < date('Y-m-d')) {
            $this->db->where('id_sirkulasi', $id_sirkulasi)->update('sirkulasi', ['status_sirkulasi' => 4, 'tanggal_pengembalian' => date('Y-m-d')]);
        } else {
            $this->db->where('id_sirkulasi', $id_sirkulasi)->update('sirkulasi', ['status_sirkulasi' => 8, 'tanggal_pengembalian' => date('Y-m-d')]);
        }
        $this->db->where('register', $sirkulasi['b_register'])->update('buku', ['status_buku' => 1]);
        $this->session->set_flashdata('success', 'Buku berhasil di kembalikan');
        if ($this->session->userdata('role_id') == 'role_id_1') {
            $username = $this->input->get('username');
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
    public function pinjam_admin($register)
    {
        $username = $this->input->get('username');
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
        $data['buku_perpanjangan'] = $this->db->where(['jenis_sirkulasi' => 1])->where_in('status_sirkulasi', [5, 6, 7])->from('sirkulasi')->join('buku', 'buku.register = sirkulasi.b_register')->join('user', 'user.username = sirkulasi.u_username')->get()->result_array();
        $data['pinjaman'] = $this->db->where(['jenis_sirkulasi' => 1, 'status_sirkulasi' => 2])->from('sirkulasi')->join('buku', 'buku.register = sirkulasi.b_register')->join('user', 'user.username = sirkulasi.u_username')->get()->result_array();
        $data['anggota'] = $this->db->get_where('user', ['ru_role_id' => 2]);
        $this->template($title);
        $this->load->view('peminjaman/perpanjangan_peminjaman_admin', $data);
        $this->load->view('templates/footer');
    }
    public function validasi_peminjaman()
    {
        $title = 'Validasi Peminjaman | Portal FH';
        $data['pinjam_proses'] = $this->db->where(['jenis_sirkulasi' => 1])->where_in('status_sirkulasi', [1, 2, 3])->from('sirkulasi')->join('buku', 'buku.register = sirkulasi.b_register')->join('user', 'user.username = sirkulasi.u_username')->order_by('status_sirkulasi', 'asc')->get()->result_array();
        $this->template($title);
        $this->load->view('peminjaman/validasi_peminjaman', $data);
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
        $buku = $this->db->where(['jenis_sirkulasi' => 1])->where_in('status_sirkulasi', [4, 9])->from('sirkulasi')->join('buku', 'buku.register = sirkulasi.b_register')->join('user', 'user.username = sirkulasi.u_username')->get()->result_array();
        for ($i = 0; $i < count($buku); $i++) {
            $awal  = date_create($buku[$i]['tanggal_akhir']);
            $akhir = date_create($buku[$i]['tanggal_pengembalian']); // waktu sekarang
            $diff  = date_diff($awal, $akhir);
            $buku[$i]['denda'] = 'Membayar denda sebesar Rp.1000 x ' . $diff->days . ' = Rp. ' . (1000 * intval($diff->days));
        }
        $data['buku'] = $buku;
        $this->template($title);
        $this->load->view('peminjaman/pelanggaran_peminjaman_admin', $data);
        $this->load->view('templates/footer');
    }
    public function validasiPelanggaran($id_sirkulasi)
    {
        $this->db->where('id_sirkulasi', $id_sirkulasi)->update('sirkulasi', ['status_sirkulasi' => 9]);
        $this->session->set_flashdata('success', 'Validasi Pelanggaran berhasil');
        redirect(site_url('/sirkulasi/peminjaman/pelanggaran_peminjaman_admin'));
    }
    public function pengembalian_peminjaman_admin()
    {
        $title = 'Pengembalian Peminjaman | Portal FH';
        if ($this->input->get('username')) {
            $username = $this->input->get('username');
            $data['user'] = $this->db->get_where('user', ['username' => $username])->row_array();
            $data['buku_dipinjam'] = $this->db->where(['jenis_sirkulasi' => 1, 'u_username' => $username])->where_in('status_sirkulasi', [2, 7])->from('sirkulasi')->join('buku', 'buku.register = sirkulasi.b_register')->get()->result_array();
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
}
