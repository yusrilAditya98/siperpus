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
