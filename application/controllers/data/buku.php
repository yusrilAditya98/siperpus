<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Buku extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('Ciqrcode');
        $this->load->library('Zend');
        $this->load->model('M_katalog_buku');
        is_logged_in();
    }
    public function Barcode($id = 12332)
    {
        $this->zend->load('Zend/Barcode');
        Zend_Barcode::render('code128', 'image', array('text' => $id));
    }

    function get_ajax_admin()
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
            if ($item->digital_pdf) {
                $row[] = '<a target="_blank" href="' . base_url('assets/pdfjs/web/viewer.html?file=../../koleksi_digital/' . $item->digital_pdf) . '">' . $item->digital_pdf . '</a>';
            } else {
                $row[] = '<span class="badge badge-secondary">Belum ada</span>';
            }
            if ($item->status_buku == 1) {
                $row[] = '<span class="badge badge-success">tersedia</span>';
            } else {
                $row[] = '<span class="badge badge-secondary">dipinjam</span>';
            }
            // add html for action
            $row[] = '<div class="btn-group"><button class="btn btn-sm btn-default" data-toggle="modal" data-target="#btnDetailBuku' . $item->register . '"><i class="fa fa-info"></i></button>
            <a href="' . site_url('data/buku/ubah/' . $item->register) . '" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a>
            <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#koleksiDigital' . $item->register . '"><i class="fas fa-plus"></i></button>
            <a href="' . site_url('data/buku/deleteDataBuku/' . $item->register) . '" class="btn btn-sm btn btn-danger mr-2" title="Hapus Data Ini" onclick="return confirm(/"ANDA YAKIN AKAN MENGHAPUS DATA PENTING INI ... ?/")"><i class="fa fa-trash"></i></a></div>
            
            <div class="modal fade koleksi-digital" id="koleksiDigital' . $item->register . '" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="btnDetailBukuLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="btnDetailBukuLabel">Koleksi Digital ' . $item->judul_buku . '</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="form-horizontal" action="' . base_url('data/koleksi_digital/ubah/' . $item->register) . '" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="old_name" value="' . $item->digital_pdf . '">
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label for="digital_pdf" class="col-sm-2 col-form-label">Nama File</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" name="nama_digital" placeholder="nama file...">
                                        <small>*nama file ' . (($item->digital_pdf) ? $item->digital_pdf : 'BELUM ADA') . '</small>
                                       
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="digital_pdf" class="col-sm-2 col-form-label">File Digital</label>
                                    <div class="col-sm-12">
                                        <div class="custom-file">
                                            <input name="digital_pdf" onchange="previewImg()" type="file" class="custom-file-input" id="foto' . $item->register . '">
                                            <label class="custom-file-label" for="digital_pdf">Choose file</label>
                                        </div>
                                        <small>*format sampul berupa .pdf dengan ukuran maksimal 5MB</small>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer justify-content-between">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


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
                        <div class="row">
                            <div class="col-sm-4 col-12">
                              
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
                            <div class="row bg-light">
                            <div class="col-sm-6">
                                Jenis Koleksi
                            </div>
                            <div class="col-sm-6">
                                ' . $item->nama_jenis . '
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

    function get_ajax()
    {
        $temp_role_id = $this->input->post('role_id');
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
            if ($item->digital_pdf) {
                $row[] = '<a target="_blank" href="' . base_url('assets/pdfjs/web/viewer.html?file=../../koleksi_digital/' . $item->digital_pdf) . '">' . $item->digital_pdf . '</a>';
            } else {
                $row[] = '<span class="badge badge-secondary">Belum ada</span>';
            }
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
        $data_katalog_buku = $this->M_katalog_buku->getData();
        $data_bahasa = $this->M_katalog_buku->getBahasa();
        $data_circ = $this->M_katalog_buku->getCirc();
        $data_funding = $this->M_katalog_buku->getFunding();
        $data['buku_dipinjam'] = count($this->db->where(['jenis_sirkulasi' => 1, 'status_sirkulasi' => 0])->from('sirkulasi')->join('buku', 'buku.register = sirkulasi.b_register')->get()->result_array());
        $data['jenis_koleksi'] = $this->db->get('jenis_koleksi')->result_array();
        $data['status_buku'] = $this->db->get('status_buku')->result_array();
        $data['koleksi_digital'] = [
            0 => ['status' => 1, 'nama' => 'Ada'],
            1 => ['status' => 2, 'nama' => 'Tidak Ada']
        ];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('page/katalog_buku_anggota', array('data_katalog_buku' => $data_katalog_buku, 'data_bahasa' => $data_bahasa, 'data_circ' => $data_circ, 'data_funding' => $data_funding));
        $this->load->view('templates/footer');
    }

    public function list_buku()
    {
        $data['title'] = 'Daftar Buku | Portal FH';
        $data_katalog_buku = $this->M_katalog_buku->getData();
        $data_bahasa = $this->M_katalog_buku->getBahasa();
        $data_circ = $this->M_katalog_buku->getCirc();
        $data_funding = $this->M_katalog_buku->getFunding();
        $data_jenis_koleksi = $this->db->get('jenis_koleksi')->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('page/katalog_buku', array('data_katalog_buku' => $data_katalog_buku, 'data_bahasa' => $data_bahasa, 'data_circ' => $data_circ, 'data_funding' => $data_funding, 'data_jenis_koleksi' => $data_jenis_koleksi));
        $this->load->view('templates/footer');
    }

    public function katalog_buku_admin()
    {
        $data['title'] = 'Daftar Sumber Koleksi | Portal FH';
        $data['jenis_koleksi'] = $this->db->get('jenis_koleksi')->result_array();
        $data['status_buku'] = $this->db->get('status_buku')->result_array();
        $data['koleksi_digital'] = [
            0 => ['status' => 1, 'nama' => 'Ada'],
            1 => ['status' => 2, 'nama' => 'Tidak Ada']
        ];
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/katalog_buku_admin');

        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['title'] = 'Daftar Sumber Koleksi | Portal FH';

        $data_katalog_buku = $this->M_katalog_buku->getData();
        $data_bahasa = $this->M_katalog_buku->getBahasa();
        $data_circ = $this->M_katalog_buku->getCirc();
        $data_funding = $this->M_katalog_buku->getFunding();
        $data_sumber = $this->M_katalog_buku->getSumber();
        $data_kategori = $this->M_katalog_buku->getKategori();
        $data_jenis_akses = $this->M_katalog_buku->getJenisAkses();
        $data_jenis_koleksi = $this->db->get('jenis_koleksi')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/data/tambah_buku', array('data_katalog_buku' => $data_katalog_buku, 'data_bahasa' => $data_bahasa, 'data_circ' => $data_circ, 'data_funding' => $data_funding, 'data_sumber' => $data_sumber, 'data_kategori' => $data_kategori, 'data_jenis_akses' => $data_jenis_akses, 'data_jenis_koleksi' => $data_jenis_koleksi));
        $this->load->view('templates/footer');
    }

    public function ubah($register)
    {
        $data['title'] = 'Daftar Sumber Koleksi | Portal FH';

        $data_katalog_buku = $this->M_katalog_buku->getData($register);
        $data_bahasa = $this->M_katalog_buku->getBahasa();
        $data_circ = $this->M_katalog_buku->getCirc();
        $data_funding = $this->M_katalog_buku->getFunding();
        $data_sumber = $this->M_katalog_buku->getSumber();
        $data_kategori = $this->M_katalog_buku->getKategori();
        $data_jenis_akses = $this->M_katalog_buku->getJenisAkses();
        $data_jenis_koleksi = $this->db->get('jenis_koleksi')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/data/ubah_buku', array('data_katalog_buku' => $data_katalog_buku, 'data_bahasa' => $data_bahasa, 'data_circ' => $data_circ, 'data_funding' => $data_funding, 'data_sumber' => $data_sumber, 'data_kategori' => $data_kategori, 'data_jenis_akses' => $data_jenis_akses, 'data_jenis_koleksi' => $data_jenis_koleksi));
        $this->load->view('templates/footer');
    }

    public function addDataBuku()
    {
        $res = $this->M_katalog_buku->insertDataBuku();
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
        $res = $this->M_katalog_buku->updateDataBuku();
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
        $res = $this->M_katalog_buku->deleteDataBuku($register);
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
        $res = $this->M_katalog_buku->insertData();
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
        $res = $this->M_katalog_buku->updateData();
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
        $res = $this->M_katalog_buku->deleteData($id_katalog_buku);
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
        $list = $this->M_katalog_buku->get_datatables($keywords, $filter);
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
            "recordsTotal" => $this->M_katalog_buku->count_all($keywords, $filter),
            "recordsFiltered" => $this->M_katalog_buku->count_filtered($keywords, $filter),
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
    public function import()
    {
        // upload file xls
        $target = basename($_FILES['import-data']['name']);
        if ($_FILES['import-data']['name']) {
            $config['allowed_types'] = 'xls';
            $config['max_size']     = '4096'; //kb
            $config['upload_path'] = FCPATH . 'assets/berkas/';
            $config['overwrite'] = true;
            $config['file_name'] = $_FILES['import-data']['name'];
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $this->upload->do_upload('import-data');
        };

        // beri permisi agar file xls dapat di baca
        chmod(FCPATH . 'assets/berkas/' .  $target, 0777);
        // mengambil isi file xls
        $path = FCPATH . 'assets/berkas/' .  $target;
        $data = new Spreadsheet_Excel_Reader($path, false);
        // menghitung jumlah baris data yang ada
        $jumlah_baris = $data->rowcount($sheet_index = 0);
        $input_data = [];
        for ($i = 3; $i < $jumlah_baris; $i++) {
            if (str_replace("\0", "", $data->val($i, 2)) == "") {
                break;
            }
            // menangkap data dan memasukkan ke variabel sesuai dengan kolumnya masing-masing
            $result = [
                "register" => str_replace("\0", "", $data->val($i, 2)),
                "judul_buku" => str_replace("\0", "", $data->val($i, 3)),
                "pengarang" => intval(str_replace("\0", "", $data->val($i, 4))),
                "penerbit" => str_replace("\0", "", $data->val($i, 5)),
                "tahun_terbit" => 'p' . str_replace("\0", "", $data->val($i, 6)),
                "kondisi_fisik" => str_replace("\0", "", $data->val($i, 8)),
                "status_buku" => str_replace("\0", "", $data->val($i, 22)),
                "jenis_akses" => str_replace("\0", "", $data->val($i, 21)),
                "kota_terbit" => str_replace("\0", "", $data->val($i, 7)),
                "isbn" => str_replace("\0", "", $data->val($i, 11)),
                "no_dewey" => str_replace("\0", "", $data->val($i, 12)),
                "author_abrev" => str_replace("\0", "", $data->val($i, 13)),
                "title_abrev" => str_replace("\0", "", $data->val($i, 14)),
                "sampul" => "",
                "volume" => str_replace("\0", "", $data->val($i, 9)),
                "bibliography" => str_replace("\0", "", $data->val($i, 10)),
                "subject" => str_replace("\0", "", $data->val($i, 15)),
                "digital_pdf" => "",
                "b_id_bahasa" => str_replace("\0", "", $data->val($i, 16)),
                "ct_id_circ_type" => str_replace("\0", "", $data->val($i, 17)),
                "f_id_funding" => str_replace("\0", "", $data->val($i, 18)),
                "sk_id_sumber" => str_replace("\0", "", $data->val($i, 19)),
                "k_id_kategori" => str_replace("\0", "", $data->val($i, 20)),
                "jk_id_jenis" => 2,
            ];

            // upload sampul
            // $upload_image = $_FILES['sampul'];
            // $upload_image = $data->val($i, 23);
            // if ($upload_image) {
            //     $config['allowed_types'] = 'jpg|JPG|jpeg|JPEG|png|PNG';
            //     $config['max_size']     = '1024'; //kb
            //     $config['upload_path'] = FCPATH . 'assets/sampul_buku/';
            //     $config['file_name'] = 'sampul_buku_' . $data['judul_buku'];
            //     $this->load->library('upload', $config);
            //     if ($this->upload->do_upload('sampul')) {
            //         $data['sampul'] = $this->upload->data('file_name');
            //     } else {
            //         return false;
            //     }
            // }
            array_push($input_data, $result);
        };
        // var_dump($input_data);die;
        $this->db->insert_batch('buku', $input_data);
        // hapus kembali file .xls yang di upload tadi
        unlink($path);
        // alihkan halaman ke index.php
        $this->session->set_flashdata('success', 'Impor data buku berhasil');
        redirect('data/buku/katalog_buku_admin');
    }
}
