<?php
defined('BASEPATH') or exit('No direct script access allowed');


class kop_surat extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('m_kop_surat');
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Daftar Sumber Koleksi | Portal FH';
        $data_kop_surat = $this->m_kop_surat->getData();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/data/kop_surat', array('data_kop_surat' => $data_kop_surat));
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $res = $this->m_kop_surat->insertData();
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data berhasil ditambahkan');
            redirect('data/kop_surat');
        } else {
            $this->session->set_flashdata('danger', 'Gagal menambahkan data');
            redirect('data/kop_surat');
        }
    }

    public function ubah($id_kop_surat)
    {
        $res = $this->m_kop_surat->updateData($id_kop_surat);
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data berhasil diubah');
            redirect('data/kop_surat');
        } else {
            $this->session->set_flashdata('danger', 'Gagal mengubah data');
            redirect('data/kop_surat');
        }
    }

    function hapus($id_kop_surat)
    {
        $data = $this->m_kop_surat->getData($id_kop_surat);

        unlink(FCPATH . 'assets/img/kopSurat/' . $data[0]['nama_file']);

        $res = $this->m_kop_surat->deleteData($id_kop_surat);
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
            redirect('data/kop_surat');
        } else {
            $this->session->set_flashdata('danger', 'Gagal menghapus data');
            redirect('data/kop_surat');
        }
    }

    public function get_ajax()
    {
        $data = $this->db->get('kop_surat')->result_array();
        echo json_encode($data);
    }
}
