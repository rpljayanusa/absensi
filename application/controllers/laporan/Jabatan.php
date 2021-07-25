<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jabatan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_user();
        $this->load->model('master/Mjabatan');
    }
    public function index()
    {
        $data = [
            'title' => 'Daftar Jabatan',
            'data' => $this->Mjabatan->fetch_all()
        ];
        $this->load->view('laporan/jabatan', $data);
    }
}

/* End of file Jabatan.php */
