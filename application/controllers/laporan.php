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

class laporan extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper("url");
        $this->load->model('m_katalog_buku');
        $this->load->model('m_sirkulasi');
        $this->load->model('m_jenis_denda');
        $this->load->model('m_pelanggaran');
        $this->load->model('m_status_buku');
        $this->load->model('m_stock_opname');
    }
    // yusril
    public function peminjaman()
    {
        $data['title'] = "Laporan Peminjaman";
        $data['buku_dipinjam'] =  $this->m_katalog_buku->getBukuDipinjam(null, $this->input->get('status_sirkulasi'), $this->input->get('start_date'), $this->input->get('end_date'));
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
        $data['buku_dipinjam'] =  $this->m_sirkulasi->getBukuDipinjam(null, $this->input->get('status_sirkulasi'), $this->input->get('start_date'), $this->input->get('end_date'));
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('laporan/peminjaman', $data);
        $this->load->view('templates/footer');
    }
    // yusril
    public function koleksi_buku()
    { }
    // kharis
    public function perpanjangan()
    { }
    // fadli
    public function sangsi()
    {
        $data['title'] = "Laporan Sangsi";
        $data['sirkulasi_pelanggaran'] =  $this->m_pelanggaran->getListPelanggaran(null, $this->input->get('id_pelanggaran'), null, $this->input->get('start_date'), $this->input->get('end_date'));
        $data['pelanggaran'] =  $this->m_pelanggaran->getPelanggaran();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('laporan/sangsi', $data);
        $this->load->view('templates/footer');
    }
    // khris
    public function koleksi_sering_dipinjam()
    { }
    // fadli
    public function keterlambatan()
    {
        $data['title'] = "Laporan Keterlambatan";
        $data['sirkulasi_pelanggaran'] =  $this->m_pelanggaran->getListPelanggaran(null, 1, null, $this->input->get('start_date'), $this->input->get('end_date'));
        $this->load->view('templates/header', $data);
        $this->load->view('templates/topbar');
        $this->load->view('templates/sidebar');
        $this->load->view('laporan/keterlambatan', $data);
        $this->load->view('templates/footer');
    }
    // kharis
    public function baca_ditempat()
    { }
    // fadli
    public function stock_opname()
    {
        $data['title'] = "Laporan Stock Opname";
        $data['data_status_buku'] = $this->m_status_buku->getData();
        $id_opname = [];
        $status_opname = [];
        $opname = $this->m_stock_opname->getDataLaporanOpname(null, $this->input->get('start_date'), $this->input->get('end_date'));
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
    { }
}
