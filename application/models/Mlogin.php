<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mlogin extends CI_Model
{
    private $tabel = 'karyawan';
    public function check_user($username)
    {
        return $this->db->where('username', $username)->get($this->tabel);
    }
}

/* End of file Mlogin.php */
