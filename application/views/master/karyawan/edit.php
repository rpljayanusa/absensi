<input type="hidden" name="kode" value="<?= $data['id_karyawan'] ?>">
<div class="form-group">
    <label class="required">ID Absen</label>
    <input type="text" name="idabsen" id="idabsen" class="form-control" value="<?= $data['idabsen_karyawan'] ?>">
</div>
<div class="form-group">
    <label class="required">Nama</label>
    <input type="text" name="nama" id="nama" class="form-control" value="<?= $data['nama_karyawan'] ?>">
</div>
<div class="form-group">
    <label class="required">Tempat Lahir</label>
    <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control" value="<?= $data['tempat_lahir'] ?>">
</div>
<div class="form-group">
    <label class="required">Tanggal Lahir</label>
    <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control" value="<?= $data['tanggal_lahir'] ?>">
</div>
<div class="form-group">
    <label class="required">Jenis Kelamin</label>
    <select name="jenkel" id="jenkel" class="form-control">
        <option value="">--Pilih--</option>
        <option value="1" <?= $data['jenkel_karyawan'] == 1 ? 'selected' : null ?>>Laki-laki</option>
        <option value="2" <?= $data['jenkel_karyawan'] == 2 ? 'selected' : null ?>>Perempuan</option>
    </select>
</div>
<div class="form-group">
    <label class="control-label">Agama</label>
    <select name="agama" id="agama" class="form-control">
        <option value="">--Pilih--</option>
        <option value="Islam" <?= $data['agama_karyawan'] == 'Islam' ? 'selected' : null ?>>Islam</option>
        <option value="Kristen" <?= $data['agama_karyawan'] == 'Kristen' ? 'selected' : null ?>>Kristen</option>
        <option value="Hindu" <?= $data['agama_karyawan'] == 'Hindu' ? 'selected' : null ?>>Hindu</option>
        <option value="Budha" <?= $data['agama_karyawan'] == 'Budha' ? 'selected' : null ?>>Budha</option>
    </select>
</div>
<div class="form-group">
    <label class="required">Status Pernikahan</label>
    <select name="status_nikah" id="status_nikah" class="form-control">
        <option value="">--Pilih--</option>
        <option value="0" <?= $data['status_nikah'] == 0 ? 'selected' : null ?>>Belum Menikah</option>
        <option value="1" <?= $data['status_nikah'] == 1 ? 'selected' : null ?>>Menikah</option>
    </select>
</div>
<div class="form-group">
    <label class="required">No. HP</label>
    <input type="text" name="phone" id="phone" class="form-control" value="<?= $data['phone_karyawan'] ?>">
</div>
<div class="form-group">
    <label class="required">Jabatan</label>
    <select name="jabatan" id="jabatan" class="form-control">
        <option value="">--Pilih--</option>
        <?php foreach ($jabatan as $j) { ?>
            <option value="<?= $j['id_jabatan'] ?>" <?= $data['jabatan_karyawan'] == $j['id_jabatan'] ? 'selected' : null ?>><?= $j['nama_jabatan'] ?></option>
        <?php } ?>
    </select>
</div>
<div class="form-group">
    <label class="required">Unit Kerja</label>
    <select name="unit" id="unit" class="form-control">
        <option value="">--Pilih--</option>
        <?php foreach ($unit as $u) { ?>
            <option value="<?= $u['id_unit'] ?>" <?= $data['unit_karyawan'] == $u['id_unit'] ? 'selected' : null ?>><?= $u['nama_unit'] ?></option>
        <?php } ?>
    </select>
</div>
<div class="form-group">
    <label class="required">Tanggal Masuk</label>
    <input type="date" name="masuk" id="masuk" class="form-control" value="<?= $data['tanggal_masuk'] ?>">
</div>
<div class="form-group">
    <label class="required">Status Karyawan</label>
    <select name="status" id="status" class="form-control">
        <option value="">--Pilih--</option>
        <option value="0" <?= $data['status_karyawan'] == 0 ? 'selected' : null ?>>Tidak Aktif</option>
        <option value="1" <?= $data['status_karyawan'] == 1 ? 'selected' : null ?>>Permanen</option>
        <option value="2" <?= $data['status_karyawan'] == 2 ? 'selected' : null ?>>Kontrak</option>
    </select>
</div>
<div class="form-group">
    <label class="required">Username</label>
    <input type="text" name="username" id="username" class="form-control" value="<?= $data['username'] ?>">
</div>
<div class="form-group">
    <label class="required">Password</label>
    <input type="password" name="password" id="password" class="form-control">
    <span class="help-block">Kosongkan jika tidak rubah password.</span>
</div>
<div class="form-group">
    <label class="required">Level</label>
    <select name="level" id="level" class="form-control">
        <option value="">--Pilih--</option>
        <option value="1" <?= $data['level_karyawan'] == 1 ? 'selected' : null ?>>Admin</option>
        <option value="2" <?= $data['level_karyawan'] == 2 ? 'selected' : null ?>>Karyawan</option>
        <option value="3" <?= $data['level_karyawan'] == 3 ? 'selected' : null ?>>Pimpinan</option>
    </select>
</div>