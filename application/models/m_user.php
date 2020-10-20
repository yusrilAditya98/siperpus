<?php
defined('BASEPATH') or exit('No direct script access allowed');


class M_user extends CI_Model
{
    public function getUser($username = null, $role_id = null)
    {
        $this->db->select('*');
        $this->db->from('user');
        if ($username != null) {
            $this->db->where('user.username', $username);
            return $this->db->get()->row_array();
        }
        if ($role_id != null) {
            $this->db->where('user.ru_role_id', $role_id);
        }
        return $this->db->get()->result_array();
    }

    public function insertUser($role_id)
    {

        $data =  [
            'username' => $this->input->post('username'),
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'no_hp' => $this->input->post('no_hp'),
            'password' =>  password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
            'status_aktif' => $this->input->post('status_aktif'),
            'date_created' => date("Y-m-d"),
            'p_id_prodi' => $this->input->post('prodi'),
            'ru_role_id' => $role_id
        ];

        // cek jika ada gambar yang di upload
        $upload_image = $_FILES['foto'];
        if ($upload_image['error'] != 4) {
            $config['allowed_types'] = 'jpg';
            $config['max_size']     = '1024'; //kb
            $config['upload_path'] = './assets/foto_profil/';
            $config['file_name'] = 'foto_profil_' . $data['username'];
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('foto')) {
                $data['foto'] = $this->upload->data('file_name');
            } else {
                return false;
            }
        }
        $this->db->insert('user', $data);
        return true;
    }
    public function updateUser()
    {
        $old_username = $this->input->post('old_username');
        $data =  [
            'username' => $this->input->post('username'),
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'no_hp' => $this->input->post('no_hp'),
            'status_aktif' => $this->input->post('status_aktif'),
            'p_id_prodi' => $this->input->post('prodi'),
        ];


        // cek jika ada gambar yang di upload
        $upload_image = $_FILES['foto'];
        if ($upload_image['error'] != 4) {
            $config['allowed_types'] = 'jpg';
            $config['max_size']     = '1024'; //kb
            $config['upload_path'] = './assets/foto_profil/';
            $config['file_name'] = 'foto_profil_' . $data['username'];
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('foto')) {
                $old_image = $this->input->post('old_foto');
                if ($old_image != 'default.png') {
                    unlink(FCPATH . 'assets/foto_profil/' . $old_image);
                }
                $data['foto'] = $this->upload->data('file_name');
            } else {
                return false;
            }
        }
        $this->db->update('user', $data, ['username' => $old_username]);
        return true;
    }

    public function updatePassword()
    {
        $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
        $username = $this->input->post('username');
        $this->db->set('password', $password);
        $this->db->where('username', $username);
        $this->db->update('user');
    }
}
