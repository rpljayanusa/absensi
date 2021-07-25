<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Mlogin');
    }
    public function index()
    {
        $this->load->view('login');
    }
    public function signin()
    {
        $post = $this->input->post(null, TRUE);
        $username = $post['username'];
        $check_user = $this->Mlogin->check_user($username);
        // var_dump($check_user);
        // exit;
        $this->form_validation->set_rules('username', 'Username', 'callback_username_check[' . $check_user->num_rows() . ']');
        $this->form_validation->set_rules('password', 'Password', 'callback_password_check[' . $username . ']');
        if ($this->form_validation->run()) {
            $data = $check_user->row_array();
            $this->session->set_userdata('masuk', TRUE);
            if ($this->session->userdata('masuk') == TRUE) {
                $this->session->set_userdata('status_login', 'session_log');
                $this->session->set_userdata('kode', $data['id_karyawan']);
                $array = ['status' => true];
            } else {
                $this->session->sess_destroy();
                $array = ['status' => false];
            }
        } else {
            $array = array(
                'status' => false,
                'username_error' => form_error('username'),
                'password_error' => form_error('password')
            );
        }
        echo json_encode($array);
    }
    public function username_check($username, $recordCount)
    {
        if ($username == null) {
            $this->form_validation->set_message('username_check', 'Username tidak boleh kosong');
            return false;
        } else if ($recordCount == 0) {
            $this->form_validation->set_message('username_check', 'Username tidak ditemukan');
            return FALSE;
        } else {
            return true;
        }
    }
    public function password_check($password, $username)
    {
        $check = $this->Mlogin->check_user($username);
        $query = $check->row_array();
        $pass  = $query['password'];
        if ($password == null) {
            $this->form_validation->set_message('password_check', 'Password tidak boleh kosong');
            return false;
        } else {
            if (password_verify($password, $pass)) {
                return true;
            } else {
                $this->form_validation->set_message('password_check', 'Password anda salah');
                return FALSE;
            }
        }
    }
    public function logout()
    {
        $this->session->unset_userdata('status_login', FALSE);
        $this->session->unset_userdata('kode');
        redirect(base_url());
    }
}

/* End of file Login.php */
