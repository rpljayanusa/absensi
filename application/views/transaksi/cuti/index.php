<div class="row">
    <div class="col-xs-12">
        <div class="box box-default">
            <div class="box-header with-border">
                <button class="btn btn-social btn-flat btn-success btn-sm" title="Tambah Data" onclick="create()"><i class="icon-plus3"></i> Tambah Data</button>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-bordered table-striped data_pasien" id="table">
                    <thead>
                        <tr>
                            <th class="text-center">Action</th>
                            <th>Karyawan</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Jenis Cuti</th>
                            <th>Dari Tgl</th>
                            <th>Sampai Tgl</th>
                            <th>Alasan</th>
                            <th class="text-center">Status</th>
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
    $(document).ready(function() {
        load_data();
    });

    function load_data() {
        $.ajax({
            url: BASE_URL + 'cuti/data',
            method: "POST",
            data: {
                action: 'fetch_data'
            },
            dataType: 'json',
            success: function(data) {
                var html = '';
                if (data == 0) {
                    html += '<tr>';
                    html += '<td colspan="7">Belum ada data</td>';
                    html += '</tr>';
                } else {
                    for (var count = 0; count < data.length; count++) {
                        html += '<tr>';
                        html += '<td class="text-center" width="100px">';
                        html += '<a href="javascript:void(0)" onclick="detail(' + data[count].id + ')"><i class="icon-eye8 text-black"></i></a>';
                        html += '&nbsp;';
                        html += '<a href="javascript:void(0)" onclick="edit(' + data[count].id + ')"><i class="icon-pencil7 text-green"></i></a>';
                        html += '&nbsp;';
                        html += '<a href="javascript:void(0)" onclick="destroy(' + data[count].id + ')"><i class="icon-trash text-red"></i></a>';
                        html += '</td>';
                        html += '<td>' + data[count].nama + '</td>';
                        html += '<td>' + data[count].tanggal + '</td>';
                        html += '<td>' + data[count].jenis + '</td>';
                        html += '<td>' + data[count].mulai + '</td>';
                        html += '<td>' + data[count].selesai + '</td>';
                        html += '<td>' + data[count].alasan + '</td>';
                        html += '<td>' + data[count].status + '</td>';
                        html += '</tr>';
                    }
                }
                $('tbody').html(html);
            }
        })
    }

    function create() {
        $.ajax({
            url: BASE_URL + 'cuti/create',
            type: "GET",
            success: function(resp) {
                $("#tampil_modal").html(resp);
                $("#modal_create").modal('show');
            }
        });
    }

    function edit(kode) {
        $.ajax({
            url: BASE_URL + 'cuti/edit',
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

    function destroy(kode) {
        Swal.fire({
            title: "Apakah kamu yakin?",
            text: "Anda tidak akan dapat mengembalikan ini!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "Ya, hapus data ini"
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "POST",
                    url: BASE_URL + 'cuti/destroy',
                    data: {
                        kode: kode
                    },
                    dataType: "json",
                    success: function(resp) {
                        if (resp.status == "0100") {
                            Swal.fire({
                                title: 'Deleted!',
                                text: resp.message,
                                icon: 'success'
                            }).then((resp) => {
                                load_data();
                            })
                        } else {
                            Swal.fire('Oops...', resp.message, 'error');
                        }
                    }
                });
            }
        })
    }

    function detail(kode) {
        $.ajax({
            url: BASE_URL + 'cuti/detail',
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

    function validasiApprove(kode, jenis) {
        $.ajax({
            url: BASE_URL + 'cuti/validasi',
            type: "GET",
            dataType: 'json',
            data: {
                kode: kode,
                jenis: jenis
            },
            beforeSend: function() {
                $('#store_approve').button('loading');
            },
            success: function(resp) {
                if (resp.status == "0100") {
                    Swal.fire({
                        title: 'Sukses!',
                        text: resp.pesan,
                        icon: 'success'
                    }).then(okay => {
                        if (okay) {
                            $("#modal_alert").modal('hide');
                            load_data();
                        }
                    });
                }
            },
            complete: function() {
                $('#store_approve').button('reset');
            }
        });
    }

    function validasiPending(kode, jenis) {
        $.ajax({
            url: BASE_URL + 'cuti/validasi',
            type: "GET",
            dataType: 'json',
            data: {
                kode: kode,
                jenis: jenis
            },
            beforeSend: function() {
                $('#store_pending').button('loading');
            },
            success: function(resp) {
                if (resp.status == "0100") {
                    Swal.fire({
                        title: 'Sukses!',
                        text: resp.pesan,
                        icon: 'success'
                    }).then(okay => {
                        if (okay) {
                            $("#modal_alert").modal('hide');
                            load_data();
                        }
                    });
                }
            },
            complete: function() {
                $('#store_pending').button('reset');
            }
        });
    }

    function jeniscuti() {
        var start = $('#start').val();
        var end = $('#end').val();
        var jenis = $('#jenis').val();
        console.log(jenis);
        $.ajax({
            url: BASE_URL + 'cuti/jeniscuti',
            type: "GET",
            data: {
                start: start,
                end: end,
                jenis: jenis
            },
            success: function(resp) {
                $("#pesan").html(resp);
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
                if (resp.status == "0100") {
                    if (resp.jenis == "tahunan") {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: resp.pesan
                        })
                    } else {
                        Swal.fire({
                            title: 'Sukses!',
                            text: resp.pesan,
                            icon: 'success'
                        }).then(okay => {
                            if (okay) {
                                $("#modal_create").modal('hide');
                                load_data();
                            }
                        });
                    }
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
        });
        return false;
    });
</script>