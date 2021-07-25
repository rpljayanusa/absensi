<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absensi extends CI_Controller
{
    private $filename = "import_data";
    public function __construct()
    {
        parent::__construct();
        cek_user();
        $this->load->model('transaksi/Mabsensi');
    }
    public function index()
    {
        $data = [
            'title' => 'Absensi',
            'links' => '<li class="active">Absensi</li>'
        ];
        $this->template->display('transaksi/absensi/index', $data);
    }
    public function data()
    {
        $draw   = $_REQUEST['draw'];
        $length = $_REQUEST['length'];
        $start  = $_REQUEST['start'];
        $search = $_REQUEST['search']["value"];
        $total  = $this->Mabsensi->jumlah_data();
        $output = array();
        $output['draw'] = $draw;
        $output['recordsTotal'] = $output['recordsFiltered'] = $total;
        $output['data'] = array();
        if ($search != "") {
            $query = $this->Mabsensi->cari_data($search);
        } else {
            $query = $this->Mabsensi->tampil_data($start, $length);
        }
        if ($search != "") {
            $count = $this->Mabsensi->cari_data($search);
            $output['recordsTotal'] = $output['recordsFiltered'] = $count->num_rows();
        }
        $no = $_REQUEST['start'];
        foreach ($query->result_array() as $d) {
            $checkin = $this->db
                ->where(['karyawan_absen' => $d['id_karyawan'], 'tanggal_absen' => $d['tanggal_absen']])
                ->order_by('waktu_absen', 'asc')
                ->limit(1)
                ->get('absen')->row();
            $checkout = $this->db
                ->where(['karyawan_absen' => $d['id_karyawan'], 'tanggal_absen' => $d['tanggal_absen']])
                ->order_by('waktu_absen', 'desc')
                ->limit(1)
                ->get('absen')->row();
            $no++;
            $detail = '<a href="javascript:void(0)" onclick="detail(\'' . $d['id_absen'] . '\')"><i class="icon-eye8 text-blue" title="Detail"></i></a>';
            $result[] = array(
                $no . '.',
                $detail,
                $d['nama_karyawan'],
                $d['idabsen_karyawan'],
                format_biasa($d['tanggal_absen']),
                $checkin->waktu_absen,
                $checkin->waktu_absen == $checkout->waktu_absen ? '' : $checkout->waktu_absen
            );
            $output['data'] = $result;
        }
        echo json_encode($output);
    }
    public function upload()
    {
        $data = [
            'name' => 'Upload Absensi',
            'post' => 'absensi/store',
            'class' => 'form_create',
            'multipart' => 1
        ];
        $this->template->modal_form('transaksi/absensi/upload', $data);
    }
    public function store()
    {
        $upload = $this->Mabsensi->upload_file($this->filename);
        if ($upload['result'] == "success") {
            include APPPATH . 'third_party/PHPExcel/PHPExcel.php';
            $excelreader = new PHPExcel_Reader_Excel2007();
            $loadexcel = $excelreader->load('excel/' . $this->filename . '.xlsx');
            $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true, true);
            $data = array();
            $numrow = 1;
            foreach ($sheet as $row) {
                if ($numrow > 1) {
                    $id = $row['A'];
                    $explode_datetime = explode(" ", $row['B']);
                    $explode_tanggal = explode("/", $explode_datetime[0]);
                    $explode_waktu = explode(":", $explode_datetime[1]);
                    $tahun = $explode_tanggal[2];
                    $bulan = strlen($explode_tanggal[1]) == 1 ? '0' . $explode_tanggal[1] : $explode_tanggal[1];
                    $hari = strlen($explode_tanggal[0]) == 1 ? '0' . $explode_tanggal[0] : $explode_tanggal[0];
                    $tanggal = $tahun . '-' . $bulan . '-' . $hari;
                    $jam = strlen($explode_waktu[0]) == 1 ? '0' . $explode_waktu[0] : $explode_waktu[0];
                    $menit = strlen($explode_waktu[1]) == 1 ? '0' . $explode_waktu[1] : $explode_waktu[1];
                    $waktu = $jam . ':' . $menit;
                    // $data[] = [
                    //     'id' => $row['A'],
                    //     'tanggal' => $tanggal,
                    //     'waktu' => $waktu
                    // ];
                    $query = $this->db->where('idabsen_karyawan', $id)->get('karyawan')->row_array();
                    if ($query != null) {
                        $idkaryawan = $query['id_karyawan'];
                        $query_absen = $this->db->from('absen')->where(['karyawan_absen' => $idkaryawan, 'tanggal_absen' => $tanggal, 'waktu_absen' => $waktu])->get()->row_array();
                        if ($query_absen == null) {
                            $this->db->query("INSERT INTO absen(karyawan_absen,tanggal_absen,waktu_absen) VALUES('$idkaryawan','$tanggal','$waktu')");
                        }
                    }
                }
                $numrow++;
            }
            $json = array(
                'status' => '0100',
                'pesan' => 'Data Absensi berhasil diupload',
                'data' => $data
            );
        } else {
            $json = array(
                'status' => '0101',
                'upload_error' => $upload['error']
            );
        }
        echo json_encode($json);
    }
    public function detail()
    {
        $kode = $this->input->get('kode');
        $data = [
            'name' => 'Detail Absensi',
            'data' => $this->Mabsensi->show($kode)
        ];
        $this->template->modal_info('transaksi/absensi/detail', $data);
    }
}

/* End of file Absensi.php */
