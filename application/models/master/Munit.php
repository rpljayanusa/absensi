<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Munit extends CI_Model
{
    public function fetch_all()
    {
        return $this->db->get('unit')->result_array();
    }
    public function kode()
    {
        $query = $this->db
            ->select('id_unit', FALSE)
            ->order_by('id_unit', 'DESC')
            ->limit(1)
            ->get('unit');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->id_unit) + 1;
        } else {
            $kode = 1;
        }
        return $kode;
    }
    public function store($post)
    {
        $data = array(
            'id_unit' => $this->kode(),
            'nama_unit' => $post['nama']
        );
        return $this->db->insert('unit', $data);
    }
    public function show($id = null)
    {
        return $this->db->where('id_unit', $id)->get('unit')->row_array();
    }
    public function update($post)
    {
        $data = array(
            'nama_unit' => $post['nama']
        );
        return $this->db->where('id_unit', $post['kode'])->update('unit', $data);
    }
    public function destroy($kode)
    {
        return $this->db->simple_query("DELETE FROM unit WHERE id_unit='$kode'");
    }
}

/* End of file Munit.php */
