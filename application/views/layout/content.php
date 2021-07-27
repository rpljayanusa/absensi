<?php if (level_user() == 2) { ?>
    <div class="row">
        <div class="col-md-3">
            <div class="box box-widget">
                <div class="box-body box-profile">
                    <h3 class="profile-username text-center">Jadwal Anda Hari Ini</h3>
                    <?php if($jadwal==null) : ?>
                        <p class="text-muted text-center">Jadwal Anda hari ini tidak ada</p>
                    <?php else : ?>
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Tanggal</b> <a class="pull-right"><?= format_indo($jadwal['tanggal_detail']) ?></a>
                        </li>
                        <li class="list-group-item">
                            <b>Shift</b> <a class="pull-right"><?= $jadwal['shift_detail'] ?></a>
                        </li>
                        <li class="list-group-item">
                            <b>Check In</b> <a class="pull-right"><?= $jadwal['jam_masuk'] ?></a>
                        </li>
                        <li class="list-group-item">
                            <b>Check Out</b> <a class="pull-right"><?= $jadwal['jam_keluar'] ?></a>
                        </li>
                    </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="box box-widget">
                <div class="box-body box-profile">
                    <h3 class="profile-username text-center">Cuti Tahunan</h3>
                    <?php $terpakai = 0;
                    foreach ($tahunan as $t) {
                        $awal  = date_create($t['mulai_cuti']);
                        $akhir = date_create($t['selesai_cuti']);
                        $diff  = date_diff($awal, $akhir);
                        $jumlah = $diff->d + 1;
                        $terpakai = $terpakai + $jumlah;
                    } ?>
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Total</b> <a class="pull-right">12</a>
                        </li>
                        <li class="list-group-item">
                            <b>Digunakan</b> <a class="pull-right"><?= $terpakai ?></a>
                        </li>
                        <li class="list-group-item">
                            <b>Sisa</b> <a class="pull-right"><?= 12 - $terpakai ?></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <?php if (jenkel() == 2) { ?>
        <div class="col-md-3">
            <div class="box box-widget">
                <div class="box-body box-profile">
                    <h3 class="profile-username text-center">Cuti Melahirkan</h3>
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Digunakan</b> <a class="pull-right"><?= $lahir['total'] ?></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    <?php } ?>
        <!-- <div class="col-md-3">
            <div class="box box-widget">
                <div class="box-body box-profile">
                    <h3 class="profile-username text-center">Lainnya</h3>
                    <ul class="list-group list-group-unbordered">
                        <li class="list-group-item">
                            <b>Digunakan</b> <a class="pull-right"><?= $other['total'] ?></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div> -->
<?php } ?>