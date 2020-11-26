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
    {
    }
    // kharis
    public function perpanjangan()
    {
    }
    // fadli
    public function sangsi()
    {
    }
    // khris
    public function koleksi_sering_dipinjam()
    {
    }
    // fadli
    public function keterlambatan()
    {
    }
    // kharis
    public function baca_ditempat()
    {
    }
    // fadli
    public function stock_opname()
    {
    }
    // yusril
    public function koleksi_digital()
    {
    }
}
