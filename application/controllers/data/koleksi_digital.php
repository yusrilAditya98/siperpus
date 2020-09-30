<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Koleksi_digital extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('m_koleksi_digital', 'kd');
        $this->load->model('m_jenis_koleksi', 'jk');
        is_logged_in();
    }

    public function index()
    {
        $data['title'] = 'Koleksi Digital';
        $data['list_koleksi'] = $this->kd->getKoleksi();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('koleksi_digital/list_koleksi_digital');
        $this->load->view('templates/footer');
    }

    public function tambah()
    {
        $data['title'] = 'Tambah Koleksi Digital';
        $this->form_validation->set_rules('judul_koleksi', 'Judul Koleksi', 'required');
        $this->form_validation->set_rules('pengarang', 'Pengarang', 'required');
        $this->form_validation->set_rules('penerbit', 'Penerbit', 'required');
        $this->form_validation->set_rules('jk_id_jenis', 'Jenis Koleksi', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar');
            $this->load->view('templates/sidebar');
            $this->load->view('koleksi_digital/add_koleksi_digital');
            $this->load->view('templates/footer');
        } else {
            $addKoleksi = $this->kd->insertKoleksi();
            if ($addKoleksi == true) {
                $this->session->set_flashdata('success', 'Data berhasil ditambah');
                redirect('data/koleksi_digital');
            } else {
                $this->session->set_flashdata('danger', 'Data gagal ditambah');
                redirect('data/koleksi_digital');
            }
        }
    }

    public function ubah($id_koleksi)
    {
        $data['title'] = 'Ubah Koleksi Digital';
        $data['koleksi_digital'] = $this->kd->getKoleksi($id_koleksi);
        $data['jenis_koleksi'] = $this->jk->getData();
        $this->form_validation->set_rules('judul_koleksi', 'Judul Koleksi', 'required');
        $this->form_validation->set_rules('pengarang', 'Pengarang', 'required');
        $this->form_validation->set_rules('penerbit', 'Penerbit', 'required');
        $this->form_validation->set_rules('jk_id_jenis', 'Jenis Koleksi', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/topbar');
            $this->load->view('templates/sidebar');
            $this->load->view('koleksi_digital/edit_koleksi_digital');
            $this->load->view('templates/footer');
        } else {
            $addKoleksi = $this->kd->updateKoleksi($id_koleksi);
            if ($addKoleksi == true) {
                $this->session->set_flashdata('success', 'Data berhasil diubah');
                redirect('data/koleksi_digital');
            } else {
                $this->session->set_flashdata('danger', 'Data gagal diubah');
                redirect('data/koleksi_digital');
            }
        }
    }

    public function hapus($id_koleksi)
    {
        $this->kd->deleteKoleksi($id_koleksi);
        $this->session->set_flashdata('success', 'Data berhasil dihapus');
        redirect('data/koleksi_digital');
    }
}
