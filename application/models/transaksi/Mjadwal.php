<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mjadwal extends CI_Model
{
    public function fetch_all()
    {
        return $this->db->query("SELECT * FROM jadwal ORDER BY id_jadwal DESC")->result_array();
    }
    public function kode()
    {
        $query = $this->db
            ->select('id_jadwal', FALSE)
            ->order_by('id_jadwal', 'DESC')
            ->limit(1)
            ->get('jadwal');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->id_jadwal) + 1;
        } else {
            $kode = 1;
        }
        return $kode;
    }
    public function store($post)
    {
        $kode = $this->kode();
        $data = array(
            'id_jadwal' => $kode,
            'bulan_jadwal' => $post['bulan'],
            'status_jadwal' => 0
        );
        $data = $this->db->insert('jadwal', $data);
        foreach ($post['jadwal'] as $key => $value) {
            foreach ($value as $keyrow => $value_result) {
                $data = array(
                    'idjadwal_detail' => $kode,
                    'karyawan_detail' => $value_result['kode'],
                    'tanggal_detail' => $value_result['tanggal'],
                    'shift_detail' => $value_result['shift'],
                    'jam_masuk' => $value_result['masuk'],
                    'jam_keluar' => $value_result['keluar']
                );
                $this->db->insert('jadwal_detail', $data);
            }
        }
        return $data;
    }
    public function show($kode)
    {
        return $this->db->where('id_jadwal', $kode)->get('jadwal')->row_array();
    }
    public function update($post)
    {
        foreach ($post['jadwal'] as $key => $value) {
            foreach ($value as $keyrow => $value_result) {
                $check = $this->db->from('jadwal_detail')->where(['karyawan_detail' => $value_result['kode'], 'tanggal_detail' => $value_result['tanggal']])->count_all_results();
                if ($check > 0) {
                    $data = array(
                        'karyawan_detail' => $value_result['kode'],
                        'tanggal_detail' => $value_result['tanggal'],
                        'shift_detail' => $value_result['shift'],
                        'jam_masuk' => $value_result['masuk'],
                        'jam_keluar' => $value_result['keluar']
                    );
                    $this->db->where(['karyawan_detail' => $value_result['kode'], 'tanggal_detail' => $value_result['tanggal']])->update('jadwal_detail', $data);
                } else {
                    $data = array(
                        'idjadwal_detail' => $post['idjadwal'],
                        'karyawan_detail' => $value_result['kode'],
                        'tanggal_detail' => $value_result['tanggal'],
                        'shift_detail' => $value_result['shift'],
                        'jam_masuk' => $value_result['masuk'],
                        'jam_keluar' => $value_result['keluar']
                    );
                    $this->db->insert('jadwal_detail', $data);
                }
            }
        }
    }
    public function validasi($kode, $status)
    {
        $data = array(
            'status_jadwal' => $status == 0 ? 1 : 0
        );
        return $this->db->where('id_jadwal', $kode)->update('jadwal', $data);
    }
}

/* End of file Mjadwal.php */
