<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('cek_user')) {
    function cek_user()
    {
        $CI = &get_instance();
        if ($CI->session->userdata('status_login') != 'session_log') {
            redirect('logout');
        }
    }
}
if (!function_exists('id_user')) {
    function id_user()
    {
        $CI = &get_instance();
        return $CI->session->userdata('kode');
    }
}
if (!function_exists('level_user')) {
    function level_user()
    {
        $CI = &get_instance();
        $row = $CI->db->where('id_karyawan', id_user())->get('karyawan')->row_array();
        return $row['level_karyawan'];
    }
}
if (!function_exists('profil_user')) {
    function profil_user()
    {
        $CI = &get_instance();
        $row = $CI->db->where('id_karyawan', id_user())->get('karyawan')->row_array();
        return $row['nama_karyawan'];
    }
}
