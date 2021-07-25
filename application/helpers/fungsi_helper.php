<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('status_span')) {
    function status_span($code, $jenis)
    {
        if ($jenis == 'cuti') :
            if ($code == 0) :
                $pesan = 'Belum Disetujui';
                $class = 'status-pending';
            elseif ($code == 1) :
                $pesan = 'Tidak Disetujui Admin';
                $class = 'status-suspended';
            elseif ($code == 2) :
                $pesan = 'Disetujui Admin';
                $class = 'status-accepted';
            elseif ($code == 3) :
                $pesan = 'Tidak Disetujui Pimpinan';
                $class = 'status-suspended';
            else :
                $pesan = 'Disetujui Pimpinan';
                $class = 'status-accepted';
            endif;
        endif;
        $span = '<span class="label status status-label ' . $class . '">' . $pesan . '</span>';
        return $span;
    }
}

if (!function_exists('jenis_cuti')) {
    function jenis_cuti($kode)
    {
        $jenis = [
            1 => 'Cuti Tahunan',
            2 => 'Cuti Melahirkan',
            3 => 'Lainnya'
        ];
        foreach ($jenis as $key => $value) {
            if ($key == $kode)
                return $value;
        }
    }
}
