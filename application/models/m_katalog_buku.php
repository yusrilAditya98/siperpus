<?php
defined('BASEPATH') or exit('No direct script access allowed');


class m_katalog_buku extends CI_Model
{
    // start datatables
    var $column_order = array(null, 'b.register', 'b.judul_buku', 'b.pengarang', 'b.penerbit', 'b.tahun_terbit', 'b.digital_pdf', null);
    //set column field database for datatable orderable
    var $column_search = array('b.register', 'b.judul_buku', 'b.pengarang', 'b.penerbit', 'b.tahun_terbit');
    //set column field database for datatable searchable
    var $order = array('b.register' => 'asc'); // default order 

    private function _get_datatables_query($keywords = null, $filter = null)
    {
        // $this->db->select('*');
        $this->db->select('b.*, k.nama_kategori, ba.nama_bahasa, c.nama_circ_type, f.nama_funding, sk.nama_sumber');
        $this->db->from('buku as b');
        $this->db->join('kategori as k', 'b.k_id_kategori = k.id_kategori', 'left');
        $this->db->join('bahasa as ba', 'b.b_id_bahasa = ba.id_bahasa', 'left');
        $this->db->join('circ_type as c', 'b.ct_id_circ_type = c.id_circ_type', 'left');
        $this->db->join('funding as f', 'b.f_id_funding = f.id_funding', 'left');
        $this->db->join('sumber_koleksi as sk', 'b.sk_id_sumber = sk.id_sumber', 'left');
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

    public function getData($register = null)
    {
        // $data = $this->db->query('select * from buku ' . $where);
        // $this->db->select('*');
        // $this->db->from('buku');
        $this->db->select('b.*, k.nama_kategori, ba.nama_bahasa, c.nama_circ_type, f.nama_funding, sk.nama_sumber, j.nama_jenis');
        $this->db->from('buku as b');
        $this->db->join('kategori as k', 'b.k_id_kategori = k.id_kategori', 'left');
        $this->db->join('bahasa as ba', 'b.b_id_bahasa = ba.id_bahasa', 'left');
        $this->db->join('circ_type as c', 'b.ct_id_circ_type = c.id_circ_type', 'left');
        $this->db->join('funding as f', 'b.f_id_funding = f.id_funding', 'left');
        $this->db->join('sumber_koleksi as sk', 'b.sk_id_sumber = sk.id_sumber', 'left');
        $this->db->join('jenis_akses as j', 'b.jenis_akses = j.id_jenis', 'left');
        if ($register != null) {
            $this->db->where('register', $register);
        }
        return $this->db->get()->result_array();
        // return $data->result_array();
    }

    public function getBahasa($where = "")
    {
        $this->db->select('*');
        $this->db->from('bahasa');
        return $this->db->get()->result_array();
    }

    public function getCirc($where = "")
    {
        $this->db->select('*');
        $this->db->from('circ_type');
        return $this->db->get()->result_array();
    }

    public function getFunding($where = "")
    {
        $this->db->select('*');
        $this->db->from('funding');
        return $this->db->get()->result_array();
    }

    public function getSumber($where = "")
    {
        $this->db->select('*');
        $this->db->from('sumber_koleksi');
        return $this->db->get()->result_array();
    }

    public function getKategori($where = "")
    {
        $this->db->select('*');
        $this->db->from('kategori');
        return $this->db->get()->result_array();
    }

    public function getJenisAkses($where = "")
    {
        $this->db->select('*');
        $this->db->from('jenis_akses');
        return $this->db->get()->result_array();
    }

    public function insertDataBuku()
    {
        $data =  [
            'register' => $this->input->post('register'),
            'judul_buku' => $this->input->post('judul_buku'),
            'pengarang' => $this->input->post('pengarang'),
            'penerbit' => $this->input->post('penerbit'),
            'tahun_terbit' => $this->input->post('tahun_terbit'),
            'kondisi_fisik' => $this->input->post('kondisi_fisik'),
            'status_buku' => $this->input->post('status_buku'),
            'jenis_akses' => $this->input->post('jenis_akses'),
            'kota_terbit' => $this->input->post('kota_terbit'),
            'isbn' => $this->input->post('isbn'),
            'no_dewey' => $this->input->post('no_dewey'),
            'author_abrev' => $this->input->post('author_abrev'),
            'title_abrev' => $this->input->post('title_abrev'),
            'sampul' => $this->input->post('sampul'),
            'volume' => $this->input->post('volume'),
            'bibliography' => $this->input->post('bibliography'),
            'subject' => $this->input->post('subject'),
            'b_id_bahasa' => $this->input->post('b_id_bahasa'),
            'ct_id_circ_type' => $this->input->post('ct_id_circ_type'),
            'f_id_funding' => $this->input->post('f_id_funding'),
            'sk_id_sumber' => $this->input->post('sk_id_sumber'),
            'k_id_kategori' => $this->input->post('k_id_kategori'),
        ];

        // upload sampul
        $upload_image = $_FILES['sampul'];
        if ($upload_image) {
            $config['allowed_types'] = 'jpg|JPG|jpeg|JPEG|png|PNG';
            $config['max_size']     = '1024'; //kb
            $config['upload_path'] = './assets/sampul_buku/';
            $config['file_name'] = 'sampul_buku_' . $data['judul_buku'];
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('sampul')) {
                $data['sampul'] = $this->upload->data('file_name');
            } else {
                return false;
            }
        }
        $this->db->insert('buku', $data);
        return true;
    }

