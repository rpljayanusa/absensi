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
            'title' => 'Jabatan',
            'links' => '<li class="active">Jabatan</li>'
        ];
        $this->template->display('master/jabatan/index', $data);
    }
    public function data()
    {
        $action = $this->input->post('action');
        if (isset($action)) {
            if ($action == 'fetch_data') {
                $query = $this->Mjabatan->fetch_all();
                if ($query == null) {
                    $data = (int)0;
                } else {
                    foreach ($query as $row) {
                        $data[] = [
                            'id' => $row['id_jabatan'],
                            'nama' => $row['nama_jabatan']
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
            'name' => 'Tambah Jabatan',
            'post' => 'jabatan/store',
            'class' => 'form_create'
        ];
        $this->template->modal_form('master/jabatan/create', $data);
    }
    public function store()
    {
        $this->form_validation->set_rules('nama', 'Jabatan', 'required');
        $this->form_validation->set_message('required', errorRequired());
        $this->form_validation->set_error_delimiters(errorDelimiter(), errorDelimiter_close());
        if ($this->form_validation->run() == TRUE) {
            $post = $this->input->post(null, TRUE);
            $this->Mjabatan->store($post);
            $json = array(
                'status' => '0100',
                'pesan' => 'Data jabatan telah disimpan'
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
            'name' => 'Edit Jabatan',
            'post' => 'jabatan/update',
            'class' => 'form_create',
            'data' => $this->Mjabatan->show($kode)
        ];
        $this->template->modal_form('master/jabatan/edit', $data);
    }
    public function update()
    {
        $this->form_validation->set_rules('nama', 'Jabatan', 'required');
        $this->form_validation->set_message('required', errorRequired());
        $this->form_validation->set_error_delimiters(errorDelimiter(), errorDelimiter_close());
        if ($this->form_validation->run() == TRUE) {
            $post = $this->input->post(null, TRUE);
            $this->Mjabatan->update($post);
            $json = array(
                'status' => '0100',
                'pesan' => 'Data jabatan telah dirubah'
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
        $action = $this->Mjabatan->destroy($kode);
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

/* End of file Jabatan.php */
