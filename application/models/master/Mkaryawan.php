<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mkaryawan extends CI_Model
{
    public function fetch_all()
    {
        return $this->db->from('karyawan')
            ->join('jabatan', 'id_jabatan=jabatan_karyawan')
            ->join('unit', 'id_unit=unit_karyawan')
            ->get()->result_array();
    }
    public function kode()
    {
        $query = $this->db
            ->select('id_karyawan', FALSE)
            ->order_by('id_karyawan', 'DESC')
            ->limit(1)
            ->get('karyawan');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->id_karyawan) + 1;
        } else {
            $kode = 1;
        }
        return $kode;
    }
    public function store($post)
    {
        $data = array(
            'id_karyawan' => $this->kode(),
            'idabsen_karyawan' => $post['idabsen'],
            'nama_karyawan' => $post['nama'],
            'tempat_lahir' => $post['tempat_lahir'],
            'tanggal_lahir' => $post['tanggal_lahir'],
            'jenkel_karyawan' => $post['jenkel'],
            'agama_karyawan' => $post['agama'],
            'status_nikah' => $post['status_nikah'],
            'phone_karyawan' => $post['phone'],
            'jabatan_karyawan' => $post['jabatan'],
            'unit_karyawan' => $post['unit'],
            'tanggal_masuk' => $post['masuk'],
            'status_karyawan' => $post['status'],
            'username' => $post['username'],
            'password' => password_hash($post['password'], PASSWORD_BCRYPT),
            'level_karyawan' => $post['level']
        );
        return $this->db->insert('karyawan', $data);
    }
    public function show($id = null)
    {
        return $this->db->where('id_karyawan', $id)->get('karyawan')->row_array();
    }
    public function update($post)
    {
        if (empty($post['password'])) {
            $data = array(
                'idabsen_karyawan' => $post['idabsen'],
                'nama_karyawan' => $post['nama'],
                'tempat_lahir' => $post['tempat_lahir'],
                'tanggal_lahir' => $post['tanggal_lahir'],
                'jenkel_karyawan' => $post['jenkel'],
                'agama_karyawan' => $post['agama'],
                'status_nikah' => $post['status_nikah'],
                'phone_karyawan' => $post['phone'],
                'jabatan_karyawan' => $post['jabatan'],
                'unit_karyawan' => $post['unit'],
                'tanggal_masuk' => $post['masuk'],
                'status_karyawan' => $post['status'],
                'username' => $post['username'],
                'level_karyawan' => $post['level']
            );
        } else {
            $data = array(
                'idabsen_karyawan' => $post['idabsen'],
                'nama_karyawan' => $post['nama'],
                'tempat_lahir' => $post['tempat_lahir'],
                'tanggal_lahir' => $post['tanggal_lahir'],
                'jenkel_karyawan' => $post['jenkel'],
                'agama_karyawan' => $post['agama'],
                'status_nikah' => $post['status_nikah'],
                'phone_karyawan' => $post['phone'],
                'jabatan_karyawan' => $post['jabatan'],
                'unit_karyawan' => $post['unit'],
                'tanggal_masuk' => $post['masuk'],
                'status_karyawan' => $post['status'],
                'username' => $post['username'],
                'password' => password_hash($post['password'], PASSWORD_BCRYPT),
                'level_karyawan' => $post['level']
            );
        }
        return $this->db->where('id_karyawan', $post['kode'])->update('karyawan', $data);
    }
    public function destroy($kode)
    {
        return $this->db->simple_query("DELETE FROM karyawan WHERE id_karyawan='$kode'");
    }
}

/* End of file Mkaryawan.php */
