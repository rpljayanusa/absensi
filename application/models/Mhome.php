<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mhome extends CI_Model
{
    public function jadwal_hari_ini()
    {
        return $this->db->where(['karyawan_detail' => id_user(), 'tanggal_detail' => date('Y-m-d')])->get('jadwal_detail')->row_array();
    }
    public function cuti_tahunan()
    {
        return $this->db->query("SELECT * FROM karyawan JOIN cuti ON id_karyawan=karyawan_cuti JOIN jenis_cuti ON jenis_cuti=id_jenis
		WHERE DATE_FORMAT(tgl_pengajuan,'%Y')='" . date('Y') . "' AND karyawan_cuti='" . id_user() . "' AND jenis_cuti=1 AND status_cuti=4")->result_array();
    }
    public function cuti_lahir()
    {
        return $this->db->query("SELECT COUNT(id_cuti) AS total FROM cuti WHERE karyawan_cuti='" . id_user() . "' AND jenis_cuti=2 AND status_cuti=4")->row_array();
    }
    public function cuti_other()
    {
        return $this->db->query("SELECT COUNT(id_cuti) AS total FROM cuti WHERE karyawan_cuti='" . id_user() . "' AND jenis_cuti=3 AND status_cuti=4")->row_array();
    }
}

/* End of file Mhome.php */
