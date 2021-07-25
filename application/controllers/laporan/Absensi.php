<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absensi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_user();
    }
    public function perbulan()
    {
        $bulan = $this->input->post('bulan', true);
        $tahun = $this->input->post('tahun', true);
        $data = [
            'title' => 'Laporan Absensi Karyawan',
            'bulan' => $bulan,
            'tahun' => $tahun,
            'data' => $this->queryperbulan($bulan, $tahun)
        ];
        $this->load->view('laporan/absensi', $data);
    }
    public function queryperbulan($bulan, $tahun)
    {
        $bln = strlen($bulan) == 1 ? '0' . $bulan : $bulan;
        $perbulan = $tahun . '-' . $bln;
        // $query = $this->db->query("SELECT * FROM jadwal JOIN jadwal_detail ON id_jadwal=idjadwal_detail JOIN karyawan ON karyawan_detail=id_karyawan
        // WHERE bulan_jadwal='$perbulan' ORDER BY tanggal_detail ASC");
        $query = $this->db->query("SELECT * FROM absen JOIN karyawan ON karyawan_absen=id_karyawan WHERE DATE_FORMAT(tanggal_absen,'%Y-%m')='$perbulan' GROUP BY karyawan_absen,tanggal_absen ORDER BY tanggal_absen ASC");
        return $query->result_array();
    }
}

/* End of file Absensi.php */
