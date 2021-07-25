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
    <table class="table-rincian" width="100%">
        <tr align="center">
            <td align="center">No</td>
            <td align="center">ID Jabatan</td>
            <td align="center">Nama Jabatan</td>
        </tr>
        <?php $no = 1;
        foreach ($data as $d) { ?>
            <tr>
                <td align="center"><?= $no ?></td>
                <td align="center"><?= $d['id_jabatan'] ?></td>
                <td><?= $d['nama_jabatan'] ?></td>
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