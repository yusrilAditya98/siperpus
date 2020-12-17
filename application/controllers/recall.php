<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Recall extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_recall');
        $this->load->model('M_user');
        $this->load->model('M_katalog_buku');
        is_logged_in();
    }

    function get_recall()
    {
        $list = $this->M_recall->get_datatables();
        // var_dump($list);die;
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no . ".";
            $row[] = $item->no_transaksi;
            $row[] = $item->register;
            $row[] = $item->judul_buku;
            $row[] = $item->nama;
            if ($item->status_recall == 1) {
                $row[] = '<span class="badge badge-success">aktif</span>';
            } else {
                $row[] = '<span class="badge badge-danger">tidak aktif</span>';
            }
            $row[] = $item->keterangan;
            // add html for action
            $row[] = '<div class="btn-group"><button class="btn btn-sm btn-info" data-toggle="modal" data-target="#btnEditRecall' . $item->id_recall . '"><i class="fa fa-edit"></i></button>
            <a href="' . site_url('recall/deleteDataRecall/' . $item->id_recall) . '" class="btn btn-sm btn btn-danger mr-2" title="Hapus Data Ini" onclick="return confirm(/"ANDA YAKIN AKAN MENGHAPUS DATA RECALL INI ... ?/")"><i class="fa fa-trash"></i></a>

            <div class="modal fade recall-data" id="btnEditRecall' . $item->id_recall . '" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="btnDetailBukuLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="btnDetailBukuLabel">Edit Data Recall Transaksi' . $item->no_transaksi . '</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form class="form-horizontal" action="' . base_url('recall/ubahDataRecall/' . $item->id_recall) . '" method="POST" enctype="multipart/form-data">
                            <div class="modal-body">
                                <div class="form-group row">
                                    <label for="digital_pdf" class="col-sm-2 col-form-label">Keterangan</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" name="keterangan" placeholder="Keterangan" value="' . $item->keterangan . '">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="digital_pdf" class="col-sm-2 col-form-label">Status Recall</label>
                                    <div class="col-sm-12">
                                        <select class="form-control" name="status">
                                        <option value="1">aktif</option>
                                        <option value="2">tidak aktif</option>
                                        </select>
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
            ';

            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->M_recall->count_all(),
            "recordsFiltered" => $this->M_recall->count_filtered(),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }

    function get_pinjaman_recall()
    {
        $list = $this->M_recall->get_datatables2();
        $data = array();
        $no = @$_POST['start'];
        foreach ($list as $item) {
            $no++;
            $row = array();
            $row[] = $no . ".";
            $row[] = $item->no_transaksi;
            $row[] = $item->register;
            $row[] = $item->judul_buku;
            $row[] = $item->nama;
            if ($item->status_recall == 1) {
                $row[] = '<span class="badge badge-info">recall</span>';
            } else {
                $row[] = '<span class="badge badge-secondary">tidak direcall</span>';
            }
            $row[] = ' <a href="' . site_url('recall/tambahRecall/' . $item->id_sirkulasi) . '" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> Recall</a>';

            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->M_recall->count_all(),
            "recordsFiltered" => $this->M_recall->count_filtered(),
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
    public function index()
    {
        $data['title'] = 'Recall Buku | Portal FH';
        // $data['cetak_code'] = $this->db->where(['status' => 0])->from('cetak')->join('buku', 'buku.register = cetak.b_register')->get()->result_array();
        $data['data_recall'] = $this->db->from('recall as r')->join('sirkulasi as s', 'r.id_sirkulasi = s.id_sirkulasi')->join('buku as b', 's.b_register = b.register')->join('user as u', 'u.username = s.u_username')->where_in('s.status_sirkulasi', [4, 9])->get()->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/recall_buku', $data);
        $this->load->view('templates/footer');
    }
    public function tambahRecall($id_sirkulasi)
    {
        $recall = $this->db->get_where('recall', ['id_sirkulasi' => $id_sirkulasi])->row_array();
        if ($recall != null) {
            $res = 0;
        } else {
            $res = $this->M_recall->insertData($id_sirkulasi);
        }
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data Recall berhasil ditambahkan');
            redirect('recall');
        } else {
            $this->session->set_flashdata('danger', 'Gagal menambahkan, Data Recall sudah ada');
            redirect('recall');
        }
    }
    public function ubahDataRecall($id_recall)
    {
        $res = $this->M_recall->updateDataRecall($id_recall);
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data Recall berhasil diubah');
            redirect('recall');
        } else {
            $this->session->set_flashdata('danger', 'Gagal mengubah data');
            redirect('recall');
        }
    }

    public function deleteDataRecall($id_recall)
    {
        $data = $this->db->get_where('recall', ['id_recall' => $id_recall])->row_array();
        $d['status_recall'] = 0;
        $this->db->update('sirkulasi', $d, ['id_sirkulasi' => $data['id_sirkulasi']]);
        $res = $this->M_recall->deleteDataRecall($id_recall);
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data Recall berhasil dihapus');
            redirect('recall');
        } else {
            $this->session->set_flashdata('danger', 'Gagal menghapus data');
            redirect('recall');
        }
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
        $data['mhs'] = $this->M_recall->getUser($username);
        $data['status'] = "$status";
        $this->load->view('admin/bebas_pustaka_view', $data);
    }
}
