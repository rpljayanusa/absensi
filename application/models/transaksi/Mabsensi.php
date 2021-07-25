<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mabsensi extends CI_Model
{
    public function jumlah_data()
    {
        return $this->db->from('absen')
            ->group_by('karyawan_absen,tanggal_absen')
            ->count_all_results();
    }
    public function tampil_data($start, $length)
    {
        if (level_user() == 2) :
            $query = $this->db->query("SELECT * FROM absen JOIN karyawan ON karyawan_absen=id_karyawan WHERE karyawan_absen='" . id_user() . "' GROUP BY karyawan_absen,tanggal_absen ORDER BY tanggal_absen DESC LIMIT $start,$length");
        else :
            $query = $this->db->query("SELECT * FROM absen JOIN karyawan ON karyawan_absen=id_karyawan GROUP BY karyawan_absen,tanggal_absen ORDER BY tanggal_absen DESC LIMIT $start,$length");
        endif;
        return $query;
    }
    public function cari_data($search)
    {
        $query = $this->db->query("SELECT * FROM absen JOIN karyawan ON karyawan_absen=id_karyawan WHERE nama_karyawan LIKE '%$search%' OR DATE_FORMAT(tanggal_absen,'%d-%m-%Y') LIKE '%$search%' GROUP BY karyawan_absen,tanggal_absen ORDER BY tanggal_absen DESC");
        return $query;
    }
    public function upload_file($filename)
    {
        $this->load->library('upload'); // Load librari upload

        $config['upload_path'] = './excel/';
        $config['allowed_types'] = 'xlsx';
        $config['max_size']  = '2048';
        $config['overwrite'] = true;
        $config['file_name'] = $filename;

        $this->upload->initialize($config); // Load konfigurasi uploadnya
        if ($this->upload->do_upload('file')) { // Lakukan upload dan Cek jika proses upload berhasil
            // Jika berhasil :
            $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
            return $return;
        } else {
            // Jika gagal :
            $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
            return $return;
        }
    }
    public function show($kode)
    {
        $query = $this->db->from('absen')
            ->join('karyawan', 'karyawan_absen=id_karyawan')
            ->where('id_absen', $kode)
            ->get()->row_array();
        $data = [
            'nama' => $query['nama_karyawan'],
            'idabsen' => $query['idabsen_karyawan'],
            'tanggal' => $query['tanggal_absen']
        ];
        $query_absen = $this->db
            ->where(['karyawan_absen' => $query['karyawan_absen'], 'tanggal_absen' => $query['tanggal_absen']])
            ->order_by('waktu_absen', 'asc')
            ->get('absen')
            ->result();
        $dataJam = array();
        $valueJam = array();
        $no = 1;
        foreach ($query_absen as $qa) {
            $valueJam = [
                'nomor' => $no,
                'jam' => $qa->waktu_absen
            ];
            $dataJam[] = $valueJam;
            $no++;
        }
        $data['absen'] = $dataJam;
        return $data;
    }
}

/* End of file Mabsensi.php */
