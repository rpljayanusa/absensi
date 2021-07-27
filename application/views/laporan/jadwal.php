<!DOCTYPE html>
<html>

<head>
    <title><?= $title ?></title>
    <link href="<?= assets() ?>styles_cetak.css" rel="stylesheet" type="text/css">
    <style type="text/css">
        body,
        td,
        th {
            font-family: sans-serif;
        }

        .currency:before {
            float: left;
            padding-left: 5px;
            content: 'Rp.';
        }

        .currency1 {
            float: right;
            padding-right: 5px;
        }

        .pagebreak {
            visibility: visible;
            page-break-after: always;
        }
    </style>
</head>
<!-- onload="window.print()" -->

<body onload="window.print()">
    <table class="table-list" border="0" style="width: 100%">
        <tr style="font-size: 12pt;">
            <td align="right" width="15%"></td>
            <td align="center" width="70%" height="80px">
                <strong>
                    CV. Flazz Technologies<br />
                    Jl. Gajah Mada No. 11, Padang, Sumatera Barat<br />
                    Jadwal Karyawan
                </strong>
            </td>
            <td align="left" width="15%"></td>
        </tr>
    </table>
    <table border="0" style="width: 100%; font-size: 12pt;">
        <tr>
            <td><b>Bulan : <?= bulan($bulan) . ' ' . $tahun ?></b></td>
        </tr>
    </table>
    <table class="table-rincian" width="100%">
        <tr>
            <td align="center">Hari/Tanggal</td>
            <td align="center">Nama</td>
            <td align="center">Shift</td>
        </tr>
        <?php $no = 0;
        $date = $tahun . '-' . $bulan . '-01';
        $end = $tahun . '-' .  $bulan . '-' . date('t', strtotime($date));
        while (strtotime($date) <= strtotime($end)) {
            $day_num = date('d', strtotime($date));
            $date = date("Y-m-d", strtotime("+1 day", strtotime($date)));
            $tgl_en = $tahun . '-' . $bulan . '-' . $day_num;
            $tgl_in = $day_num . '-' . $bulan . '-' . date('Y');
            foreach ($data as $d) {
                $row = $this->db->where(['tanggal_detail' => $tgl_en, 'karyawan_detail' => $d['id_karyawan']])->get('jadwal_detail')->row_array();
        ?>
                <tr>
                    <td><?= hari_indonesia($tgl_en) . ', ' . $day_num . '-' . $bulan . '-' . $tahun; ?></td>
                    <td><?= $d['nama_karyawan'] ?></td>
                    <td><?= ucwords($row['shift_detail']) ?></td>
                </tr>
        <?php }
            $no++;
        } ?>
    </table>
    <table border="0" style="width: 100%; font-size: 10pt;">
        <tr>
            <td width="80%"></td>
            <td style="border-bottom: none;">
                Padang, <?= format_indo(date('Y-m-d')) ?><br>
                <br><br><br><br><br><br>
                Pimpinan
            </td>
        </tr>
    </table>
</body>

</html>