    public function updateDataBuku()
    {
        $register_lama = $this->input->post('register_lama');
        $data =  [
            'register' => $this->input->post('register'),
            'judul_buku' => $this->input->post('judul_buku'),
            'pengarang' => $this->input->post('pengarang'),
            'penerbit' => $this->input->post('penerbit'),
            'tahun_terbit' => $this->input->post('tahun_terbit'),
            'kondisi_fisik' => $this->input->post('kondisi_fisik'),
            'status_buku' => $this->input->post('status_buku'),
            'jenis_akses' => $this->input->post('jenis_akses'),
            'kota_terbit' => $this->input->post('kota_terbit'),
            'isbn' => $this->input->post('isbn'),
            'no_dewey' => $this->input->post('no_dewey'),
            'author_abrev' => $this->input->post('author_abrev'),
            'title_abrev' => $this->input->post('title_abrev'),
            // 'sampul' => $this->input->post('sampul'),
            'volume' => $this->input->post('volume'),
            'bibliography' => $this->input->post('bibliography'),
            'subject' => $this->input->post('subject'),
            'b_id_bahasa' => $this->input->post('b_id_bahasa'),
            'ct_id_circ_type' => $this->input->post('ct_id_circ_type'),
            'f_id_funding' => $this->input->post('f_id_funding'),
            'sk_id_sumber' => $this->input->post('sk_id_sumber'),
            'k_id_kategori' => $this->input->post('k_id_kategori'),
        ];

        $ubah = $_POST['ubah-pict'];
        if ($ubah == "ya") {
            // upload sampul
            $path = './assets/sampul_buku/';
            unlink($path . $_POST['sampul']);

            $upload_image = $_FILES['pict'];
            if ($upload_image) {
                $config['allowed_types'] = 'jpg|JPG|jpeg|JPEG|png|PNG';
                $config['max_size']     = '1024'; //kb
                $config['upload_path'] = './assets/sampul_buku/';
                $config['file_name'] = 'sampul_buku_' . $data['judul_buku'];
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('pict')) {
                    $data['sampul'] = $this->upload->data('file_name');
                } else {
                    return false;
                }
            }
        } else {
            $data['sampul'] = $_POST['pict'];
        }

        $this->db->update('buku', $data, ['register' => $register_lama]);
        return true;
    }

    public function deleteDataBuku($register)
    {
        $this->db->delete('buku', ['register' => $register]);
        return true;
    }


    public function updateData()
    {
        $id_denda = $this->input->post('id_denda');
        $data =  [
            'nama_denda' => $this->input->post('nama_denda'),
        ];

        $this->db->update('denda', $data, ['id_denda' => $id_denda]);
        return true;
    }

    public function deleteData($id_denda)
    {
        $this->db->delete('denda', ['id_denda' => $id_denda]);
        return true;
    }

    public function getOpac($keywords, $filter)
    {
        $this->db->select('*');
        $this->db->from('buku');
        if ($filter != null) {
            $this->db->like($filter, $keywords);
        }
        // $this->db->limit(1000);
        return $this->db->get()->result();
    }

    public function dataJenisBuku()
    {
        $this->db->select('COUNT(register) as jumlah, nama_jenis, id_jenis');
        $this->db->from('buku');
        $this->db->join('jenis_koleksi', 'jenis_koleksi.id_jenis=buku.jk_id_jenis', 'left');
        $this->db->group_by('id_jenis');
        $data = $this->db->get()->result_array();
        $result = [];
        $jenis_koleksi = $this->db->get('jenis_koleksi')->result_array();

        foreach ($jenis_koleksi as $jk) {
            $result[$jk['id_jenis']]  = [
                'id_jenis' => $jk['id_jenis'],
                'nama_jenis' => $jk['nama_jenis'],
                'jumlah' => 0,
            ];
        }
        foreach ($data as $d) {
            $result[$d['id_jenis']] = [
                'id_jenis' => $d['id_jenis'],
                'nama_jenis' => $d['nama_jenis'],
                'jumlah' => $d['jumlah']
            ];
        }

        return $result;
    }

    public function dataHotBuku($jenis_sirkulasi)
    {
        $this->db->select('COUNT(b_register) as jumlah,judul_buku,register');
        $this->db->from('sirkulasi');
        $this->db->join('buku', 'buku.register=sirkulasi.b_register', 'left');
        $this->db->where('jenis_sirkulasi', $jenis_sirkulasi);
        $this->db->group_by('b_register');
        $this->db->order_by('jumlah', 'desc');
        return $this->db->get()->result_array();
    }

    public function bukuToday()
    {
        $this->db->select('u.nama,u.username,s.id_sirkulasi,b.register,b.judul_buku,s.status_sirkulasi,b.penerbit,b.pengarang');
        $this->db->from('sirkulasi as s');
        $this->db->join('buku as b', 's.b_register=b.register', 'left');
        $this->db->join('user as u', 'u.username=s.u_username', 'left');
        $this->db->where_in('s.status_sirkulasi', [2, 3]); //  status sedang dipersiapkan dan dapat diambil
        $this->db->where('s.tanggal_mulai', date('Y-m-d'));
        return $this->db->get()->result_array();
    }
}
