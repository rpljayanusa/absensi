<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cuti extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        cek_user();
        $this->load->model('transaksi/Mcuti');
    }
    public function index()
    {
        $data = [
            'title' => 'Pengajuan Cuti',
            'links' => '<li class="active">Pengajuan Cuti</li>'
        ];
        $this->template->display('transaksi/cuti/index', $data);
    }
    public function data()
    {
        $action = $this->input->post('action');
        if (isset($action)) {
            if ($action == 'fetch_data') {
                $query = $this->Mcuti->fetch_all();
                if ($query == null) {
                    $data = (int)0;
                } else {
                    foreach ($query as $row) {
                        $data[] = [
                            'id' => $row['id_cuti'],
                            'nama' => $row['nama_karyawan'],
                            'tanggal' => format_biasa($row['tgl_pengajuan']),
                            'jenis' => $row['nama_jenis'],
                            'mulai' => format_biasa($row['mulai_cuti']),
                            'selesai' => format_biasa($row['selesai_cuti']),
                            'alasan' => $row['alasan_cuti'],
                            'status' => status_span($row['status_cuti'], 'cuti')
                        ];
                    }
                }
                echo json_encode($data);
            }
        }
    }
    public function create()
    {
        $data = [
            'name' => 'Input Pengajuan Cuti',
            'post' => 'cuti/store',
            'class' => 'form_create',
            'jenis' => $this->Mcuti->jenis()
        ];
        $this->template->modal_form('transaksi/cuti/create', $data);
    }
    public function store()
    {
        $this->form_validation->set_rules('start', 'Tanggal mulai', 'required');
        $this->form_validation->set_rules('end', 'Tanggal selesai', 'required');
        $this->form_validation->set_rules('jenis', 'Jenis cuti', 'required');
        $this->form_validation->set_rules('note', 'Alasan cuti', 'required');
        $this->form_validation->set_message('required', errorRequired());
        $this->form_validation->set_error_delimiters(errorDelimiter(), errorDelimiter_close());
        if ($this->form_validation->run() == TRUE) {
            $post = $this->input->post(null, TRUE);
            $iduser = id_user();
            $tahun = date('Y');
            $start = $post['start'];
            $end = $post['end'];
            $jenis = $post['jenis'];
            if ($jenis == 1) {
                $data_jenis = $this->db->where('id_jenis', $jenis)->get('jenis_cuti')->row_array();
                $data = $this->db->query("SELECT * FROM cuti WHERE karyawan_cuti='$iduser' AND jenis_cuti=1 AND status_cuti=4 AND DATE_FORMAT(tgl_pengajuan,'%Y')='$tahun'")->result_array();
                $total = 0;
                foreach ($data as $d) {
                    $awal  = date_create($d['mulai_cuti']);
                    $akhir = date_create($d['selesai_cuti']);
                    $diff  = date_diff($awal, $akhir);
                    $lama = $diff->d + 1;
                    $total = $total + $lama;
                }
                $sisa = $data_jenis['jumlah_hari'] - $total;
                $awal1  = date_create($start);
                $akhir1 = date_create($end);
                $diff1  = date_diff($awal1, $akhir1);
                $lama1 = $diff1->d + 1;
                if ($lama1 > $sisa) :
                    $json = array(
                        'status' => '0100',
                        'jenis' => 'tahunan',
                        'pesan' => 'Anda hanya memiliki sisa cuti tahunan selama ' . $sisa . ' hari'
                    );
                else :
                    $this->Mcuti->store($post);
                    $json = array(
                        'status' => '0100',
                        'pesan' => 'Data pengajuan cuti telah disimpan'
                    );
                endif;
            } elseif ($jenis == 2) {
                $d1 = new DateTime($end);
                $d2 = new DateTime($start);
                $Months = $d2->diff($d1);
                $howeverManyMonths = (($Months->y) * 12) + ($Months->m) - 1;
                if ($howeverManyMonths < 3) {
                    $json = array(
                        'status' => '0100',
                        'jenis' => 'tahunan',
                        'pesan' => 'Batas limit cuti melahirkan selama 3 bulan.'
                    );
                } else if ($howeverManyMonths > 3) {
                    $json = array(
                        'status' => '0100',
                        'jenis' => 'tahunan',
                        'pesan' => 'Batas limit cuti melahirkan hanya tersedia 3 bulan.'
                    );
                } else {
                    $this->Mcuti->store($post);
                    $json = array(
                        'status' => '0100',
                        'pesan' => 'Data pengajuan cuti telah disimpan'
                    );
                }
            } else {
                $this->Mcuti->store($post);
                $json = array(
                    'status' => '0100',
                    'pesan' => 'Data pengajuan cuti telah disimpan'
                );
            }
        } else {
            $json = array(
                'status' => '0101'
            );
            foreach ($_POST as $key => $value) {
                $json['pesan'][$key] = form_error($key);
            }
        }
        echo json_encode($json);
    }
    public function edit()
    {
        $kode = $this->input->get('kode');
        $data = [
            'name' => 'Edit Pengajuan Cuti',
            'post' => 'cuti/update',
            'class' => 'form_create',
            'data' => $this->Mcuti->show($kode),
            'jenis' => $this->Mcuti->jenis()
        ];
        $this->template->modal_form('transaksi/cuti/edit', $data);
    }
    public function update()
    {
        $this->form_validation->set_rules('start', 'Tanggal mulai', 'required');
        $this->form_validation->set_rules('end', 'Tanggal selesai', 'required');
        $this->form_validation->set_rules('note', 'Alasan cuti', 'required');
        $this->form_validation->set_message('required', errorRequired());
        $this->form_validation->set_error_delimiters(errorDelimiter(), errorDelimiter_close());
        if ($this->form_validation->run() == TRUE) {
            $post = $this->input->post(null, TRUE);
            $this->Mcuti->update($post);
            $json = array(
                'status' => '0100',
                'pesan' => 'Data pengajuan cuti telah dirubah'
            );
        } else {
            $json = array(
                'status' => '0101'
            );
            foreach ($_POST as $key => $value) {
                $json['pesan'][$key] = form_error($key);
            }
        }
        echo json_encode($json);
    }
    public function destroy()
    {
        $kode = $this->input->post('kode', true);
        $action = $this->Mcuti->destroy($kode);
        if ($action) {
            $json = array(
                'status' => '0100',
                'message' => successDestroy()
            );
        } else {
            $json = array(
                'status' => '0101',
                'message' => errorDestroy()
            );
        }
        echo json_encode($json);
    }
    public function detail()
    {
        $kode = $this->input->get('kode');
        $data = [
            'name' => level_user() == 2 ? 'Detail Pengajuan Cuti' : 'Validasi Pengajuan Cuti',
            'data' => $this->Mcuti->show($kode)
        ];
        $this->template->modal_info('transaksi/cuti/detail', $data);
    }
    public function validasi()
    {
        $kode = $this->input->get('kode');
        $jenis = $this->input->get('jenis');
        if (level_user() == 1) :
            if ($jenis == 'approve') :
                $this->db->where('id_cuti', $kode)->update('cuti', ['status_cuti' => 2]);
            else :
                $this->db->where('id_cuti', $kode)->update('cuti', ['status_cuti' => 1]);
            endif;
        elseif (level_user() == 3) :
            if ($jenis == 'approve') :
                $this->db->where('id_cuti', $kode)->update('cuti', ['status_cuti' => 4]);
            else :
                $this->db->where('id_cuti', $kode)->update('cuti', ['status_cuti' => 3]);
            endif;
        endif;
        $json = array(
            'status' => '0100',
            'pesan' => 'Status pengajuan cuti berhasil dirubah'
        );
        echo json_encode($json);
    }
    public function jeniscuti()
    {
        $iduser = id_user();
        $tahun = date('Y');
        $start = $this->input->get('start');
        $end = $this->input->get('end');
        $jenis = $this->input->get('jenis');
        if ($jenis == 1) {
            $data_jenis = $this->db->where('id_jenis', $jenis)->get('jenis_cuti')->row_array();
            $data = $this->db->query("SELECT * FROM cuti WHERE karyawan_cuti='$iduser' AND jenis_cuti=1 AND status_cuti=4 AND DATE_FORMAT(tgl_pengajuan,'%Y')='$tahun'")->result_array();
            $total = 0;
            foreach ($data as $d) {
                $awal  = date_create($d['mulai_cuti']);
                $akhir = date_create($d['selesai_cuti']);
                $diff  = date_diff($awal, $akhir);
                $lama = $diff->d + 1;
                $total = $total + $lama;
            }
            $sisa = $data_jenis['jumlah_hari'] - $total;
            $awal1  = date_create($start);
            $akhir1 = date_create($end);
            $diff1  = date_diff($awal1, $akhir1);
            $lama1 = $diff1->d + 1;
            if ($lama1 > $sisa) :
                echo '<div class="alert alert-danger alert-dismissible">Batas limit cuti tahunan sudah digunakan.</div>';
            else :
                echo '<div class="alert alert-success alert-dismissible">Anda masih memiliki sisa cuti tahunan selama ' . $sisa . ' hari.</div>';
            endif;
        } elseif ($jenis == 2) {
            $d1 = new DateTime($end);
            $d2 = new DateTime($start);
            $Months = $d2->diff($d1);
            $howeverManyMonths = (($Months->y) * 12) + ($Months->m) - 1;
            if ($howeverManyMonths < 3) {
                echo '<div class="alert alert-danger alert-dismissible">Batas limit cuti melahirkan selama 3 bulan.</div>';
            } else if ($howeverManyMonths > 3) {
                echo '<div class="alert alert-danger alert-dismissible">Batas limit cuti melahirkan hanya tersedia 3 bulan.</div>';
            } else {
                echo '<div class="alert alert-success alert-dismissible">Anda mendapatkan masa cuti melahirkan selama ' . $howeverManyMonths . ' bulan.</div>';
            }
        }
    }
}

/* End of file Cuti.php */
