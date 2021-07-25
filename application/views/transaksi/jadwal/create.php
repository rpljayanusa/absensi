<div class="row">
    <div class="col-xs-10 col-md-offset-1">
        <div class="box box-default">
            <div class="box-header with-border">
                <a href="<?= site_url('jadwal') ?>" class="btn btn-social btn-flat btn-default btn-sm" title="Kembali"><i class="fa fa-angle-double-left"></i> Kembali</a>
            </div>
            <?= form_open('jadwal/store', ['id' => 'form_create']) ?>
            <div class="box-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="required">Bulan</label>
                            <select name="bulan" id="bulan" class="form-control" onchange="data_karyawan();return false;">
                                <option value="">Pilih</option>
                                <?php foreach (fetch_bulan() as $list => $value) { ?>
                                    <option value="<?= $list ?>" <?= date('m') == $list ? 'selected' : null ?>><?= $value ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div id="data_karyawan"></div>
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
        data_karyawan();
    });

    function data_karyawan() {
        $('#data_karyawan').html('<p class="text-center m-t-0 m-b-2 text-warning"><b><i class="fa fa-refresh animation-rotate"></i> Loading...</b></p>');
        var bulan = $('#bulan').val();
        $.ajax({
            url: '<?= site_url('jadwal/create-karyawan') ?>',
            method: 'GET',
            data: {
                bulan: bulan
            },
            success: function(resp) {
                $("#data_karyawan").html(resp);
            }
        });
    }

    function shift(no) {
        var nomor = $('#jadwal' + no).val();
        console.log(nomor);
        if (nomor == "normal") {
            $('#in' + no).val('08:00');
            $('#out' + no).val('16:00');
        } else if (nomor == "dayoff") {
            $('#in' + no).val('00:00');
            $('#out' + no).val('00:00');
        } else if (nomor == "pagi") {
            $('#in' + no).val('07:00');
            $('#out' + no).val('14:00');
        } else if (nomor == "siang") {
            $('#in' + no).val('14:00');
            $('#out' + no).val('21:00');
        } else if (nomor == "sore") {
            $('#in' + no).val('15:00');
            $('#out' + no).val('21:00');
        } else if (nomor == "malam") {
            $('#in' + no).val('21:00');
            $('#out' + no).val('07:00');
        }
    }

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
                        Swal.fire({
                            title: 'Gagal!',
                            text: resp.pesan,
                            icon: 'error'
                        }).then(okay => {
                            if (okay) {
                                window.location.href = "<?= site_url('jadwal/create') ?>";
                            }
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