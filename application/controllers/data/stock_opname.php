<?php
defined('BASEPATH') or exit('No direct script access allowed');


class stock_opname extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('m_stock_opname');
        $this->load->model('m_status_buku');
        $this->load->model('m_jenis_akses');
        $this->load->model('m_katalog_buku');
        is_logged_in();
    }

    function get_ajax_opname()
    {
        $id_opname = $_POST['id_opname'];
        $list = $this->m_stock_opname->get_datatables_opname($id_opname);

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

            $data_buku = $this->m_katalog_buku->getData($item->register);
            $status_buku = $this->m_status_buku->getData($data_buku[0]['status_buku']);
            $jenis_akses = $this->m_jenis_akses->getData($data_buku[0]['jenis_akses']);

            $row[] = ucwords($item->nama_status);
            $row[] = '<button id="menu_status' . $item->id_buku_opname . '" type="button" class="btn" data-toggle="popover" style="border-bottom:1px solid blue; color:blue;" > ' . ucwords($status_buku[0]['nama_status']) . ' </button>';

            $row[] = ucwords($item->nama_jenis);
            $row[] = '<button id="menu_akses' . $item->id_buku_opname . '" type="button" class="btn" data-toggle="popover" style="border-bottom:1px solid blue; color:blue;" > ' . ucwords($jenis_akses[0]['nama_jenis']) . ' </button>';

            $row[] = '<a href="' . base_url('data/stock_opname/hapus_buku_opname/' . $item->id_buku_opname . '/' . $item->o_id_opname) . '" style="font-size:12px;" class="btn btn-danger mr-2" title="Hapus Data Ini" onclick=\'return confirm("ANDA YAKIN AKAN MENGHAPUS DATA PENTING INI ... ?")\'>
            <i class="fa fa-trash"></i> Hapus
        </a>';

            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->m_stock_opname->count_all_opname($id_opname),
            "recordsFiltered" => $this->m_stock_opname->count_filtered_opname($id_opname),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }

    function get_ajax_buku()
    {
        $id_opname = $_POST['id_opname'];
        $list = $this->m_stock_opname->get_datatables($id_opname);
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
            $row[] = ucwords($item->nama_status);
            $row[] = ucwords($item->nama_jenis);
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->m_stock_opname->count_all($id_opname),
            "recordsFiltered" => $this->m_stock_opname->count_filtered($id_opname),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }

    function get_count_stock()
    {
        $id_opname = $_POST['id_opname'];
        $data_opname = $this->m_stock_opname->getDataOpname(null, $id_opname);
        $data_stock = [];
        if (!empty($data_opname)) {
            $data_stock  = $this->m_stock_opname->getStockStatus($id_opname);
        }
        $data_status_buku = $this->m_status_buku->getData();
        $temp_status = [];
        $temp_status2 = [];
        $temp_status_buku = [];
        $temp_nama_status = [];
        for ($i = 0; $i < count($data_stock); $i++) {
            for ($j = 0; $j < count($data_status_buku); $j++) {
                if ($data_stock[$i]['status_buku'] == $data_status_buku[$j]['id_status']) {
                    $temp_nama_status[] = $data_stock[$i]['status_buku'];
                    $temp_status_buku[$data_status_buku[$j]['id_status']][] = $data_stock[$i]['register'];
                }
            }
        }
        $temp_nama_status_u = array_unique($temp_nama_status);
        sort($temp_nama_status_u);
        $temp_nama_status_u = array_values($temp_nama_status_u);

        for ($i = 0; $i < count($data_status_buku); $i++) {
            if (array_key_exists($data_status_buku[$i]['id_status'], $temp_status_buku)) {
                $counter = count($temp_status_buku[$data_status_buku[$i]['id_status']]);
                $temp_status2[] = "<td>$counter</td>";
            } else {
                $temp_status2[] = "<td>0</td>";
            }
        }

        for ($i = 0; $i < count($data_status_buku); $i++) {
            $temp_status[] = "<td>0</td>";
        }
        $temp_status_im = implode(" ", $temp_status);
        $temp_status2_im = implode(" ", $temp_status2);
        $count_tot_stock = count($data_stock);

        if (!empty($data_opname)) {
            echo "<tr>
                    <td>$count_tot_stock</td>
                    " . $temp_status2_im . "
                </tr>";
        } else {
            echo '<tr>
                <td>0</td>
                ' . $temp_status_im . '
            </tr>';
        }
    }

    public function index()
    {
        $data['title'] = 'Daftar Stock Opname | Portal FH';
        $data_opname = $this->m_stock_opname->getData();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/stock_opname', array('data_opname' => $data_opname));
        $this->load->view('templates/footer');
    }

    public function create()
    {
        $data['title'] = 'Daftar Stock Opname | Portal FH';
        // $data_stock_opname = $this->m_stock_opname->getData();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/add_stock_opname');
        $this->load->view('templates/footer');
    }

    public function detail($id_opname)
    {
        $data['title'] = 'Detail Stock Opname | Portal FH';
        $data_stock_opname = $this->m_stock_opname->getDataOpname(null, $id_opname);
        $data_status_buku = $this->m_status_buku->getData();
        $data_jenis_akses = $this->m_jenis_akses->getData();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('admin/detail_opname', array('data_status_buku' => $data_status_buku, 'data_stock_opname' => $data_stock_opname, 'data_jenis_akses' => $data_jenis_akses));
        $this->load->view('templates/footer');
    }

    public function addData()
    {
        $res = $this->m_stock_opname->insertData();
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data berhasil ditambahkan');
            redirect('data/stock_opname');
        } else {
            $this->session->set_flashdata('danger', 'Gagal menambahkan data');
            redirect('data/stock_opname');
        }
    }

    public function ubah($id_opname)
    {
        $res = $this->m_stock_opname->updateData($id_opname);
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data berhasil diubah');
            redirect('data/stock_opname');
        } else {
            $this->session->set_flashdata('danger', 'Gagal mengubah data');
            redirect('data/stock_opname');
        }
    }

    function hapus($id_opname)
    {
        $res = $this->m_stock_opname->deleteData($id_opname);
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
            redirect('data/stock_opname');
        } else {
            $this->session->set_flashdata('danger', 'Gagal menghapus data');
            redirect('data/stock_opname');
        }
    }

    public function add_buku_opname()
    {
        $data = $this->m_katalog_buku->getData($_POST['b_register']);
        $res = $this->m_stock_opname->insertDataOpname($data[0]['status_buku'], $data[0]['jenis_akses']);
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data berhasil ditambahkan');
            redirect('data/stock_opname/detail/' . $_POST['o_id_opname']);
        } else {
            $this->session->set_flashdata('danger', 'Gagal menambahkan data');
            redirect('data/stock_opname/detail/' . $_POST['o_id_opname']);
        }
    }

    function hapus_buku_opname($id_buku_opname, $id_opname)
    {
        $res = $this->m_stock_opname->deleteDataOpname($id_buku_opname);
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus');
            redirect('data/stock_opname/detail/' . $id_opname);
        } else {
            $this->session->set_flashdata('danger', 'Gagal menghapus data');
            redirect('data/stock_opname/detail/' . $id_opname);
        }
    }

    function ubah_status_buku_opname($id_buku_opname, $id_opname)
    {
        $data = $this->m_stock_opname->getDataOpname($id_buku_opname);
        $res = $this->m_stock_opname->updateDataOpnameStatus($data[0]['b_register']);
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data berhasil diubah');
            redirect('data/stock_opname/detail/' . $id_opname);
        } else {
            $this->session->set_flashdata('danger', 'Gagal mengubah data');
            redirect('data/stock_opname/detail/' . $id_opname);
        }
    }

    function ubah_jenis_akses_opname($id_buku_opname, $id_opname)
    {
        $data = $this->m_stock_opname->getDataOpname($id_buku_opname);
        $res = $this->m_stock_opname->updateDataOpnameAkses($data[0]['b_register']);
        if ($res >= 1) {
            $this->session->set_flashdata('success', 'Data berhasil diubah');
            redirect('data/stock_opname/detail/' . $id_opname);
        } else {
            $this->session->set_flashdata('danger', 'Gagal mengubah data');
            redirect('data/stock_opname/detail/' . $id_opname);
        }
    }
}
