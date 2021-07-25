<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Karyawan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_user();
        $this->load->model('master/Mkaryawan');
        $this->load->model('master/Mjabatan');
        $this->load->model('master/Munit');
    }
    public function index()
    {
        $data = [
            'title' => 'Karyawan',
            'links' => '<li class="active">Karyawan</li>'
        ];
        $this->template->display('master/karyawan/index', $data);
    }
    public function data()
    {
        $action = $this->input->post('action');
        if (isset($action)) {
            if ($action == 'fetch_data') {
                $query = $this->Mkaryawan->fetch_all();
                if ($query == null) {
                    $data = (int)0;
                } else {
                    foreach ($query as $row) {
                        $data[] = [
                            'id' => $row['id_karyawan'],
                            'idabsen' => $row['idabsen_karyawan'],
                            'nama' => $row['nama_karyawan'],
                            'tempat_lahir' => $row['tempat_lahir'],
                            'tanggal_lahir' => format_biasa($row['tanggal_lahir']),
                            'jenkel' => $row['jenkel_karyawan'] == 1 ? 'Laki-laki' : 'Perempuan',
                            'agama' => $row['agama_karyawan'],
                            'status_nikah' => $row['status_nikah'],
                            'phone' => $row['phone_karyawan'],
                            'jabatan' => $row['nama_jabatan'],
                            'unit' => $row['nama_unit'],
                            'masuk' => format_biasa($row['tanggal_masuk']),
                            'status' => $row['status_karyawan'] == 0 ? 'Tidak Aktif' : ($row['status_karyawan'] == 1 ? 'Permanen' : 'Kontrak')
                        ];
                    }
                }
                echo json_encode($data);
            }
        }
    }
    public function create()
    {
        $data = [
            'name' => 'Tambah Karyawan',
            'post' => 'karyawan/store',
            'class' => 'form_create',
            'jabatan' => $this->Mjabatan->fetch_all(),
            'unit' => $this->Munit->fetch_all()
        ];
        $this->template->modal_form('master/karyawan/create', $data);
    }
    public function store()
    {
        $this->form_validation->set_rules('idabsen', 'ID Absen', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat lahir', 'required');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal lahir', 'required');
        $this->form_validation->set_rules('jenkel', 'Jenis kelamin', 'required');
        $this->form_validation->set_rules('agama', 'Agama', 'required');
        $this->form_validation->set_rules('status_nikah', 'Status pernikahan', 'required');
        $this->form_validation->set_rules('phone', 'No. HP', 'required');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
        $this->form_validation->set_rules('unit', 'Unit kerja', 'required');
        $this->form_validation->set_rules('masuk', 'Tanggal masuk', 'required');
        $this->form_validation->set_rules('status', 'Status karyawan', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('level', 'Level', 'required');
        $this->form_validation->set_message('required', errorRequired());
        $this->form_validation->set_error_delimiters(errorDelimiter(), errorDelimiter_close());
        if ($this->form_validation->run() == TRUE) {
            $post = $this->input->post(null, TRUE);
            $this->Mkaryawan->store($post);
            $json = array(
                'status' => '0100',
                'pesan' => 'Data karyawan telah disimpan'
            );
        } else {
            $json = array(
                'status' => '0101'
            );
            foreach ($_POST as $key => $value) {
                $json['pesan'][$key] = form_error($key);
            }
        }
        echo json_encode($json);
    }
    public function edit()
    {
        $kode = $this->input->get('kode');
        $data = [
            'name' => 'Edit Karyawan',
            'post' => 'karyawan/update',
            'class' => 'form_create',
            'data' => $this->Mkaryawan->show($kode),
            'jabatan' => $this->Mjabatan->fetch_all(),
            'unit' => $this->Munit->fetch_all()
        ];
        $this->template->modal_form('master/karyawan/edit', $data);
    }
    public function update()
    {
        $this->form_validation->set_rules('idabsen', 'ID Absen', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat lahir', 'required');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal lahir', 'required');
        $this->form_validation->set_rules('jenkel', 'Jenis kelamin', 'required');
        $this->form_validation->set_rules('agama', 'Agama', 'required');
        $this->form_validation->set_rules('status_nikah', 'Status pernikahan', 'required');
        $this->form_validation->set_rules('phone', 'No. HP', 'required');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
        $this->form_validation->set_rules('unit', 'Unit kerja', 'required');
        $this->form_validation->set_rules('masuk', 'Tanggal masuk', 'required');
        $this->form_validation->set_rules('status', 'Status karyawan', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('level', 'Level', 'required');
        $this->form_validation->set_message('required', errorRequired());
        $this->form_validation->set_error_delimiters(errorDelimiter(), errorDelimiter_close());
        if ($this->form_validation->run() == TRUE) {
            $post = $this->input->post(null, TRUE);
            $this->Mkaryawan->update($post);
            $json = array(
                'status' => '0100',
                'pesan' => 'Data karyawan telah dirubah'
            );
        } else {
            $json = array(
                'status' => '0101'
            );
            foreach ($_POST as $key => $value) {
                $json['pesan'][$key] = form_error($key);
            }
        }
        echo json_encode($json);
    }
    public function destroy()
    {
        $kode = $this->input->post('kode', true);
        $action = $this->Mkaryawan->destroy($kode);
        if ($action) {
            $json = array(
                'status' => '0100',
                'message' => successDestroy()
            );
        } else {
            $json = array(
                'status' => '0101',
                'message' => errorDestroy()
            );
        }
        echo json_encode($json);
    }
}

/* End of file Karyawan.php */
