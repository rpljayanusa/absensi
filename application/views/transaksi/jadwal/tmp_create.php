<input type="hidden" name="bulan" value="<?= $tahun . '-' . $bulan ?>">
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Tanggal</th>
            <th>Karyawan</th>
            <th>Shift</th>
            <th>Check In</th>
            <th>Check Out</th>
        </tr>
    </thead>
    <tbody>
        <?php $no = 0;
        $date = $tahun . '-' . $bulan . '-01';
        $end = $tahun . '-' .  $bulan . '-' . date('t', strtotime($date));
        while (strtotime($date) <= strtotime($end)) {
            $day_num = date('d', strtotime($date));
            $date = date("Y-m-d", strtotime("+1 day", strtotime($date)));
            $tgl_en = $tahun . '-' . $bulan . '-' . $day_num;
            $tgl_in = $day_num . '-' . $bulan . '-' . date('Y');
            $nomor = 0;
            foreach ($data as $d) {
        ?>
                <tr>
                    <td><?= $day_num . '-' . $bulan . '-' . $tahun; ?></td>
                    <td><?= $d['nama_karyawan'] ?></td>
                    <td>
                        <input type="hidden" name="jadwal[<?= $tgl_en ?>][<?= $d['id_karyawan'] ?>][kode]" value="<?= $d['id_karyawan'] ?>">
                        <input type="hidden" name="jadwal[<?= $tahun . '-' . $bulan . '-' . $day_num ?>][<?= $d['id_karyawan'] ?>][tanggal]" value="<?= $tgl_en ?>">
                        <select name="jadwal[<?= $tgl_en ?>][<?= $d['id_karyawan'] ?>][shift]" id="jadwal<?= $nomor . $day_num ?>" class="form-control" onchange="shift('<?= $nomor . $day_num ?>')">
                            <option value="normal">Normal</option>
                            <option value="dayoff">Dayoff</option>
                            <option value="pagi">Pagi</option>
                            <option value="siang">Siang</option>
                            <option value="sore">Sore</option>
                            <option value="malam">Malam</option>
                        </select>
                    </td>
                    <td width="110px">
                        <input type="text" name="jadwal[<?= $tgl_en ?>][<?= $d['id_karyawan'] ?>][masuk]" id="in<?= $nomor . $day_num ?>" class="form-control" value="08:00">
                    </td>
                    <td width="110px">
                        <input type="text" name="jadwal[<?= $tgl_en ?>][<?= $d['id_karyawan'] ?>][keluar]" id="out<?= $nomor . $day_num ?>" class="form-control" value="16:00">
                    </td>
                </tr>
        <?php $nomor++;
            }
            $no++;
        } ?>
    </tbody>
</table>