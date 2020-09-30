<?php
defined('BASEPATH') or exit('No direct script access allowed');


class m_koleksi_digital extends CI_Model
{

    public function getKoleksi($id_koleksi = null)
    {
        $this->db->select('*');
        $this->db->from('koleksi_digital as kd');
        $this->db->join('jenis_koleksi as jk', 'kd.jk_id_jenis=jk.id_jenis', 'left');
        if ($id_koleksi) {
            $this->db->where('kd.id_koleksi', $id_koleksi);
            return $this->db->get()->row_array();
        }
        return $this->db->get()->result_array();
    }

    public function insertKoleksi()
    {
        $id_koleksi = 'D';
        $jum_koleksi = count($this->db->get('koleksi_digital')->result_array()) + 1;
        $cek = true;
        while ($cek) {
            if ($jum_koleksi > 0 && $jum_koleksi < 10) {
                $id_koleksi .= '00000' . $jum_koleksi;
            } elseif ($jum_koleksi >= 10 && $jum_koleksi < 100) {
                $id_koleksi .= '0000' . $jum_koleksi;
            } elseif ($jum_koleksi >= 100 && $jum_koleksi < 1000) {
                $id_koleksi .= '000' . $jum_koleksi;
            } elseif ($jum_koleksi >= 1000 && $jum_koleksi < 10000) {
                $id_koleksi .= '00' . $jum_koleksi;
            } elseif ($jum_koleksi >= 10000 && $jum_koleksi < 100000) {
                $id_koleksi .= '0' . $jum_koleksi;
            } elseif ($jum_koleksi >= 100000 && $jum_koleksi < 1000000) {
                $id_koleksi .= '' . $jum_koleksi;
            } else {
                return false;
            }
            $date = date('d') . date('m') . date('Y');
            $id_koleksi .= $date;
            $cek = $this->db->get_where('koleksi_digital', ['id_koleksi' => $id_koleksi])->data_seek();
            if (!$cek) {
                $jum_koleksi++;
            }
        }

        $data = [
            'id_koleksi' => $id_koleksi,
            'judul_koleksi' => $this->input->post('judul_koleksi'),
            'pengarang' => $this->input->post('pengarang'),
            'penerbit' => $this->input->post('penerbit'),
            'jk_id_jenis' => $this->input->post('jk_id_jenis')
        ];

        // cek jika ada gambar yang di upload
        $upload_image = $_FILES['sampul_koleksi'];

        if ($upload_image['error'] != 4) {
            $config['allowed_types'] = 'jpg';
            $config['max_size']     = '1024'; //kb
            $config['upload_path'] = './assets/koleksi_digital/';
            $config['file_name'] = 'sampul_koleksi_' . $id_koleksi;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('sampul_koleksi')) {
                $data['sampul_koleksi'] = $this->upload->data('file_name');
            } else {
                return false;
            }
        } else {
            $data['sampul_koleksi'] = 'default.png';
        }
        $this->db->insert('koleksi_digital', $data);
        return true;
    }

    public function updateKoleksi($id_koleksi)
    {
        $old_image = $this->input->post('old_sampul_koleksi');

        $data = [
            'judul_koleksi' => $this->input->post('judul_koleksi'),
            'pengarang' => $this->input->post('pengarang'),
            'penerbit' => $this->input->post('penerbit'),
            'jk_id_jenis' => $this->input->post('jk_id_jenis')
        ];

        // cek jika ada gambar yang di upload
        $upload_image = $_FILES['sampul_koleksi'];
        if ($upload_image['error'] != 4) {
            $config['allowed_types'] = 'jpg';
            $config['max_size']     = '1024'; //kb
            $config['upload_path'] = './assets/koleksi_digital/';
            $config['file_name'] = 'sampul_koleksi_' . $id_koleksi;
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('sampul_koleksi')) {
                $old_image = $this->input->post('old_sampul_koleksi');
                if ($old_image != 'default.png') {
                    unlink(FCPATH . 'assets/koleksi_digital/' . $old_image);
                }
                $data['sampul_koleksi'] = $this->upload->data('file_name');
            } else {
                return false;
            }
        }
        $this->db->update('koleksi_digital', $data, ['id_koleksi' => $id_koleksi]);
        return true;
    }

    public function deleteKoleksi($id_koleksi)
    {
        $data = $this->getKoleksi($id_koleksi);
        if ($data['sampul_koleksi'] != 'default.png') {
            unlink(FCPATH . 'assets/koleksi_digital/' . $data['sampul_koleksi']);
        }
        $this->db->delete('koleksi_digital', ['id_koleksi' => $id_koleksi]);
        return true;
    }
}
