<?php
defined('BASEPATH') or exit('No direct script access allowed');


class M_sirkulasi extends CI_Model
{
    public function cekBacaDitempat($registrasi)
    {
        $cek = $this->db->get_where('buku', ['register' => $registrasi, 'status_buku' => 1])->data_seek();
        if ($cek) {
            $buku = $this->db->get_where('sirkulasi', ['b_register' => $registrasi, 'jenis_sirkulasi' => 2])->result_array();
            if ($buku) {
                foreach ($buku as $b) {
                    if ($b['status_sirkulasi'] == 0 || $b['status_sirkulasi'] == 1 || $b['status_sirkulasi'] == 2) {
                        return false;
                    }
                }
            } else {
                return true;
            }
        }
    }

    public function insertBacaDitempat($registrasi)
    {
        $data = [
            'u_username' => $this->session->userdata('username'),
            'b_register' => $registrasi,
            'jenis_sirkulasi' => 2,
            'tanggal_sirkulasi' => date('Y-m-d'),
            'status_sirkulasi' => 0,
        ];
        $this->db->insert('sirkulasi', $data);
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

    public function updateBacaDiTempat($username)
    {

        $buku = $this->db->get_where('sirkulasi', ['u_username' => $username, 'jenis_sirkulasi' => 2, 'status_sirkulasi' => 0])->result_array();

        $index = 0;
        foreach ($buku as $b) {
            $data[$index] = [
                'id_sirkulasi' => $b['id_sirkulasi'],
                'status_sirkulasi' => 1,
                'tanggal_mulai' => $this->input->post('tanggal_mulai')
            ];
            $index++;
        }
        $this->db->update_batch('sirkulasi', $data, 'id_sirkulasi');
    }
}
