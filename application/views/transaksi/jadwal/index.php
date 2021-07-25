<div class="row">
    <div class="col-xs-12">
        <div class="box box-default">
            <div class="box-header with-border">
                <?php if (level_user() != 2) : ?>
                    <a href="<?= site_url('jadwal/create') ?>" class="btn btn-social btn-flat btn-success btn-sm" title="Tambah"><i class="icon-plus3"></i> Tambah Jadwal</a>
                <?php else : ?>
                    <h3 class="box-title">Daftar Jadwal</h3>
                <?php endif ?>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center" width="40px" rowspan="2" style="vertical-align: middle;">No</th>
                            <th rowspan="2" style="vertical-align: middle;">Bulan</th>
                            <th colspan="6" class="text-center">Shift</th>
                            <th rowspan="2" style="vertical-align: middle;" class="text-center">Status</th>
                            <th class="text-center" rowspan="2" width="100px" style="vertical-align: middle;">Action</th>
                        </tr>
                        <tr>
                            <th class="text-center">Normal</th>
                            <th class="text-center">Dayoff</th>
                            <th class="text-center">Pagi</th>
                            <th class="text-center">Siang</th>
                            <th class="text-center">Sore</th>
                            <th class="text-center">Malam</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($data as $d) {
                            $pecah = explode("-", $d['bulan_jadwal']);
                            $bulan = bulan($pecah[1]);
                            $tahun = $pecah[0];
                            if (level_user() == 2) :
                                $count_normal = $this->db->from('jadwal_detail')->where(["DATE_FORMAT(tanggal_detail,'%Y-%m')" => $tahun . '-' . $pecah[1], 'shift_detail' => 'normal', 'idjadwal_detail' => $d['id_jadwal'], 'karyawan_detail' => id_user()])->count_all_results();
                                $count_dayoff = $this->db->from('jadwal_detail')->where(["DATE_FORMAT(tanggal_detail,'%Y-%m')" => $tahun . '-' . $pecah[1], 'shift_detail' => 'dayoff', 'idjadwal_detail' => $d['id_jadwal'], 'karyawan_detail' => id_user()])->count_all_results();
                                $count_pagi = $this->db->from('jadwal_detail')->where(["DATE_FORMAT(tanggal_detail,'%Y-%m')" => $tahun . '-' . $pecah[1], 'shift_detail' => 'pagi', 'idjadwal_detail' => $d['id_jadwal'], 'karyawan_detail' => id_user()])->count_all_results();
                                $count_siang = $this->db->from('jadwal_detail')->where(["DATE_FORMAT(tanggal_detail,'%Y-%m')" => $tahun . '-' . $pecah[1], 'shift_detail' => 'siang', 'idjadwal_detail' => $d['id_jadwal'], 'karyawan_detail' => id_user()])->count_all_results();
                                $count_sore = $this->db->from('jadwal_detail')->where(["DATE_FORMAT(tanggal_detail,'%Y-%m')" => $tahun . '-' . $pecah[1], 'shift_detail' => 'sore', 'idjadwal_detail' => $d['id_jadwal'], 'karyawan_detail' => id_user()])->count_all_results();
                                $count_malam = $this->db->from('jadwal_detail')->where(["DATE_FORMAT(tanggal_detail,'%Y-%m')" => $tahun . '-' . $pecah[1], 'shift_detail' => 'malam', 'idjadwal_detail' => $d['id_jadwal'], 'karyawan_detail' => id_user()])->count_all_results();
                            else :
                                $count_normal = $this->db->from('jadwal_detail')->where(["DATE_FORMAT(tanggal_detail,'%Y-%m')" => $tahun . '-' . $pecah[1], 'shift_detail' => 'normal', 'idjadwal_detail' => $d['id_jadwal']])->count_all_results();
                                $count_dayoff = $this->db->from('jadwal_detail')->where(["DATE_FORMAT(tanggal_detail,'%Y-%m')" => $tahun . '-' . $pecah[1], 'shift_detail' => 'dayoff', 'idjadwal_detail' => $d['id_jadwal']])->count_all_results();
                                $count_pagi = $this->db->from('jadwal_detail')->where(["DATE_FORMAT(tanggal_detail,'%Y-%m')" => $tahun . '-' . $pecah[1], 'shift_detail' => 'pagi', 'idjadwal_detail' => $d['id_jadwal']])->count_all_results();
                                $count_siang = $this->db->from('jadwal_detail')->where(["DATE_FORMAT(tanggal_detail,'%Y-%m')" => $tahun . '-' . $pecah[1], 'shift_detail' => 'siang', 'idjadwal_detail' => $d['id_jadwal']])->count_all_results();
                                $count_sore = $this->db->from('jadwal_detail')->where(["DATE_FORMAT(tanggal_detail,'%Y-%m')" => $tahun . '-' . $pecah[1], 'shift_detail' => 'sore', 'idjadwal_detail' => $d['id_jadwal']])->count_all_results();
                                $count_malam = $this->db->from('jadwal_detail')->where(["DATE_FORMAT(tanggal_detail,'%Y-%m')" => $tahun . '-' . $pecah[1], 'shift_detail' => 'malam', 'idjadwal_detail' => $d['id_jadwal']])->count_all_results();
                            endif;
                        ?>
                            <tr>
                                <td class="text-center"><?= $no ?></td>
                                <td><?= $bulan . ' ' . $tahun ?></td>
                                <td class="text-center"><?= $count_normal ?></td>
                                <td class="text-center"><?= $count_dayoff ?></td>
                                <td class="text-center"><?= $count_pagi ?></td>
                                <td class="text-center"><?= $count_siang ?></td>
                                <td class="text-center"><?= $count_sore ?></td>
                                <td class="text-center"><?= $count_malam ?></td>
                                <td class="text-center">
                                    <?= $d['status_jadwal'] == 0 ? '<span class="label status status-label status-pending">Pending</span>' : '<span class="label status status-label status-accepted">Approved</span>' ?>
                                </td>
                                <td class="text-center">
                                    <?php if (level_user() == 2) : ?>
                                        <a href="javascript:void(0)" onclick="view('<?= $d['id_jadwal'] ?>')"><i class="icon-eye8 text-blue"></i></a>
                                    <?php else : ?>
                                        <a href="<?= site_url('jadwal/detail/' . $d['id_jadwal']) ?>"><i class="icon-eye8 text-blue"></i></a>
                                        <a href="<?= site_url('jadwal/edit/' . $d['id_jadwal']) ?>"><i class="icon-pencil7 text-green"></i></a>
                                    <?php endif ?>
                                </td>
                            </tr>
                        <?php $no++;
                        } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div id="tampil_modal"></div>
<script>
    function view(kode) {
        $.ajax({
            url: BASE_URL + 'jadwal/view',
            type: "GET",
            data: {
                kode: kode
            },
            success: function(resp) {
                $("#tampil_modal").html(resp);
                $("#modal_alert").modal('show');
            }
        });
    }
</script>