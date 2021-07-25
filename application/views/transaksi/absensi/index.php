<div class="row">
    <div class="col-xs-12">
        <div class="box box-default">
            <div class="box-header with-border">
                <button class="btn btn-social btn-flat btn-success btn-sm" title="Tambah Data" onclick="upload()"><i class="icon-plus3"></i> Upload Absensi</button>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-bordered table-striped data_absensi" id="table">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Action</th>
                            <th>Karyawan</th>
                            <th>ID Karyawan</th>
                            <th>Tanggal</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div id="tampil_modal"></div>
<script>
    $(".data_absensi").DataTable({
        ordering: false,
        processing: true,
        serverSide: true,
        ajax: {
            url: "<?= base_url('absensi/data') ?>",
            type: 'GET',
        },
        "columns": [{
                "class": "text-center"
            },
            {
                "class": "text-center"
            },
            {
                "class": "text-left"
            },
            {
                "class": "text-left"
            },
            {
                "class": "text-left"
            },
            {
                "class": "text-left"
            },
            {
                "class": "text-left"
            }
        ]
    });

    function upload() {
        $.ajax({
            url: BASE_URL + 'absensi/upload',
            type: "GET",
            success: function(resp) {
                $("#tampil_modal").html(resp);
                $("#modal_create").modal('show');
            }
        });
    }

    function detail(kode) {
        $.ajax({
            url: BASE_URL + 'absensi/detail',
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

    $(document).on('submit', '.form_create', function(e) {
        event.preventDefault();
        var formData = new FormData($(".form_create")[0]);
        $.ajax({
            url: $(".form_create").attr('action'),
            dataType: 'json',
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $('.store_data').button('loading');
            },
            success: function(resp) {
                console.log(resp);
                if (resp.status == "0100") {
                    Swal.fire({
                        title: 'Sukses!',
                        text: resp.pesan,
                        icon: 'success'
                    }).then(okay => {
                        if (okay) {
                            $("#modal_create").modal('hide');
                            var DataTabel = $('.data_absensi').DataTable();
                            DataTabel.ajax.reload();
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
                $('.store_data').button('reset');
            }
        })
    });
</script>