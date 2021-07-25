<div class="form-group">
    <label class="required">ID Absen</label>
    <input type="text" name="idabsen" id="idabsen" class="form-control">
</div>
<div class="form-group">
    <label class="required">Nama</label>
    <input type="text" name="nama" id="nama" class="form-control">
</div>
<div class="form-group">
    <label class="required">Tempat Lahir</label>
    <input type="text" name="tempat_lahir" id="tempat_lahir" class="form-control">
</div>
<div class="form-group">
    <label class="required">Tanggal Lahir</label>
    <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control">
</div>
<div class="form-group">
    <label class="required">Jenis Kelamin</label>
    <select name="jenkel" id="jenkel" class="form-control">
        <option value="">--Pilih--</option>
        <option value="1">Laki-laki</option>
        <option value="2">Perempuan</option>
    </select>
</div>
<div class="form-group">
    <label class="control-label">Agama</label>
    <select name="agama" id="agama" class="form-control">
        <option value="">--Pilih--</option>
        <option value="Islam">Islam</option>
        <option value="Kristen">Kristen</option>
        <option value="Hindu">Hindu</option>
        <option value="Budha">Budha</option>
    </select>
</div>
<div class="form-group">
    <label class="required">Status Pernikahan</label>
    <select name="status_nikah" id="status_nikah" class="form-control">
        <option value="">--Pilih--</option>
        <option value="0">Belum Menikah</option>
        <option value="1">Menikah</option>
    </select>
</div>
<div class="form-group">
    <label class="required">No. HP</label>
    <input type="text" name="phone" id="phone" class="form-control">
</div>
<div class="form-group">
    <label class="required">Jabatan</label>
    <select name="jabatan" id="jabatan" class="form-control">
        <option value="">--Pilih--</option>
        <?php foreach ($jabatan as $j) { ?>
            <option value="<?= $j['id_jabatan'] ?>"><?= $j['nama_jabatan'] ?></option>
        <?php } ?>
    </select>
</div>
<div class="form-group">
    <label class="required">Unit Kerja</label>
    <select name="unit" id="unit" class="form-control">
        <option value="">--Pilih--</option>
        <?php foreach ($unit as $u) { ?>
            <option value="<?= $u['id_unit'] ?>"><?= $u['nama_unit'] ?></option>
        <?php } ?>
    </select>
</div>
<div class="form-group">
    <label class="required">Tanggal Masuk</label>
    <input type="date" name="masuk" id="masuk" class="form-control">
</div>
<div class="form-group">
    <label class="required">Status Karyawan</label>
    <select name="status" id="status" class="form-control">
        <option value="">--Pilih--</option>
        <option value="0">Tidak Aktif</option>
        <option value="1">Permanen</option>
        <option value="2">Kontrak</option>
    </select>
</div>
<div class="form-group">
    <label class="required">Username</label>
    <input type="text" name="username" id="username" class="form-control">
</div>
<div class="form-group">
    <label class="required">Password</label>
    <input type="password" name="password" id="password" class="form-control">
</div>
<div class="form-group">
    <label class="required">Level</label>
    <select name="level" id="level" class="form-control">
        <option value="">--Pilih--</option>
        <option value="1">Admin</option>
        <option value="2">Karyawan</option>
        <option value="3">Pimpinan</option>
    </select>
</div>