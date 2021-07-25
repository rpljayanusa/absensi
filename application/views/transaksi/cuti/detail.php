<table class="table">
    <tr>
        <th>Karyawan</th>
        <td><?= $data['nama_karyawan'] ?></td>
    </tr>
    <tr>
        <th>Jenis Cuti</th>
        <td><?= $data['nama_jenis'] ?></td>
    </tr>
    <tr>
        <th>Tanggal Pengajuan</th>
        <td><?= format_biasa($data['tgl_pengajuan']) ?></td>
    </tr>
    <tr>
        <th>Dari Tanggal</th>
        <td><?= format_biasa($data['mulai_cuti']) ?></td>
    </tr>
    <tr>
        <th>Sampai Tanggal</th>
        <td><?= format_biasa($data['selesai_cuti']) ?></td>
    </tr>
    <tr>
        <th>Alasan</th>
        <td><?= $data['alasan_cuti'] ?></td>
    </tr>
    <tr>
        <td colspan="2" class="text-center">
            <?php if (level_user() == 1) :
                if ($data['status_cuti'] == 0 or $data['status_cuti'] == 1 or $data['status_cuti'] == 2) : ?>
                    <button type="button" class="btn btn-success" id="store_approve" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Loading..." onclick="validasiApprove('<?= $data['id_cuti'] ?>','approve')"><i class="icon-checkmark-circle"></i> Setujui Pengajuan Cuti</button>
                    <button type="button" class="btn btn-danger" id="store_pending" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Loading..." onclick="validasiPending('<?= $data['id_cuti'] ?>','pending')"><i class="icon-cancel-circle2"></i> Batal Pengajuan Cuti</button>
                <?php elseif ($data['status_cuti'] == 3) : ?>
                    <span class="text-red">Tidak Disetujui Pimpinan</span>
                <?php elseif ($data['status_cuti'] == 4) : ?>
                    <span class="text-green">Disetujui Pimpinan</span>
                <?php endif ?>
            <?php elseif (level_user() == 3) : ?>
                <?php if ($data['status_cuti'] == 0) : ?>
                    <span class="text-red">Belum Disetujui Admin</span>
                <?php elseif ($data['status_cuti'] == 1) : ?>
                    <span class="text-red">Tidak Disetujui Admin</span>
                <?php else : ?>
                    <button type="button" class="btn btn-success" id="store_approve" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Loading..." onclick="validasiApprove('<?= $data['id_cuti'] ?>','approve')"><i class="icon-checkmark-circle"></i> Setujui Pengajuan Cuti</button>
                    <button type="button" class="btn btn-danger" id="store" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Loading..." onclick="validasi('<?= $data['id_cuti'] ?>','pending')"><i class="icon-cancel-circle2"></i> Batal Pengajuan Cuti</button>
                <?php endif ?>
            <?php endif ?>
        </td>
    </tr>
</table>