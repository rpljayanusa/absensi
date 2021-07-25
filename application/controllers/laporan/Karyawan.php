<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_user();
        $this->load->model('master/Mkaryawan');
    }
    public function index()
    {
        $data = [
            'title' => 'Laporan Data Karyawan',
            'data' => $this->Mkaryawan->fetch_all()
        ];
        $this->load->view('laporan/karyawan', $data);
    }
}

/* End of file Karyawan.php */
