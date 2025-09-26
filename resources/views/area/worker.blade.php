@extends('area._base')
@push('head')
@endpush
@section('content')
    <div class="card ">
        <div class="card-header">
            <h4>Data Worker</h4>
            <div class="card-header-action">
                <button href="#" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modal_add"><i class="fas fa-plus"></i> Tambah</button>
            </div>
        </div>
        <div class="card-body">
            <div class="row mb-2">
                <div class="col-lg-2">
                    <input type="text" id="search_filter" class="form-control" placeholder="Search..." />
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped" id="table-1" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Foto</th>
                            <th>Nama</th>
                            <th>Handphone</th>
                            <th>Jenis Kelamin</th>
                            <th>Asal</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Hex Color</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('modal')
    {{-- modal add --}}
    <div class="modal fade" id="modal_add" role="dialog" aria-labelledby="formModal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModal">Tambah Worker</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form_add">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Fullname</label>
                                    <input type="text" class="form-control" name="fullname" id="fullname_add">
                                    <div id="error_fullname_add" class="invalid-feedback"></div>
                                </div>
                                <div class="form-group">
                                    <label>Handphone</label>
                                    <input type="text" class="form-control" name="handphone" id="handphone_add">
                                    <div id="error_handphone_add" class="invalid-feedback"></div>
                                </div>
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select name="jk" id="jk_add" class="form-control">
                                        <option></option>
                                        <option value="Pria">Pria</option>
                                        <option value="Wanita">Wanita</option>
                                    </select>
                                    <div id="error_jk_add" class="invalid-feedback"></div>
                                </div>
                                <div class="form-group">
                                    <label>Asal</label>
                                    <input type="text" class="form-control" name="asal" id="asal_add">
                                    <div id="error_asal_add" class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control" name="username" id="username_add">
                                    <div id="error_username_add" class="invalid-feedback"></div>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control" name="email" id="email_add">
                                    <div id="error_email_add" class="invalid-feedback"></div>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="text" class="form-control" name="password" id="password_add">
                                    <div id="error_password_add" class="invalid-feedback"></div>
                                </div>
                                <div class="form-group">
                                    <label>Hex Color</label>
                                    <input type="color" class="form-control" name="hex" id="hex_add">
                                    <div id="error_hex_add" class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" id="btn_add" class="btn btn-primary m-t-15 waves-effect">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- modal add --}}
    {{-- modal edit --}}
    <div class="modal fade" id="modal_edit" role="dialog" aria-labelledby="formModal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModal">Edit Profil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form_edit">
                        <input type="hidden" name="id" id="id_edit">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Fullname</label>
                                    <input type="text" class="form-control" name="fullname" id="fullname_edit">
                                    <div id="error_fullname_edit" class="invalid-feedback"></div>
                                </div>
                                <div class="form-group">
                                    <label>Handphone</label>
                                    <input type="text" class="form-control" name="handphone" id="handphone_edit">
                                    <div id="error_handphone_edit" class="invalid-feedback"></div>
                                </div>
                                <div class="form-group">
                                    <label>Jenis Kelamin</label>
                                    <select name="jk" id="jk_edit" class="form-control">
                                        <option></option>
                                        <option value="Pria">Pria</option>
                                        <option value="Wanita">Wanita</option>
                                    </select>
                                    <div id="error_jk_edit" class="invalid-feedback"></div>
                                </div>
                                <div class="form-group">
                                    <label>Asal</label>
                                    <input type="text" class="form-control" name="asal" id="asal_edit">
                                    <div id="error_asal_edit" class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" class="form-control" name="username" id="username_edit">
                                    <div id="error_username_edit" class="invalid-feedback"></div>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control" name="email" id="email_edit">
                                    <div id="error_email_edit" class="invalid-feedback"></div>
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="text" class="form-control" name="password" id="password_edit">
                                    <span style="font-size: 10px" class="text-muted">*kosongkan bila tidak ingin mengganti password</span>
                                    <div id="error_password_edit" class="invalid-feedback"></div>
                                </div>
                                <div class="form-group">
                                    <label>Hex Color</label>
                                    <input type="color" class="form-control" name="hex" id="hex_edit">
                                    <div id="error_hex_edit" class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <button type="submmit" id="btn_edit" class="btn btn-primary m-t-15 waves-effect">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- modal edit --}}
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            $('#jk_add').select2({
                width: '100%',
                placeholder: 'Pilih',
            });

            $('#jk_edit').select2({
                width: '100%',
                placeholder: 'Pilih',
            });
        });

        var datatable = $("#table-1").DataTable({
            "dom": "<'dt--top-section'>" +
                "<''tr>" +
                "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--length-info d-flex justify-content-center align-middle 'l<'dt--pages-count ml-1'i>><'dt--pagination mt-sm-0 mt-3'p>>",
            "oLanguage": {
                "sLengthMenu": "_MENU_",
            },
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ url('worker/list-active') }}',
            },
            columns: [{
                "data": "DT_RowIndex",
                "name": "DT_RowIndex",
                "orderable": false,
                "searchable": false
            }, {
                "orderable": false,
                "searchable": false,
                "data": null,
                "render": function(data, type, row, meta) {
                    var img = '{{ asset('') }}' + row.img;
                    var html = '<img src="' + row.img + '" style="width:50px">';
                    return html;
                },
            }, {
                data: 'fullname',
                name: 'fullname',
            }, {
                data: 'handphone',
                name: 'handphone',

            }, {
                data: 'jk',
                name: 'jk',
            }, {
                data: 'asal',
                name: 'asal',
            }, {
                data: 'username',
                name: 'username',
            }, {
                data: 'email',
                name: 'email',
            }, {
                "orderable": false,
                "searchable": false,
                data: 'hex',
                name: 'hex',
                "render": function(data, type, row, meta) {
                    var html = '<div style="width:100px;height:10px;background-color:' + data + ';"></div>';

                    return html;
                },
            }, {
                "orderable": false,
                "searchable": false,
                "data": null,
                "render": function(data, type, row, meta) {
                    var url_detail = '{{ asset('worker/detail') }}/' + row.id;
                    var html = '<div class="text-nowrap">';
                    html += '<a href="' + url_detail + '" class="btn btn-icon btn-sm btn-primary"><i class="fas fa-file-alt" style="width: 16px"></i></a>';
                    html += '<a href="javascript:;" onclick="editData(\'' + encodeURIComponent(JSON.stringify(row)) + '\')" class="btn btn-icon btn-sm btn-warning mx-1"><i class="fas fa-edit" style="width: 16px"></i></a>';
                    html += '<a href="javascript:;" onclick="deleteData(\'' + row.id + '\')" class="btn btn-icon btn-sm btn-danger"><i class="fas fa-trash" style="width: 16px"></i></a>';
                    html += '</div>';

                    return html;
                },
            }],
            order: [],
            "initComplete": function(settings, json) {
                $('[data-kt-menu]').each(function() {
                    var menu = new KTMenu(this);
                });
            },
        });


        $("#search_filter").on("keyup", function() {
            datatable.search($(this).val()).draw();
        });

        function reloadDataTable() {
            datatable.ajax.reload();
            $('[data-kt-menu]').each(function() {
                var menu = new KTMenu(this);
            });
        }

        $("#form_add").submit(function(e) {
            $("#btn_add").prop("disabled", true);

            $("#fullname_add").removeClass('is-invalid');
            $("#handphone_add").removeClass('is-invalid');
            $("#jk_add").removeClass('is-invalid');
            $("#asal_add").removeClass('is-invalid');
            $("#email_add").removeClass('is-invalid');
            $("#username_add").removeClass('is-invalid');
            $("#password_add").removeClass('is-invalid');
            $("#hex_add").removeClass('is-invalid');

            var formdata = new FormData(this);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                cache: false,
                contentType: false,
                processData: false,
                method: 'post',
                url: "{{ url('worker/add') }}",
                data: formdata,
                dataType: 'json',
                success: function(response) {
                    $("#btn_add").prop("disabled", false);
                    if (response.status == "1") {
                        swal.fire({
                            icon: "success",
                            title: 'Berhasil',
                            text: response.msg,
                            showConfirmButton: true,
                            timer: 900
                        }).then((result) => {
                            if (result.isConfirmed) {
                                Swal.close();
                                $('#form_add')[0].reset();
                                $('#jk_add').val('').change();
                                $('#modal_add').modal('hide');
                                reloadDataTable();
                            }
                        });
                        setTimeout(function() {
                            Swal.close();
                            $('#form_add')[0].reset();
                            $('#jk_add').val('').change();
                            $('#modal_add').modal('hide');
                            reloadDataTable();
                        }, 900);
                    } else {
                        swal.fire({
                            icon: "error",
                            title: 'Gagal !',
                            text: response.msg,
                            showConfirmButton: true,
                            timer: 900
                        });
                    }
                },
                error: function(response) {
                    $("#btn_add").prop("disabled", false);
                    if (response.status == 422) {
                        let errorResponse = JSON.parse(response.responseText);

                        if (errorResponse.errors && errorResponse.errors.fullname) {
                            let errors = errorResponse.errors;
                            $("#fullname_add").addClass('is-invalid');
                            $("#error_fullname_add").html(errors.fullname[0]);
                        }
                        if (errorResponse.errors && errorResponse.errors.handphone) {
                            let errors = errorResponse.errors;
                            $("#handphone_add").addClass('is-invalid');
                            $("#error_handphone_add").html(errors.handphone[0]);
                        }
                        if (errorResponse.errors && errorResponse.errors.jk) {
                            let errors = errorResponse.errors;
                            $("#jk_add").addClass('is-invalid');
                            $("#error_jk_add").html(errors.jk[0]);
                        }
                        if (errorResponse.errors && errorResponse.errors.asal) {
                            let errors = errorResponse.errors;
                            $("#asal_add").addClass('is-invalid');
                            $("#error_asal_add").html(errors.asal[0]);
                        }
                        if (errorResponse.errors && errorResponse.errors.username) {
                            let errors = errorResponse.errors;
                            $("#username_add").addClass('is-invalid');
                            $("#error_username_add").html(errors.username[0]);
                        }
                        if (errorResponse.errors && errorResponse.errors.email) {
                            let errors = errorResponse.errors;
                            $("#email_add").addClass('is-invalid');
                            $("#error_email_add").html(errors.email[0]);
                        }
                        if (errorResponse.errors && errorResponse.errors.password) {
                            let errors = errorResponse.errors;
                            $("#password_add").addClass('is-invalid');
                            $("#error_password_add").html(errors.password[0]);
                        }
                        if (errorResponse.errors && errorResponse.errors.hex) {
                            let errors = errorResponse.errors;
                            $("#hex_add").addClass('is-invalid');
                            $("#error_hex_add").html(errors.hex[0]);
                        }

                    } else {
                        errorAjaxResponse(response);
                    }
                }
            });
            e.preventDefault();
        });

        function editData(data) {
            var decodedData = decodeURIComponent(data);
            var rowData = JSON.parse(decodedData);
            $("#id_edit").val(rowData.id);
            $("#fullname_edit").val(rowData.fullname);
            $("#handphone_edit").val(rowData.handphone);
            $("#asal_edit").val(rowData.asal);
            $("#jk_edit").val(rowData.jk).change();
            $("#username_edit").val(rowData.username);
            $("#email_edit").val(rowData.email);
            $("#hex_edit").val(rowData.hex);
            $("#modal_edit").modal("show");
        }

        $("#form_edit").submit(function(e) {
            $("#btn_edit").prop("disabled", true);

            $("#fullname_edit").removeClass('is-invalid');
            $("#handphone_edit").removeClass('is-invalid');
            $("#jk_edit").removeClass('is-invalid');
            $("#asal_edit").removeClass('is-invalid');
            $("#email_edit").removeClass('is-invalid');
            $("#username_edit").removeClass('is-invalid');
            $("#hex_edit").removeClass('is-invalid');
            $("#password_edit").removeClass('is-invalid');

            var formdata = new FormData(this);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                cache: false,
                contentType: false,
                processData: false,
                method: 'post',
                url: "{{ url('worker/edit') }}",
                data: formdata,
                dataType: 'json',
                success: function(response) {
                    $("#btn_edit").prop("disabled", false);
                    if (response.status == "1") {
                        swal.fire({
                            icon: "success",
                            title: 'Berhasil',
                            text: response.msg,
                            showConfirmButton: true,
                            timer: 900
                        }).then((result) => {
                            if (result.isConfirmed) {
                                Swal.close();
                                $('#form_edit')[0].reset();
                                $('#jk_edit').val('').change();
                                $('#modal_edit').modal('hide');
                                reloadDataTable();
                            }
                        });
                        setTimeout(function() {
                            Swal.close();
                            $('#form_edit')[0].reset();
                            $('#jk_edit').val('').change();
                            $('#modal_edit').modal('hide');
                            reloadDataTable();
                        }, 900);
                    } else {
                        swal.fire({
                            icon: "error",
                            title: 'Gagal !',
                            text: response.msg,
                            showConfirmButton: true,
                            timer: 900
                        });
                    }
                },
                error: function(response) {
                    $("#btn_edit").prop("disabled", false);
                    if (response.status == 422) {
                        let errorResponse = JSON.parse(response.responseText);

                        if (errorResponse.errors && errorResponse.errors.fullname) {
                            let errors = errorResponse.errors;
                            $("#fullname_edit").addClass('is-invalid');
                            $("#error_fullname_edit").html(errors.fullname[0]);
                        }
                        if (errorResponse.errors && errorResponse.errors.handphone) {
                            let errors = errorResponse.errors;
                            $("#handphone_edit").addClass('is-invalid');
                            $("#error_handphone_edit").html(errors.handphone[0]);
                        }
                        if (errorResponse.errors && errorResponse.errors.jk) {
                            let errors = errorResponse.errors;
                            $("#jk_edit").addClass('is-invalid');
                            $("#error_jk_edit").html(errors.jk[0]);
                        }
                        if (errorResponse.errors && errorResponse.errors.asal) {
                            let errors = errorResponse.errors;
                            $("#asal_edit").addClass('is-invalid');
                            $("#error_asal_edit").html(errors.asal[0]);
                        }
                        if (errorResponse.errors && errorResponse.errors.username) {
                            let errors = errorResponse.errors;
                            $("#username_edit").addClass('is-invalid');
                            $("#error_username_edit").html(errors.username[0]);
                        }
                        if (errorResponse.errors && errorResponse.errors.email) {
                            let errors = errorResponse.errors;
                            $("#email_edit").addClass('is-invalid');
                            $("#error_email_edit").html(errors.email[0]);
                        }
                        if (errorResponse.errors && errorResponse.errors.password) {
                            let errors = errorResponse.errors;
                            $("#password_edit").addClass('is-invalid');
                            $("#error_password_edit").html(errors.password[0]);
                        }
                        if (errorResponse.errors && errorResponse.errors.hex) {
                            let errors = errorResponse.errors;
                            $("#hex_edit").addClass('is-invalid');
                            $("#error_hex_edit").html(errors.hex[0]);
                        }

                    } else {
                        errorAjaxResponse(response);
                    }
                }
            });
            e.preventDefault();
        });

        function deleteData(id) {
            swal.fire({
                title: 'Apakah anda yakin??',
                text: "Anda tidak dapat mengembalikan ini !!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: 'Hapus!',
                cancelButtonText: 'Batal',
                confirmButtonClass: 'btn btn-danger mr-3',
                cancelButtonClass: 'btn btn-secondary',
                buttonsStyling: false
            }).then(function(result) {
                if (result.value) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: "POST",
                        url: "{{ url('worker/delete') }}",
                        data: 'id=' + id,
                        success: function(response) {
                            if (response.status == "1") {
                                swal.fire({
                                    icon: "success",
                                    title: 'Berhasil',
                                    text: response.msg,
                                    showConfirmButton: true,
                                    timer: 900
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        Swal.close();
                                        reloadDataTable();
                                    }
                                });
                                setTimeout(function() {
                                    Swal.close();
                                    reloadDataTable();
                                }, 900);
                            } else {
                                swal.fire("Error!", response.msg, "error");
                            }
                        },
                        error: function(response) {
                            errorAjaxResponse(response);
                        }
                    });
                }
            });
        }
    </script>
@endpush
