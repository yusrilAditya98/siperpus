<?php
defined('BASEPATH') or exit('No direct script access allowed');


class m_kop_surat extends CI_Model
{
    public function getData($id = null, $status = null)
    {
        $this->db->select('*');
        $this->db->from('kop_surat');
        if ($id != null) {
            $this->db->where('id', $id);
        }
        if ($status != null) {
            $this->db->where('status', $status);
        }
        return $this->db->get()->result_array();
    }

    public function insertData()
    {
        $data =  [
            'nama_kop' => $this->input->post('nama_kop'),
            'status' => $this->input->post('status'),
        ];
        // cek jika ada gambar yang di upload
        $upload_image = $_FILES['nama_file'];
        if ($upload_image['error'] != 4) {
            $config['allowed_types'] = 'jpg|JPG|jpeg|JPEG|png|PNG';
            // $config['max_size']     = '1024'; //kb
            $config['upload_path'] = './assets/img/kopSurat/';
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('nama_file')) {
                $data['nama_file'] = $this->upload->data('file_name');
            } else {
                return false;
            }
        }
        $this->db->insert('kop_surat', $data);
        return true;
    }
    public function updateData($id)
    {
        $data =  [
            'nama_kop' => $this->input->post('nama_kop'),
            'status' => $this->input->post('status'),
        ];
        // cek jika ada gambar yang di upload
        $upload_image = $_FILES['nama_file'];
        if ($upload_image['error'] != 4) {
            $config['allowed_types'] = 'jpg|JPG|jpeg|JPEG|png|PNG';
            // $config['max_size']     = '1024'; //kb
            $config['upload_path'] = './assets/img/kopSurat/';
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('nama_file')) {
                $old_image = $this->input->post('old_nama_file');
                unlink(FCPATH . 'assets/img/kopSurat/' . $old_image);
                $data['nama_file'] = $this->upload->data('file_name');
            } else {
                return false;
            }
        }

        $this->db->update('kop_surat', $data, ['id' => $id]);
        return true;
    }

    public function deleteData($id)
    {
        $this->db->delete('kop_surat', ['id' => $id]);
        return true;
    }
}
