<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Unit extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_user();
        $this->load->model('master/Munit');
    }
    public function index()
    {
        $data = [
            'title' => 'Daftar Unit Kerja',
            'data' => $this->Munit->fetch_all()
        ];
        $this->load->view('laporan/unit', $data);
    }
}

/* End of file Unit.php */
