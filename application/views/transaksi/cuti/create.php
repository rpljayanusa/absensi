<div id="pesan"></div>
<div class="form-group">
    <label class="required">Dari Tanggal</label>
    <input type="date" name="start" id="start" class="form-control" onchange="jeniscuti()">
</div>
<div class="form-group">
    <label class="required">Sampai Tanggal</label>
    <input type="date" name="end" id="end" class="form-control" onchange="jeniscuti()">
</div>
<div class="form-group">
    <label class="required">Jenis Cuti</label>
    <select name="jenis" id="jenis" class="form-control" onchange="jeniscuti()">
        <option value="">-- Pilih --</option>
        <?php foreach ($jenis as $j) { ?>
            <option value="<?= $j['id_jenis'] ?>"><?= $j['nama_jenis'] ?></option>
        <?php } ?>
    </select>
</div>
<div class="form-group">
    <label class="required">Keterangan Cuti</label>
    <textarea name="note" id="note" class="form-control" rows="5"></textarea>
</div>