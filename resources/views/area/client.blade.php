@extends('area._base')
@push('head')
@endpush
@section('content')
    <div class="card ">
        <div class="card-header">
            <h4>Data Client</h4>
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
                            <th>Customer</th>
                            <th>Handphone</th>
                            <th>Jenis Kelamin</th>
                            <th>Asal</th>
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
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModal">Tambah Client</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form_add">
                        <div class="form-group">
                            <label>Customer</label>
                            <input type="text" class="form-control" name="customer" id="customer_add">
                            <div id="error_customer_add" class="invalid-feedback"></div>
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
                        <button type="submit" id="btn_add" class="btn btn-primary m-t-15 waves-effect">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- modal add --}}
    {{-- modal edit --}}
    <div class="modal fade" id="modal_edit" role="dialog" aria-labelledby="formModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModal">Edit Client</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form_edit">
                        <input type="hidden" name="id" id="id_edit">
                        <div class="form-group">
                            <label>Customer</label>
                            <input type="text" class="form-control" name="customer" id="customer_edit">
                            <div id="error_customer_edit" class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label>Handphone</label>
                            <input type="text" class="form-control" name="handphone" id="handphone_edit">
                            <div id="error_handphone_edit" class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label>Jenis Kelamin</label>
                            <select name="jk" id="jk_edit" class="form-control">
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
                url: '{{ url('client/list') }}',
            },
            columns: [{
                "data": "DT_RowIndex",
                "name": "DT_RowIndex",
                "orderable": false,
                "searchable": false
            }, {
                data: 'customer',
                name: 'customer',
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
                "orderable": false,
                "searchable": false,
                "data": null,
                "render": function(data, type, row, meta) {
                    var url_detail = '{{ asset('client/detail') }}/' + row.id;
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

            $("#customer_add").removeClass('is-invalid');
            $("#handphone_add").removeClass('is-invalid');
            $("#jk_add").removeClass('is-invalid');
            $("#asal_add").removeClass('is-invalid');

            var formdata = new FormData(this);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                cache: false,
                contentType: false,
                processData: false,
                method: 'post',
                url: "{{ url('client/add') }}",
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

                        if (errorResponse.errors && errorResponse.errors.customer) {
                            let errors = errorResponse.errors;
                            $("#customer_add").addClass('is-invalid');
                            $("#error_customer_add").html(errors.customer[0]);
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
            $("#customer_edit").val(rowData.customer);
            $("#handphone_edit").val(rowData.handphone);
            $("#asal_edit").val(rowData.asal);
            $("#jk_edit").val(rowData.jk).change();
            $("#modal_edit").modal("show");
        }

        $("#form_edit").submit(function(e) {
            $("#btn_edit").prop("disabled", true);

            $("#customer_edit").removeClass('is-invalid');
            $("#handphone_edit").removeClass('is-invalid');
            $("#jk_edit").removeClass('is-invalid');
            $("#asal_edit").removeClass('is-invalid');

            var formdata = new FormData(this);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                cache: false,
                contentType: false,
                processData: false,
                method: 'post',
                url: "{{ url('client/edit') }}",
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

                        if (errorResponse.errors && errorResponse.errors.customer) {
                            let errors = errorResponse.errors;
                            $("#customer_edit").addClass('is-invalid');
                            $("#error_customer_edit").html(errors.customer[0]);
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
                        url: "{{ url('client/delete') }}",
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
