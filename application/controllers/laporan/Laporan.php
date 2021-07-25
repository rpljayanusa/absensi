<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laporan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_user();
    }
    public function index()
    {
        $data = [
            'title' => 'Laporan',
            'links' => '<li class="active">Laporan</li>'
        ];
        $this->template->display('laporan/index', $data);
    }
}

/* End of file Laporan.php */
