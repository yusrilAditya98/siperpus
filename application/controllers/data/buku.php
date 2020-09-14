<?php
defined('BASEPATH') or exit('No direct script access allowed');


class buku extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('m_katalog_buku');
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Daftar Sumber Koleksi | Portal FH';
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

    public function data_buku()
    {
        $data = $this->m_katalog_buku->buku_list();
        $data2 = $this->m_katalog_buku->bahasa_list();
        $data = [$data, $data2];
        echo json_encode($data);
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
            redirect('data/buku');
        } else {
            $this->session->set_flashdata('warning', 'Gagal menambahkan data');
            redirect('data/buku');
        }
    }

    public function ubahDataBuku()
    {
        $res = $this->m_katalog_buku->updateDataBuku();
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data berhasil diubah');
            redirect('data/buku');
        } else {
            $this->session->set_flashdata('warning', 'Gagal mengubah data');
            redirect('data/buku');
        }
    }

    public function deleteDataBuku($register)
    {
        $res = $this->m_katalog_buku->deleteDataBuku($register);
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
            redirect('data/buku');
        } else {
            $this->session->set_flashdata('warning', 'Gagal menghapus data');
            redirect('data/buku');
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

    public function cariOpac()
    {
        $keywords = $_GET['keywords'];
        $filter = $_GET['filter'];
        $data = [];
        switch ($filter) {
            case '1':
                $data = $this->m_katalog_buku->getOpac($keywords, 'judul_buku');
                echo json_encode($data);
                break;
            case '2':
                $data = $this->m_katalog_buku->getOpac($keywords, 'pengarang');
                echo json_encode($data);
                break;
            case '3':
                $data = $this->m_katalog_buku->getOpac($keywords, 'penerbit');
                echo json_encode($data);
                break;
            case '4':
                $data = $this->m_katalog_buku->getOpac($keywords, 'subjek');
                echo json_encode($data);
                break;
            case '5':
                $data = $this->m_katalog_buku->getOpac($keywords, 'kategori');
                echo json_encode($data);
                break;
            case '6':
                $data = $this->m_katalog_buku->getOpac($keywords, 'isbn');
                echo json_encode($data);
                break;
            default:
                $data[] =  "No Data File";
                $data[] = $keywords;
                $data[] = $filter;
                echo json_encode($data);
                break;
        }
    }
}
