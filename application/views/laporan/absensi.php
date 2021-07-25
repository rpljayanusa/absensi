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

<body onload="window.print()">
    <table class="table-list" border="0" style="width: 100%">
        <tr style="font-size: 12pt;">
            <td align="right" width="15%"></td>
            <td align="center" width="70%" height="80px">
                <strong>
                    CV. Flazz Technologies<br />
                    Jl. Gajah Mada No. 11, Padang, Sumatera Barat<br />
                    <?= $title ?>
                </strong>
            </td>
            <td align="left" width="15%"></td>
        </tr>
    </table>
    <table border="0" style="width: 100%; font-size: 10pt;">
        <tr>
            <td>Bulan : <?= bulan($bulan) . ' ' . $tahun ?></td>
        </tr>
    </table>
    <table class="table-rincian" width="100%">
        <tr align="center" style="font-weight: bold;">
            <td align="center">ID Absen</td>
            <td align="center">Hari/Tanggal</td>
            <td align="center">ID Karyawan</td>
            <td align="center">Nama Karyawan</td>
            <td>Check In</td>
            <td>Check Out</td>
            <td align="center">Keterangan</td>
        </tr>
        <?php $no = 1;
        foreach ($data as $d) {
            $id = $d['id_karyawan'];
            $tanggal = $d['tanggal_absen'];
            $checkin = $this->db
                ->where(['karyawan_absen' => $id, 'tanggal_absen' => $tanggal])
                ->order_by('waktu_absen', 'asc')
                ->limit(1)
                ->get('absen')->row();
            $checkout = $this->db
                ->where(['karyawan_absen' => $id, 'tanggal_absen' => $tanggal])
                ->order_by('waktu_absen', 'desc')
                ->limit(1)
                ->get('absen')->row();
            $shift = $this->db->where(['tanggal_detail' => $tanggal, 'karyawan_detail' => $id])->get('jadwal_detail')->row_array();
        ?>
            <tr>
                <td align="center"><?= $d['idabsen_karyawan'] ?></td>
                <td><?= hari_indonesia($d['tanggal_absen']) . ', ' . format_biasa($d['tanggal_absen']) ?></td>
                <td align="center"><?= $d['id_karyawan'] ?></td>
                <td><?= $d['nama_karyawan'] ?></td>
                <td align="center"><?= $checkin->waktu_absen ?></td>
                <td align="center"><?= $checkin->waktu_absen == $checkout->waktu_absen ? '' : $checkout->waktu_absen ?></td>
                <td><?= $shift != null ? ucwords($shift['shift_detail']) : '' ?></td>
            </tr>
        <?php $no++;
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