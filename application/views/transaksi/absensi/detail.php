<table class="table">
    <tr>
        <th>Karyawan</th>
        <td><?= $data['nama'] ?></td>
    </tr>
    <tr>
        <th>ID Absen</th>
        <td><?= $data['idabsen'] ?></td>
    </tr>
    <tr>
        <th>Tanggal</th>
        <td><?= format_indo($data['tanggal']) ?></td>
    </tr>
    <tr>
        <th colspan="2">Jam Ambil Absen</th>
    </tr>
    <?php foreach ($data['absen'] as $d) { ?>
        <tr>
            <td><?= $d['nomor'] == 1 ? 'Jam Masuk' : 'Jam Pulang' ?></td>
            <td><?= $d['jam'] ?></td>
        </tr>
    <?php } ?>
</table>