<?php

function is_logged_in()
{
    $ci = get_instance();
    if (!$ci->session->userdata('role_id')) {
        redirect('auth');
    } else {
    }
}

function link_dashboard($role_id)
{
    if ($role_id == "role_id_1") {
        redirect('user/admin');
    } elseif ($role_id == "role_id_2") {
        redirect('user/anggota');
    } else {
        redirect('user/non_anggota');
    }
}

function cek_admin()
{
    $data =  [
        '' => ['role_id_1'],
        'list' => ['role_id_1'],
        'tambah' => ['role_id_1'],
        'hapus' => ['role_id_1'],
        'ubah' => ['role_id_1'],
        'ubahPassword' => ['role_id_1'],
        'import' => ['role_id_1'],
        'export' => ['role_id_1']
    ];
    cek_akses($data, 3);
}

function cek_anggota()
{
    $data =  [
        '' => ['role_id_1', 'role_id_2'],
        'list' => ['role_id_1', 'role_id_2'],
        'tambah' => ['role_id_1', 'role_id_2'],
        'hapus' => ['role_id_1', 'role_id_2'],
        'ubah' => ['role_id_1', 'role_id_2'],
        'ubahPassword' => ['role_id_1', 'role_id_2'],
        'import' => ['role_id_1', 'role_id_2'],
        'export' => ['role_id_1', 'role_id_2'],
        'get_status_mahasiswa' => ['role_id_1', 'role_id_2'],
        'bebas_pustaka' => ['role_id_1', 'role_id_2']
    ];
    cek_akses($data, 3);
}

function cek_akses($data, $segment)
{
    $ci = get_instance();
    $previlage = $ci->session->userdata('role_id');

    $method = $ci->uri->segment($segment);

    $akses = false;

    foreach ($data as $key => $value) {
        if ($key == $method) {
            foreach ($value as $v) {
                if ($v == $previlage) {
                    $akses = true;
                    break;
                }
            }
        }
    }

    if (!$akses) {
        redirect('auth/blocked');
    }
}
