<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_user();
        $this->load->model('master/Mkaryawan');
        $this->load->model('transaksi/Mjadwal');
    }
    public function index()
    {
        $data = [
            'title' => 'Jadwal',
            'links' => '<li class="active">Jadwal</li>',
            'data' => $this->Mjadwal->fetch_all()
        ];
        $this->template->display('transaksi/jadwal/index', $data);
    }
    public function create()
    {
        $data = [
            'title' => 'Jadwal',
            'links' => '<li>Jadwal</li><li class="active">Tambah</li>'
        ];
        $this->template->display('transaksi/jadwal/create', $data);
    }
    public function create_karyawan()
    {
        $data['tahun'] = date('Y');
        $data['bulan'] = $this->input->get('bulan', true);
        $data['data'] = $this->Mkaryawan->fetch_all();
        $this->load->view('transaksi/jadwal/tmp_create', $data);
    }
    public function store()
    {
        $post = $this->input->post(null, TRUE);
        $check = $this->db->from('jadwal')->where('bulan_jadwal', $post['bulan'])->count_all_results();
        if ($check > 0) {
            $json = array(
                'status' => '0101',
                'pesan' => 'Jadwal sudah diinputkan'
            );
        } else {
            $this->Mjadwal->store($post);
            $json = array(
                'status' => '0100',
                'pesan' => 'Data jadwal telah disimpan'
            );
        }
        echo json_encode($json);
    }
    public function edit($kode)
    {
        $data = [
            'title' => 'Jadwal',
            'links' => '<li>Jadwal</li><li class="active">Tambah</li>',
            'data' => $this->Mjadwal->show($kode),
            'karyawan' => $this->Mkaryawan->fetch_all()
        ];
        $this->template->display('transaksi/jadwal/edit', $data);
    }
    public function update()
    {
        $post = $this->input->post(null, TRUE);
        $this->Mjadwal->update($post);
        $json = array(
            'status' => '0100',
            'pesan' => 'Data jadwal telah dirubah'
        );
        echo json_encode($json);
    }
    public function detail($kode)
    {
        $data = [
            'title' => 'Jadwal',
            'links' => '<li>Jadwal</li><li class="active">Detail</li>',
            'data' => $this->Mjadwal->show($kode),
            'karyawan' => $this->Mkaryawan->fetch_all()
        ];
        $this->template->display('transaksi/jadwal/detail', $data);
    }
    public function notife()
    {
        $kode = $this->input->get('kode');
        $data = [
            'name' => 'Tambah Catatan',
            'post' => 'jadwal/save',
            'class' => 'form_create',
            'data' => $this->Mjadwal->show($kode)
        ];
        $this->template->modal_form('transaksi/jadwal/notife', $data);
    }
    public function save()
    {
        $post = $this->input->post(null, TRUE);
        $data = array(
            'note_jadwal' => $post['note']
        );
        $data = $this->db->where('id_jadwal', $post['kode'])->update('jadwal', $data);
        echo json_encode($data);
    }
    public function validasi()
    {
        $kode = $this->input->get('kode', true);
        $status = $this->input->get('status', true);
        $action = $this->Mjadwal->validasi($kode, $status);
        if ($action) {
            $json = array(
                'status' => '0100',
                'pesan' => $status == 0 ? 'Jadwal telah disetujui' : 'Jadwal batal disetujui'
            );
        } else {
            $json = array(
                'status' => '0101',
                'pesan' => 'Jadwal gagal disetujui'
            );
        }
        echo json_encode($json);
    }
    public function view()
    {
        $kode = $this->input->get('kode');
        $data = $this->Mjadwal->show($kode);
        $pecah = explode("-", $data['bulan_jadwal']);
        $bulan = bulan($pecah[1]);
        $tahun = $pecah[0];
        $data = [
            'name' => 'Jadwal Bulan ' . $bulan . ' ' . $tahun,
            'modallg' => 1,
            'data' => $data,
            'karyawan' => $this->db->where('id_karyawan', id_user())->get('karyawan')->result_array()
        ];
        $this->template->modal_info('transaksi/jadwal/view', $data);
    }
    public function cetak($bulan, $tahun)
    {
        $data = [
            'title' => 'Penjadwalan Karyawan',
            'bulan' => $bulan,
            'tahun' => $tahun,
            'data' => $this->Mkaryawan->fetch_all()
        ];
        $this->load->view('laporan/jadwal', $data);
    }
}

/* End of file Jadwal.php */
