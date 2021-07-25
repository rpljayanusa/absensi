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
        $pecah = explode("-", $data['bulan_jadwal']);
        $bulan = $pecah[1];
        $tahun = $pecah[0];
        $date = $tahun . '-' . $bulan . '-01';
        $end = $tahun . '-' .  $bulan . '-' . date('t', strtotime($date));
        while (strtotime($date) <= strtotime($end)) {
            $day_num = date('d', strtotime($date));
            $date = date("Y-m-d", strtotime("+1 day", strtotime($date)));
            $tgl_en = $tahun . '-' . $bulan . '-' . $day_num;
            $tgl_in = $day_num . '-' . $bulan . '-' . date('Y');
            foreach ($karyawan as $d) {
                $row = $this->db->where(['idjadwal_detail' => $data['id_jadwal'], 'tanggal_detail' => $tgl_en, 'karyawan_detail' => $d['id_karyawan']])->get('jadwal_detail')->row_array();
        ?>
                <tr>
                    <td><?= $day_num . '-' . $bulan . '-' . $tahun; ?></td>
                    <td><?= $d['nama_karyawan'] ?></td>
                    <td><?= ucwords($row['shift_detail']) ?>
                        <input type="hidden" name="jadwal[<?= $tgl_en ?>][<?= $d['id_karyawan'] ?>][idjawal]" value="<?= $row['id_detail'] ?>">
                        <input type="hidden" name="jadwal[<?= $tgl_en ?>][<?= $d['id_karyawan'] ?>][kode]" value="<?= $d['id_karyawan'] ?>">
                        <input type="hidden" name="jadwal[<?= $tahun . '-' . $bulan . '-' . $day_num ?>][<?= $d['id_karyawan'] ?>][tanggal]" value="<?= $tgl_en ?>">
                    </td>
                    <td width="110px"><?= $row['jam_masuk'] ?></td>
                    <td width="110px"><?= $row['jam_keluar'] ?></td>
                </tr>
        <?php }
            $no++;
        } ?>
    </tbody>
</table>