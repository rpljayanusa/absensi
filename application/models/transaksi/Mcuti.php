<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mcuti extends CI_Model
{
    public function jenis()
    {
        return $this->db->get('jenis_cuti')->result_array();
    }
    public function fetch_all()
    {
        if (level_user() == 2) :
            return $this->db->from('karyawan')
                ->join('cuti', 'id_karyawan=karyawan_cuti')
                ->join('jenis_cuti', 'jenis_cuti=id_jenis')
                ->where('karyawan_cuti', id_user())
                ->get()->result_array();
        else :
            return $this->db->from('karyawan')
                ->join('cuti', 'id_karyawan=karyawan_cuti')
                ->join('jenis_cuti', 'jenis_cuti=id_jenis')
                ->get()->result_array();
        endif;
    }
    public function kode()
    {
        $query = $this->db
            ->select('id_cuti', FALSE)
            ->order_by('id_cuti', 'DESC')
            ->limit(1)
            ->get('cuti');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->id_cuti) + 1;
        } else {
            $kode = 1;
        }
        return $kode;
    }
    public function store($post)
    {
        $data = array(
            'id_cuti' => $this->kode(),
            'karyawan_cuti' => id_user(),
            'tgl_pengajuan' => date('Y-m-d'),
            'mulai_cuti' => $post['start'],
            'selesai_cuti' => $post['end'],
            'jenis_cuti' => $post['jenis'],
            'alasan_cuti' => $post['note'],
            'status_cuti' => 0
        );
        return $this->db->insert('cuti', $data);
    }
    public function show($id = null)
    {
        return $this->db->from('karyawan')
            ->join('cuti', 'id_karyawan=karyawan_cuti')
            ->join('jenis_cuti', 'jenis_cuti=id_jenis')
            ->where('id_cuti', $id)
            ->get()->row_array();
    }
    public function update($post)
    {
        $data = array(
            'mulai_cuti' => $post['start'],
            'selesai_cuti' => $post['end'],
            'alasan_cuti' => $post['note']
        );
        return $this->db->where('id_cuti', $post['kode'])->update('cuti', $data);
    }
    public function destroy($kode)
    {
        return $this->db->simple_query("DELETE FROM cuti WHERE id_cuti='$kode'");
    }
}

/* End of file Mcuti.php */
