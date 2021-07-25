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
            'title' => 'Unit Kerja',
            'links' => '<li class="active">Unit Kerja</li>'
        ];
        $this->template->display('master/unit/index', $data);
    }
    public function data()
    {
        $action = $this->input->post('action');
        if (isset($action)) {
            if ($action == 'fetch_data') {
                $query = $this->Munit->fetch_all();
                if ($query == null) {
                    $data = (int)0;
                } else {
                    foreach ($query as $row) {
                        $data[] = [
                            'id' => $row['id_unit'],
                            'nama' => $row['nama_unit']
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
            'name' => 'Tambah Unit Kerja',
            'post' => 'unit/store',
            'class' => 'form_create'
        ];
        $this->template->modal_form('master/unit/create', $data);
    }
    public function store()
    {
        $this->form_validation->set_rules('nama', 'Unit kerja', 'required');
        $this->form_validation->set_message('required', errorRequired());
        $this->form_validation->set_error_delimiters(errorDelimiter(), errorDelimiter_close());
        if ($this->form_validation->run() == TRUE) {
            $post = $this->input->post(null, TRUE);
            $this->Munit->store($post);
            $json = array(
                'status' => '0100',
                'pesan' => 'Data unit kerja telah disimpan'
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
            'name' => 'Edit Unit Kerja',
            'post' => 'unit/update',
            'class' => 'form_create',
            'data' => $this->Munit->show($kode)
        ];
        $this->template->modal_form('master/unit/edit', $data);
    }
    public function update()
    {
        $this->form_validation->set_rules('nama', 'Unit kerja', 'required');
        $this->form_validation->set_message('required', errorRequired());
        $this->form_validation->set_error_delimiters(errorDelimiter(), errorDelimiter_close());
        if ($this->form_validation->run() == TRUE) {
            $post = $this->input->post(null, TRUE);
            $this->Munit->update($post);
            $json = array(
                'status' => '0100',
                'pesan' => 'Data unit kerja telah dirubah'
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
        $action = $this->Munit->destroy($kode);
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

/* End of file Unit.php */
