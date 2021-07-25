<div class="row">
    <div class="col-xs-10 col-md-offset-1">
        <div class="box box-default">
            <div class="box-header with-border">
                <a href="<?= site_url('jadwal') ?>" class="btn btn-social btn-flat btn-default btn-sm" title="Kembali"><i class="fa fa-angle-double-left"></i> Kembali</a>
            </div>
            <div class="box-body">
                <?php if ($data['note_jadwal'] != null) : ?>
                    <blockquote>
                        <p><?= $data['note_jadwal'] ?></p>
                    </blockquote>
                <?php endif ?>
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
                    </div>
                </div>
            </div>
            <?php if (level_user() == 3) : ?>
                <div class="box-footer text-center">
                    <button type="button" class="btn btn-danger" onclick="notife('<?= $data['id_jadwal'] ?>')"><i class="icon-clipboard6"></i> Tambahkan catatan untuk pemberitahuan</button>
                    <?php if ($data['status_jadwal'] == 0) { ?>
                        <button type="button" class="btn btn-success" id="store" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Loading..." onclick="validasi('<?= $data['id_jadwal'] ?>','<?= $data['status_jadwal'] ?>')"><i class="icon-checkmark-circle"></i> Validasi Jadwal</button>
                        <a href="<?= site_url('jadwal/cetak/' . $bulan . '/' . $tahun) ?>" target="_blank" class="btn bg-purple"><i class="icon-printer2"></i> Cetak Jadwal</a>
                    <?php } else { ?>
                        <button type="button" class="btn btn-warning" id="store" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Loading..." onclick="validasi('<?= $data['id_jadwal'] ?>','<?= $data['status_jadwal'] ?>')"><i class="icon-cancel-circle2"></i> Batal Validasi Jadwal</button>
                    <?php } ?>
                </div>
            <?php endif ?>
        </div>
    </div>
</div>
<div id="tampil_modal"></div>
<?php if (level_user() == 3) : ?>
    <script>
        function notife(kode) {
            $.ajax({
                url: BASE_URL + 'jadwal/notife',
                type: "GET",
                data: {
                    kode: kode
                },
                success: function(resp) {
                    $("#tampil_modal").html(resp);
                    $("#modal_create").modal('show');
                }
            });
        }

        function validasi(kode, status) {
            $.ajax({
                url: BASE_URL + 'jadwal/validasi',
                type: "GET",
                dataType: 'json',
                data: {
                    kode: kode,
                    status: status
                },
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
                        Swal.fire('Gagal!', resp.pesan, 'error');
                    }
                },
                complete: function() {
                    $('#store').button('reset');
                }
            });
        }

        $(document).on('submit', '.form_create', function(e) {
            e.preventDefault();
            $.ajax({
                type: "post",
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: "json",
                cache: false,
                beforeSend: function() {
                    $('.store_data').button('loading');
                },
                success: function(resp) {
                    $("#modal_create").modal('hide');
                },
                complete: function() {
                    $('.store_data').button('reset');
                }
            });
            return false;
        });
    </script>
<?php endif ?>