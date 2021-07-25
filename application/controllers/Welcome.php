<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		cek_user();
		$this->load->model('Mhome');
	}
	public function index()
	{
		$data = [
			'title' => 'Dashboard',
			'links' => '<li class="active">Dashboard</li>',
			'jadwal' => $this->Mhome->jadwal_hari_ini(),
			'tahunan' => $this->Mhome->cuti_tahunan(),
			'lahir' => $this->Mhome->cuti_lahir(),
			'other' => $this->Mhome->cuti_other()
		];
		$this->template->display('layout/content', $data);
	}
}
