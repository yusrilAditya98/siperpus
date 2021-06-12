<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Export to Excel multiple sheets with CI and Spout
 *
 * @author budy k
 *
 */

//load Spout Library
require_once APPPATH . '/third_party/spout/src/Spout/Autoloader/autoload.php';
//lets Use the Spout Namespaces
use Box\Spout\Writer\WriterFactory;
use Box\Spout\Common\Type;
use Box\Spout\Writer\Style\StyleBuilder;

class Laporan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper("url");
        $this->load->model('M_katalog_buku');
        $this->load->model('M_sirkulasi');
        $this->load->model('M_jenis_denda');
        $this->load->model('M_pelanggaran');
        $this->load->model('M_status_buku');
        $this->load->model('M_stock_opname');
        is_logged_in();
    }
    public function Barcode($id = 12332)
    {
        $this->zend->load('Zend/Barcode');
        Zend_Barcode::render('code128', 'image', array('text' => $id));
    }

    function get_ajax_admin($kategori = null)
    {
        if ($kategori == 'laporan') {
            $list = $this->M_katalog_buku->get_datatables_laporan();
        } else {
            $list = $this->M_katalog_buku->get_datatables();
        }
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
            $row[] =  $item->isbn;
            $row[] = $item->no_dewey;
            $row[] = $item->kota_terbit;
            $row[] = $item->nama_bahasa;
            $row[] = $item->nama_circ_type;
            $row[] = $item->nama_funding;
            $row[] = $item->nama_sumber;
            $row[] = $item->author_abrev;
            $row[] = $item->title_abrev;
            $row[] = $item->volume;
            $row[] = $item->kondisi_fisik;
            $row[] = $item->bibliography;
            $row[] = $item->subject;
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

    function get_ajax_koleksi_digital()
    {

        $list = $this->M_katalog_buku->get_datatables_koleksi();
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
            $row[] = $item->digital_pdf;

            // add html for action
            $row[] =  $item->isbn;
            $row[] = $item->no_dewey;
            $row[] = $item->pengarang;
            $row[] = $item->nama_bahasa;
            $row[] = $item->nama_circ_type;
            $row[] = $item->nama_funding;
            $row[] = $item->nama_sumber;
            $row[] = $item->author_abrev;
            $row[] = $item->title_abrev;
            $row[] = $item->volume;
            $row[] = $item->kondisi_fisik;
            $row[] = $item->bibliography;
            $row[] = $item->subject;
            $data[] = $row;
        }
        $output = array(
            "draw" => @$_POST['draw'],
            "recordsTotal" => $this->M_katalog_buku->count_all_digital(),
            "recordsFiltered" => $this->M_katalog_buku->count_filtered_digital(),
            "data" => $data,
        );
        // output to json format
        echo json_encode($output);
    }

    // kharis
    public function pengunjung_web()
    {
        $data['title'] = "Laporan Pengunjung Web";
        
        $this->db->from('log_pengunjung as p')
        ->join('user as u', 'p.username = u.username');
        if ($this->input->get('start_date')) {
            $this->db->where('tanggal >=', $this->input->get('start_date'));
        }
        if ($this->input->get('end_date')) {
            $this->db->where('tanggal <=', $this->input->get('end_date'));
        }
        $data['pengunjung'] = $this->db->get()->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('laporan/pengunjung_web', $data);
        $this->load->view('templates/footer');
    }

    // kharis
    public function pengunjung_perpus()
    {
        $data['title'] = "Laporan Pengunjung Perpus";
        $this->db->from('pengunjung as p')
        ->join('user as u', 'p.username = u.username');
        if ($this->input->get('start_date')) {
            $this->db->where('tanggal >=', $this->input->get('start_date'));
        }
        if ($this->input->get('end_date')) {
            $this->db->where('tanggal <=', $this->input->get('end_date'));
        }
        $data['pengunjung'] = $this->db->get()->result_array();$this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('laporan/pengunjung_perpus', $data);
        $this->load->view('templates/footer');
    }


    // yusril
    public function peminjaman()
    {
        $data['title'] = "Laporan Peminjaman";
        $data['buku_dipinjam'] =  $this->M_katalog_buku->getBukuDipinjam(null, $this->input->get('status_sirkulasi'), $this->input->get('start_date'), $this->input->get('end_date'));
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('laporan/peminjaman', $data);
        $this->load->view('templates/footer');
    }

    // yusril
    public function keranjang_buku()
    {
        $data['title'] = "Laporan Keranjang Buku";
        $data['buku'] =  $this->M_sirkulasi->getDataKeranjang($this->input->get('start_date'), $this->input->get('end_date'));
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('laporan/keranjang_buku', $data);
        $this->load->view('templates/footer');
    }
    // yusril
    public function koleksi_buku()
    {
        $data['title'] = "Laporan Koleksi Buku";
        $data['jenis_koleksi'] = $this->db->get('jenis_koleksi')->result_array();
        $data['status_buku'] = $this->db->get('status_buku')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('laporan/katalog_buku', $data);
        $this->load->view('templates/footer');
    }
    // kharis
    public function perpanjangan()
    {
        $data['title'] = "Laporan Perpanjangan";
        $data['perpanjangan'] =  $this->M_katalog_buku->getBukuPerpanjangan(null, $this->input->get('status_sirkulasi'), $this->input->get('start_date'), $this->input->get('end_date'));
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('laporan/perpanjangan', $data);
        $this->load->view('templates/footer');
    }
    // fadli
    public function sangsi()
    {
        $data['title'] = "Laporan Sangsi";
        $data['sirkulasi_pelanggaran'] =  $this->M_pelanggaran->getListPelanggaran(null, $this->input->get('id_pelanggaran'), null, $this->input->get('start_date'), $this->input->get('end_date'));
        $data['pelanggaran'] =  $this->M_pelanggaran->getPelanggaran();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('laporan/sangsi', $data);
        $this->load->view('templates/footer');
    }
    // khris
    public function koleksi_sering_dipinjam()
    {
        $data['title'] = "Laporan Koleksi Sering Dipinjam";
        $data['sering_dipinjam'] = $this->M_katalog_buku->getSeringDipinjam(null, $this->input->get('start_date'), $this->input->get('end_date'));
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('laporan/koleksi_sering_dipinjam', $data);
        $this->load->view('templates/footer');
    }
    // fadli
    public function keterlambatan()
    {
        $data['title'] = "Laporan Keterlambatan";
        $data['sirkulasi_pelanggaran'] =  $this->M_pelanggaran->getListPelanggaran(null, 1, null, $this->input->get('start_date'), $this->input->get('end_date'));
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('laporan/keterlambatan', $data);
        $this->load->view('templates/footer');
    }
    // kharis
    public function baca_ditempat()
    {
        $data['title'] = "Laporan Baca Ditempat";
        $data['baca_ditempat'] = $this->M_katalog_buku->getBacaDitempat(null, $this->input->get('start_date'), $this->input->get('end_date'));
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('laporan/baca_ditempat', $data);
        $this->load->view('templates/footer');
    }
    // fadli
    public function stock_opname()
    {
        $data['title'] = "Laporan Stock Opname";
        $data['data_status_buku'] = $this->M_status_buku->getData();
        $id_opname = [];
        $status_opname = [];
        $opname = $this->M_stock_opname->getDataLaporanOpname(null, $this->input->get('start_date'), $this->input->get('end_date'));
        if (count($opname) >= 1) {
            foreach ($opname as $o) {
                if ($o['status_now'] != null || $o['akses_now'] != null) {
                    $status_opname[$o['id_opname']][] = $o['status_now'];
                } else {
                    $status_opname[$o['id_opname']][] = null;
                }
                $id_opname[] = $o['id_opname'] . "/" . $o['keterangan'] . "/" . substr($o['tanggal'], 0, 10);
            }
        }
        $id_opname = array_unique($id_opname);
        sort($id_opname);
        $data['data_opname'] = $id_opname;
        $data['count_opname'] = $status_opname;
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('laporan/stock_opname', $data);
        $this->load->view('templates/footer');
    }
    // yusril
    public function koleksi_digital()
    {
        $data['title'] = "Laporan Koleksi Buku";
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('laporan/koleksi_digital', $data);
        $this->load->view('templates/footer');
    }

    //yusril
    public function pembayaran()
    {
        $data['title'] = "Laporan Pembayaran";
        $data['show_table'] = false;
        $data['pembayaran'] = [];
        $show = $this->input->post('show');
        $start_date = $this->input->post('start_date');
        $end_date = $this->input->post('end_date');
        $status = $this->input->post('status');

        if ($show) {
            $data['show_table'] = $show;
            $data['pembayaran'] = $this->M_sirkulasi->getLaporanPembayaran($start_date, $end_date, $status);
        }
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('laporan/pembayaran', $data);
        $this->load->view('templates/footer');
    }
}
