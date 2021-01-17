<?php
defined('BASEPATH') or exit('No direct script access allowed');


class M_sirkulasi extends CI_Model
{

    // start datatables
    var $column_order = array(null, 's.tanggal_sirkulasi', 's.u_username', 'u.nama', 'b.register', 'b.judul_buku', 'b.penerbit', 'b.pengarang');
    //set column field database for datatable orderable
    var $column_search = array('s.b_register', 'b.judul_buku', 'b.pengarang', 'b.penerbit', 'u.nama', 's.u_username');
    //set column field database for datatable searchable
    var $order = array('s.tanggal_sirkulasi' => 'desc'); // default order 

    private function _get_datatables_query($keywords = null, $filter = null)
    {
        $this->db->select('b.*,s.*,u.nama');
        $this->db->from('sirkulasi as s');
        $this->db->join('buku as b', 's.b_register=b.register', 'left');
        $this->db->join('user as u', 's.u_username=u.username', 'left');
        $this->db->where('s.jenis_sirkulasi', 2);
        if ($keywords != null && $filter != null) {
            $this->db->like($filter, $keywords);
        }
        $i = 0;
        foreach ($this->column_search as $item) { // loop column 
            if (@$_POST['search']['value']) { // if datatable send POST for search
                if ($i === 0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
        if (isset($_POST['order'])) { // here order processing
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    function get_datatables($keywords = null, $filter = null)
    {
        if ($keywords != null && $filter != null) {
            $this->_get_datatables_query($keywords, $filter);
        } else {
            $this->_get_datatables_query();
        }
        if (@$_POST['length'] != -1)
            $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered($keywords = null, $filter = null)
    {
        if ($keywords != null && $filter != null) {
            $this->_get_datatables_query($keywords, $filter);
        } else {
            $this->_get_datatables_query();
        }
        $query = $this->db->get();
        return $query->num_rows();
    }
    function count_all($keywords = null, $filter = null)
    {
        $this->db->from('buku');
        if ($keywords != null && $filter != null) {
            $this->db->like($filter, $keywords);
        }
        return $this->db->count_all_results();
    }
    // end datatables


    public function insertBacaDitempat($data)
    {
        $result = [];
        $cekUser = $this->db->get_where('user', ['username' => $data['username']])->data_seek();

        if ($cekUser) {
            $buku = $this->db->get_where('buku', ['register' => $data['register']])->row_array();
            if ($buku != null) {
                $sirkulasi = [
                    'u_username' => $data['username'],
                    'b_register' =>  $data['register'],
                    'jenis_sirkulasi' => 2,
                    'tanggal_sirkulasi' => date('Y-m-d'),
                    'status_sirkulasi' => 8,
                ];
                $this->db->insert('sirkulasi', $sirkulasi);
                $result = [
                    'message' =>  $buku,
                    'status' => true
                ];
                return $result;
            } else {
                $result = [
                    'message' => 'buku tidak ditemukan',
                    'status' => false
                ];
                return $result;
            }
        } else {
            $result = [
                'message' => 'username tidak ditemukan',
                'status' => false
            ];
            return $result;
        }
    }

    public function listBukuBaca($username = null, $kategori = null)
    {
        $this->db->select('*');
        $this->db->from('sirkulasi as s');
        $this->db->join('buku as b', 'b.register=s.b_register', 'left');
        if ($username) {
            $this->db->where('s.u_username', $username);
        }

        if ($kategori == 'terkini') {
            $this->db->where_in('s.status_sirkulasi', 0);
        } else {
            $this->db->where_in('s.status_sirkulasi', 1);
            $this->db->or_where_in('s.status_sirkulasi', 2);
            $this->db->or_where_in('s.status_sirkulasi', 3);
            $this->db->or_where_in('s.status_sirkulasi', 8);
        }
        return $this->db->get()->result_array();
    }


    // daftar validasi
    var $column_order_v = array(null, 'u.nama', 'u.username', 's.no_transaksi', 's.tanggal_mulai', 's.tanggal_akhir', 's.tanggal_sirkulasi', 's.status_sirkulasi', null);
    //set column field database for datatable orderable
    var $column_search_v = array('u.nama', 'u.username', 's.no_transaksi', 's.tanggal_mulai', 's.tanggal_akhir', 's.tanggal_sirkulasi', 's.status_sirkulasi');
    //set column field database for datatable searchable
    var $order_v = array('s.status_sirkulasi' => 'asc'); // default order 
    private function _getBukuValidasi($keywords = null, $filter = null)
    {
        $this->db->select('u.nama,u.username,s.no_transaksi,s.tanggal_mulai,s.tanggal_akhir,s.tanggal_sirkulasi,s.status_sirkulasi');
        $this->db->from('sirkulasi as s');
        $this->db->join('user as u', 'u.username=s.u_username', 'left');
        $this->db->where_in('s.status_sirkulasi', [1, 2, 3, 4]);
        $this->db->where('s.jenis_sirkulasi', 1);
        $this->db->group_by('s.no_transaksi');


        if ($keywords != null && $filter != null) {
            $this->db->like($filter, $keywords);
        }
        $i = 0;
        foreach ($this->column_search_v as $item) { // loop column 
            if (@$_POST['search']['value']) { // if datatable send POST for search
                if ($i === 0) { // first loop
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                } else {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
                if (count($this->column_search_v) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }

        if ($this->input->post('status_sirkulasi')) {
            $this->db->where('s.status_sirkulasi', $this->input->post('status_sirkulasi'));
        }

        if ($this->input->post('start_date')) {
            $this->db->where('s.tanggal_mulai >=', $this->input->post('start_date'));
        }
        if ($this->input->post('end_date')) {
            $this->db->where('s.tanggal_mulai <=', $this->input->post('end_date'));
        }


        if (isset($_POST['order'])) { // here order processing
            $this->db->order_by($this->column_order_v[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order_v)) {
            $order = $this->order_v;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function get_daftarvalidasi($keywords = null, $filter = null)
    {
        if ($keywords != null && $filter != null) {
            $this->_getBukuValidasi($keywords, $filter);
        } else {
            $this->_getBukuValidasi();
        }
        if (@$_POST['length'] != -1)
            $this->db->limit(@$_POST['length'], @$_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered_v($keywords = null, $filter = null)
    {
        if ($keywords != null && $filter != null) {
            $this->_getBukuValidasi($keywords, $filter);
        } else {
            $this->_getBukuValidasi();
        }
        $query = $this->db->get();
        return $query->num_rows();
    }
    function count_all_v($keywords = null, $filter = null)
    {
        $this->db->from('sirkulasi');
        $this->db->where('jenis_sirkulasi', 1);
        if ($keywords != null && $filter != null) {
            $this->db->like($filter, $keywords);
        }
        return $this->db->count_all_results();
    }
    // selesai daftar valiasdi


    // daftar buku yang dipinjam 
    public function bukuDipinjam($no_transaksi)
    {
        $dataBuku = $this->db->select('register,judul_buku,status_sirkulasi,pengarang,penerbit,tahun_terbit,status_sirkulasi')->from('sirkulasi')->join('buku', 'buku.register=sirkulasi.b_register', 'left')->where('no_transaksi', $no_transaksi)->get()->result_array();
        return $dataBuku;
    }

    // update status pengembalian

    public function updatePengembalianBuku($data)
    {
        $this->db->set('pj_entry_pengembalian', $this->session->userdata("username"));
        $this->db->set('tanggal_pengembalian', date('Y-m-d'));
        $this->db->set('status_sirkulasi', $data['status']);
        $this->db->where('no_transaksi', $data['no_transaksi']);
        $this->db->where('b_register', $data['register']);
        $this->db->update('sirkulasi');
    }

    public function insertSirkulasiPelanggaran($data)
    {
        // status 1 = belum diselesaikan
        // status 2 = sudah diselesaikan
        $this->db->insert('sirkulasi_pelanggaran', $data);
    }

    public function updateSirkulasiPelanggarang($data)
    {
        $this->db->update('sirkulasi_pelanggaran', $data, ['s_id_sirkulasi' => $data['s_id_sirkulasi'], 'p_id_pelanggaran' => $data['p_id_pelanggaran']]);
    }

    public function dataAdmin()
    {
        $this->db->select('COUNT(id_sirkulasi) as jumlah,status_sirkulasi');
        $this->db->from('sirkulasi');
        $this->db->group_by('status_sirkulasi');
        $dataStatus =  $this->db->get()->result_array();
        $result = [
            'kranjang' => 0, // 0
            'pengajuan' => 0, // 1
            'persiapan' => 0, // 2
            'dapat_diambil' => 0, // 3
            'pinjam' => 0, // 4
            'tolak_peminjaman' => 0, // 5
            'pelanggaran' => 0, // 6
            'pengajuan_perpanjangan' => 0, // 7
            'tolak_perpanjangan' => 0, //8
            'valid_perpanjangan' => 0, //9
            'selesai_peminjaman' => 0, //10
            'telat' => 0
        ];
        foreach ($dataStatus as $d) {
            if ($d['status_sirkulasi'] == 1) {
                $result['pengajuan'] = $d['jumlah'];
            } elseif ($d['status_sirkulasi'] == 2) {
                $result['persiapan'] = $d['jumlah'];
            } elseif ($d['status_sirkulasi'] == 3) {
                $result['dapat_diambil'] = $d['jumlah'];
            } elseif ($d['status_sirkulasi'] == 4) {
                $result['pinjam'] = $d['jumlah'];
            } elseif ($d['status_sirkulasi'] == 5) {
                $result['tolak_peminjaman'] = $d['jumlah'];
            } elseif ($d['status_sirkulasi'] == 6) {
                $result['pelanggaran'] = $d['jumlah'];
            } elseif ($d['status_sirkulasi'] == 7) {
                $result['pengajuan_perpanjangan'] = $d['jumlah'];
            } elseif ($d['status_sirkulasi'] == 8) {
                $result['tolak_perpanjangan'] = $d['jumlah'];
            } elseif ($d['status_sirkulasi'] == 9) {
                $result['valid_perpanjangan'] = $d['jumlah'];
            } else {
                $result['selesai_peminjaman'] = $d['jumlah'];
            }
        }

        $telat = $this->db->select('COUNT(id_sirkulasi) as telat')->from('sirkulasi')->where('tanggal_akhir <', date('Y-m-d'))->where('status_sirkulasi !=', 9)->get()->row_array();
        $telatPerpanjangan = $this->db->select('COUNT(id_sirkulasi) as telat')->from('sirkulasi')->where('tanggal_perpanjangan <', date('Y-m-d'))->where('status_sirkulasi', 9)->get()->row_array();

        $result['telat'] = $telat['telat'] + $telatPerpanjangan['telat'];
        return $result;
    }

    public function getDataKeranjang($start_date = null, $end_date = null)
    {
        $this->db->select('*');
        $this->db->from('sirkulasi as s');
        $this->db->join('buku as b', 'b.register=s.b_register', 'left');
        $this->db->join('user as u', 'u.username=s.u_username', 'left');
        $this->db->where('s.jenis_sirkulasi', 1);
        $this->db->where('s.status_sirkulasi', 0);
        if ($start_date) {
            $this->db->where('s.tanggal_mulai >=', $start_date);
        }
        if ($end_date) {
            $this->db->where('s.tanggal_mulai <=', $end_date);
        }
        return $this->db->get()->result_array();
    }
}
