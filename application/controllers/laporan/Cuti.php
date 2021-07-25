<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cuti extends CI_Controller
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
            'title' => 'Laporan Cuti Karyawan',
            'bulan' => $bulan,
            'tahun' => $tahun,
            'data' => $this->queryperbulan($bulan, $tahun)
        ];
        $this->load->view('laporan/cuti', $data);
    }
    public function queryperbulan($bulan, $tahun)
    {
        $query = $this->db->query("SELECT * FROM karyawan JOIN cuti ON id_karyawan=karyawan_cuti JOIN jenis_cuti ON jenis_cuti=id_jenis
        WHERE DATE_FORMAT(tgl_pengajuan,'%c')='$bulan' AND DATE_FORMAT(tgl_pengajuan,'%Y')='$tahun' ORDER BY tgl_pengajuan DESC");
        return $query->result_array();
    }
}

/* End of file Cuti.php */
