<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mjenis extends CI_Model
{
    public function fetch_all()
    {
        return $this->db->get('jenis_cuti')->result_array();
    }
    public function kode()
    {
        $query = $this->db
            ->select('id_jenis', FALSE)
            ->order_by('id_jenis', 'DESC')
            ->limit(1)
            ->get('jenis_cuti');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->id_jenis) + 1;
        } else {
            $kode = 1;
        }
        return $kode;
    }
    public function store($post)
    {
        $data = array(
            'id_jenis' => $this->kode(),
            'nama_jenis' => $post['nama'],
            'jumlah_hari' => $post['jumlah']
        );
        return $this->db->insert('jenis_cuti', $data);
    }
    public function show($id = null)
    {
        return $this->db->where('id_jenis', $id)->get('jenis_cuti')->row_array();
    }
    public function update($post)
    {
        $data = array(
            'nama_jenis' => $post['nama'],
            'jumlah_hari' => $post['jumlah']
        );
        return $this->db->where('id_jenis', $post['kode'])->update('jenis_cuti', $data);
    }
    public function destroy($kode)
    {
        return $this->db->simple_query("DELETE FROM jenis_cuti WHERE id_jenis='$kode'");
    }
}

/* End of file Mjenis.php */
