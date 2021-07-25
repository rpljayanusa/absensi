<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mjabatan extends CI_Model
{
    public function fetch_all()
    {
        return $this->db->get('jabatan')->result_array();
    }
    public function kode()
    {
        $query = $this->db
            ->select('id_jabatan', FALSE)
            ->order_by('id_jabatan', 'DESC')
            ->limit(1)
            ->get('jabatan');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->id_jabatan) + 1;
        } else {
            $kode = 1;
        }
        return $kode;
    }
    public function store($post)
    {
        $data = array(
            'id_jabatan' => $this->kode(),
            'nama_jabatan' => $post['nama']
        );
        return $this->db->insert('jabatan', $data);
    }
    public function show($id = null)
    {
        return $this->db->where('id_jabatan', $id)->get('jabatan')->row_array();
    }
    public function update($post)
    {
        $data = array(
            'nama_jabatan' => $post['nama']
        );
        return $this->db->where('id_jabatan', $post['kode'])->update('jabatan', $data);
    }
    public function destroy($kode)
    {
        return $this->db->simple_query("DELETE FROM jabatan WHERE id_jabatan='$kode'");
    }
}

/* End of file Mjabatan.php */
