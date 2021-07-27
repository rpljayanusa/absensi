<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jenis extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_user();
        $this->load->model('master/Mjenis');
    }
    public function index()
    {
        $data = [
            'title' => 'Jenis Cuti',
            'links' => '<li class="active">Jenis Cuti</li>'
        ];
        $this->template->display('master/jenis/index', $data);
    }
    public function data()
    {
        $action = $this->input->post('action');
        if (isset($action)) {
            if ($action == 'fetch_data') {
                $query = $this->Mjenis->fetch_all();
                if ($query == null) {
                    $data = (int)0;
                } else {
                    foreach ($query as $row) {
                        $data[] = [
                            'id' => $row['id_jenis'],
                            'nama' => $row['nama_jenis']
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
            'name' => 'Tambah Jenis Cuti',
            'post' => 'jenis/store',
            'class' => 'form_create'
        ];
        $this->template->modal_form('master/jenis/create', $data);
    }
    public function store()
    {
        $this->form_validation->set_rules('nama', 'Jenis Cuti', 'required');
        $this->form_validation->set_message('required', errorRequired());
        $this->form_validation->set_error_delimiters(errorDelimiter(), errorDelimiter_close());
        if ($this->form_validation->run() == TRUE) {
            $post = $this->input->post(null, TRUE);
            $this->Mjenis->store($post);
            $json = array(
                'status' => '0100',
                'pesan' => 'Data jenis cuti telah disimpan'
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
            'name' => 'Edit Jenis Cuti',
            'post' => 'jenis/update',
            'class' => 'form_create',
            'data' => $this->Mjenis->show($kode)
        ];
        $this->template->modal_form('master/jenis/edit', $data);
    }
    public function update()
    {
        $this->form_validation->set_rules('nama', 'Jenis Cuti', 'required');
        $this->form_validation->set_message('required', errorRequired());
        $this->form_validation->set_error_delimiters(errorDelimiter(), errorDelimiter_close());
        if ($this->form_validation->run() == TRUE) {
            $post = $this->input->post(null, TRUE);
            $this->Mjenis->update($post);
            $json = array(
                'status' => '0100',
                'pesan' => 'Data jenis cuti telah dirubah'
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
        $action = $this->Mjenis->destroy($kode);
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