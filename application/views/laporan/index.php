<div class="row">
    <div class="col-md-4">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Data Karyawan</h3>
            </div>
            <div class="box-body">
                <a href="<?= site_url('laporan/karyawan') ?>" target="_blank" class="btn bg-purple">Cetak Laporan Data Karyawan</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Data Unit Kerja</h3>
            </div>
            <div class="box-body">
                <a href="<?= site_url('laporan/unit') ?>" target="_blank" class="btn bg-purple">Cetak Daftar Unit Kerja</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Data Jabatan</h3>
            </div>
            <div class="box-body">
                <a href="<?= site_url('laporan/jabatan') ?>" target="_blank" class="btn bg-purple">Cetak Daftar Jabatan</a>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Data Jadwal</h3>
            </div>
            <form method="POST" action="<?= site_url('laporan/jadwal/perbulan') ?>" target="_blank">
                <div class="box-body">
                    <div class="form-group">
                        <label>Pilih Bulan</label>
                        <select class="form-control" name="bulan">
                            <option value="">-- Pilih Bulan --</option>
                            <?php foreach (fetch_bulan() as $list => $value) { ?>
                                <option value="<?= $list ?>"><?= $value ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Pilih Tahun</label>
                        <select class="form-control" name="tahun">
                            <option value="">-- Pilih Tahun --</option>
                            <?php
                            $now = date('Y');
                            for ($a = 2020; $a <= $now; $a++) {
                                echo "<option value='$a'>$a</option>";
                            } ?>
                        </select>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn bg-purple">Cetak Penjadwalan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-4">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Data Absensi</h3>
            </div>
            <form method="POST" action="<?= site_url('laporan/absensi/perbulan') ?>" target="_blank">
                <div class="box-body">
                    <div class="form-group">
                        <label>Pilih Bulan</label>
                        <select class="form-control" name="bulan">
                            <option value="">-- Pilih Bulan --</option>
                            <?php
                            $nama_bln = array(1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
                            for ($bln = 1; $bln <= 12; $bln++) {
                                echo "<option value=$bln>$nama_bln[$bln]</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Pilih Tahun</label>
                        <select class="form-control" name="tahun">
                            <option value="">-- Pilih Tahun --</option>
                            <?php
                            $now = date('Y');
                            for ($a = 2020; $a <= $now; $a++) {
                                echo "<option value='$a'>$a</option>";
                            } ?>
                        </select>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn bg-purple">Cetak Laporan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-4">
        <div class="box box-primary box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Cuti Karyawan</h3>
            </div>
            <form method="POST" action="<?= site_url('laporan/cuti/perbulan') ?>" target="_blank">
                <div class="box-body">
                    <div class="form-group">
                        <label>Pilih Bulan</label>
                        <select class="form-control" name="bulan">
                            <option value="">-- Pilih Bulan --</option>
                            <?php
                            $nama_bln = array(1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
                            for ($bln = 1; $bln <= 12; $bln++) {
                                echo "<option value=$bln>$nama_bln[$bln]</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Pilih Tahun</label>
                        <select class="form-control" name="tahun">
                            <option value="">-- Pilih Tahun --</option>
                            <?php
                            $now = date('Y');
                            for ($a = 2020; $a <= $now; $a++) {
                                echo "<option value='$a'>$a</option>";
                            } ?>
                        </select>
                    </div>
                    <div class="box-footer">
                        <button type="submit" class="btn bg-purple">Cetak Laporan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>