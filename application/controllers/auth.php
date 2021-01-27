<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Auth extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index()
    {

        if ($this->session->userdata('role_id')) {
            link_dashboard($this->session->userdata('role_id'));
        }
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Login';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login');
            $this->load->view('templates/auth_footer');
        } else {
            // validasi success
            $this->_login();
        }
    }

    private function _login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['username' => $username])->row_array();
        // usernya ada
        if ($user) {
            // jika usernya aktif
            if ($user['status_aktif'] == 1) {
                // cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'username' => $user['username'],
                        'nama' => $user['nama'],
                        'role_id' => 'role_id_' . $user['ru_role_id']
                    ];
                    $this->session->set_userdata($data);
                    $log = [
                        'username' => $user['username'],
                        'tanggal' => date('Y-m-d')
                    ];
                    $this->db->insert('log_pengunjung', $log);
                    if ($user['ru_role_id'] == 1) {
                        redirect('user/admin');
                    } elseif ($user['ru_role_id'] == 2) {
                        redirect('user/anggota');
                    } else {
                        redirect('user/non_anggota');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Wrong Password !</div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">This username has not been activated !</div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">username is not registerd !</div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">You have been logged out!</div>');
        redirect('auth');
    }
    public function blocked()
    {
        $this->load->view('auth/blocked');
    }
}
