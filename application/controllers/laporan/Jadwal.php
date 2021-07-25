<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_user();
        $this->load->model('master/Mkaryawan');
    }
    public function perbulan()
    {
        // $weeks = monthToWeeks(2021, '07');
        // echo json_encode($weeks);
        // $date = createDateRangeArray('2021-07-01', '2021-07-07');
        // echo json_encode($date);
        // exit;
        $bulan = $this->input->post('bulan', true);
        $tahun = $this->input->post('tahun', true);
        $data = [
            'title' => 'Penjadwalan Karyawan',
            'bulan' => $bulan,
            'tahun' => $tahun,
            'data' => $this->Mkaryawan->fetch_all()
        ];
        $this->load->view('laporan/jadwal', $data);
    }
    public function queryperbulan($bulan, $tahun)
    {
        $query = $this->db->query("SELECT * FROM karyawan JOIN cuti ON id_karyawan=karyawan_cuti
        WHERE DATE_FORMAT(tgl_pengajuan,'%c')='$bulan' AND DATE_FORMAT(tgl_pengajuan,'%Y')='$tahun' ORDER BY tgl_pengajuan DESC");
        return $query->result_array();
    }
}

/* End of file Jadwal.php */
