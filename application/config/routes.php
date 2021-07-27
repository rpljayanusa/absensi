<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['logout'] = 'login/logout';

$route['unit'] = 'master/unit';
$route['unit/data'] = 'master/unit/data';
$route['unit/create'] = 'master/unit/create';
$route['unit/store'] = 'master/unit/store';
$route['unit/edit'] = 'master/unit/edit';
$route['unit/update'] = 'master/unit/update';
$route['unit/destroy'] = 'master/unit/destroy';

$route['jenis'] = 'master/jenis';
$route['jenis/data'] = 'master/jenis/data';
$route['jenis/create'] = 'master/jenis/create';
$route['jenis/store'] = 'master/jenis/store';
$route['jenis/edit'] = 'master/jenis/edit';
$route['jenis/update'] = 'master/jenis/update';
$route['jenis/destroy'] = 'master/jenis/destroy';

$route['jabatan'] = 'master/jabatan';
$route['jabatan/data'] = 'master/jabatan/data';
$route['jabatan/create'] = 'master/jabatan/create';
$route['jabatan/store'] = 'master/jabatan/store';
$route['jabatan/edit'] = 'master/jabatan/edit';
$route['jabatan/update'] = 'master/jabatan/update';
$route['jabatan/destroy'] = 'master/jabatan/destroy';

$route['karyawan'] = 'master/karyawan';
$route['karyawan/data'] = 'master/karyawan/data';
$route['karyawan/create'] = 'master/karyawan/create';
$route['karyawan/store'] = 'master/karyawan/store';
$route['karyawan/edit'] = 'master/karyawan/edit';
$route['karyawan/update'] = 'master/karyawan/update';
$route['karyawan/destroy'] = 'master/karyawan/destroy';

$route['jadwal'] = 'transaksi/jadwal';
$route['jadwal/create'] = 'transaksi/jadwal/create';
$route['jadwal/create-karyawan'] = 'transaksi/jadwal/create_karyawan';
$route['jadwal/store'] = 'transaksi/jadwal/store';
$route['jadwal/edit/(:any)'] = 'transaksi/jadwal/edit/$1';
$route['jadwal/update'] = 'transaksi/jadwal/update';
$route['jadwal/detail/(:any)'] = 'transaksi/jadwal/detail/$1';
$route['jadwal/notife'] = 'transaksi/jadwal/notife';
$route['jadwal/save'] = 'transaksi/jadwal/save';
$route['jadwal/validasi'] = 'transaksi/jadwal/validasi';
$route['jadwal/view'] = 'transaksi/jadwal/view';
$route['jadwal/cetak/(:any)/(:any)'] = 'transaksi/jadwal/cetak/$1/$2';

$route['absensi'] = 'transaksi/absensi';
$route['absensi/data'] = 'transaksi/absensi/data';
$route['absensi/upload'] = 'transaksi/absensi/upload';
$route['absensi/store'] = 'transaksi/absensi/store';
$route['absensi/detail'] = 'transaksi/absensi/detail';

$route['cuti'] = 'transaksi/cuti';
$route['cuti/data'] = 'transaksi/cuti/data';
$route['cuti/create'] = 'transaksi/cuti/create';
$route['cuti/store'] = 'transaksi/cuti/store';
$route['cuti/edit'] = 'transaksi/cuti/edit';
$route['cuti/update'] = 'transaksi/cuti/update';
$route['cuti/destroy'] = 'transaksi/cuti/destroy';
$route['cuti/detail'] = 'transaksi/cuti/detail';
$route['cuti/validasi'] = 'transaksi/cuti/validasi';
$route['cuti/jeniscuti'] = 'transaksi/cuti/jeniscuti';

$route['laporan'] = 'laporan/laporan';
