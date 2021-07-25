<div class="row">
    <div class="col-xs-10 col-md-offset-1">
        <div class="box box-default">
            <div class="box-header with-border">
                <a href="<?= site_url('jadwal') ?>" class="btn btn-social btn-flat btn-default btn-sm" title="Kembali"><i class="fa fa-angle-double-left"></i> Kembali</a>
            </div>
            <?= form_open('jadwal/update', ['id' => 'form_create'], ['idjadwal' => $data['id_jadwal']]) ?>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
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
                                            <td>
                                                <input type="hidden" name="jadwal[<?= $tgl_en ?>][<?= $d['id_karyawan'] ?>][idjawal]" value="<?= $row['id_detail'] ?>">
                                                <input type="hidden" name="jadwal[<?= $tgl_en ?>][<?= $d['id_karyawan'] ?>][kode]" value="<?= $d['id_karyawan'] ?>">
                                                <input type="hidden" name="jadwal[<?= $tahun . '-' . $bulan . '-' . $day_num ?>][<?= $d['id_karyawan'] ?>][tanggal]" value="<?= $tgl_en ?>">
                                                <select name="jadwal[<?= $tgl_en ?>][<?= $d['id_karyawan'] ?>][shift]" class="form-control">
                                                    <option value="normal" <?= $row['shift_detail'] == 'normal' ? 'selected' : null ?>>Normal</option>
                                                    <option value="dayoff" <?= $row['shift_detail'] == 'dayoff' ? 'selected' : null ?>>Dayoff</option>
                                                    <option value="pagi" <?= $row['shift_detail'] == 'pagi' ? 'selected' : null ?>>Pagi</option>
                                                    <option value="siang" <?= $row['shift_detail'] == 'siang' ? 'selected' : null ?>>Siang</option>
                                                    <option value="sore" <?= $row['shift_detail'] == 'sore' ? 'selected' : null ?>>Sore</option>
                                                    <option value="malam" <?= $row['shift_detail'] == 'malam' ? 'selected' : null ?>>Malam</option>
                                                </select>
                                            </td>
                                            <td width="110px">
                                                <input type="text" name="jadwal[<?= $tgl_en ?>][<?= $d['id_karyawan'] ?>][masuk]" class="form-control" value="<?= $row['jam_masuk'] ?>">
                                            </td>
                                            <td width="110px">
                                                <input type="text" name="jadwal[<?= $tgl_en ?>][<?= $d['id_karyawan'] ?>][keluar]" class="form-control" value="<?= $row['jam_keluar'] ?>">
                                            </td>
                                        </tr>
                                <?php }
                                    $no++;
                                } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-success" id="store" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Loading..."><i class="icon-floppy-disk"></i> Simpan</button>
            </div>
            <?= form_close() ?>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#form_create').on('submit', function(event) {
            event.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                cache: false,
                beforeSend: function() {
                    $('#store').button('loading');
                },
                success: function(resp) {
                    if (resp.status == "0100") {
                        Swal.fire({
                            title: 'Sukses!',
                            text: resp.pesan,
                            icon: 'success'
                        }).then(okay => {
                            if (okay) {
                                window.location.href = "<?= site_url('jadwal') ?>";
                            }
                        });
                    } else {
                        $.each(resp.pesan, function(key, value) {
                            var element = $('#' + key);
                            element.closest('div.form-group')
                                .removeClass('has-error')
                                .addClass(value.length > 0 ? 'has-error' : 'has-success')
                                .find('.help-block')
                                .remove();
                            element.after(value);
                        });
                    }
                },
                complete: function() {
                    $('#store').button('reset');
                }
            })
        });
    });
</script>