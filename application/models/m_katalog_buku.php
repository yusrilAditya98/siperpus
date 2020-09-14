<?php
defined('BASEPATH') or exit('No direct script access allowed');


class m_katalog_buku extends CI_Model
{
    public function getData($register = null)
    {
        // $data = $this->db->query('select * from buku ' . $where);
        $this->db->select('*');
        $this->db->from('buku');
        if ($register != null) {
            $this->db->where('register', $register);
        }
        $this->db->limit(1000);
        return $this->db->get()->result_array();
        // return $data->result_array();
    }

    public function buku_list()
    {
        $this->db->select('*');
        $this->db->from('buku');
        $this->db->order_by('register', 'DESC');
        $this->db->limit(10);
        return $this->db->get()->result();
    }

    public function bahasa_list()
    {
        $this->db->select('*');
        $this->db->from('bahasa');
        return $this->db->get()->result();
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
}
