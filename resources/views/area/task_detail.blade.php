@extends('area._base')
@push('head')
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4>Data Tasking</h4>
                    <button class="btn btn-primary d-lg-none" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                        <i class="fas fa-file-alt"></i> View Detail
                    </button>
                </div>
                <div class="card-body">
                    <div class="collapse d-lg-block" id="collapseExample">
                        <div class="d-block d-md-flex justify-content-between">
                            <p class="m-0 mr-3">Kode</p>
                            <p class="m-0 text-muted">{{ $task->kode_task }}</p>
                        </div>
                        <div class="mt-3 d-block d-md-flex justify-content-between">
                            <p class="m-0 mr-3">Deskripsi</p>
                            <p class="m-0 text-muted">{{ $task->task }}</p>
                        </div>
                        @if (Auth::user()->role == 'Admin')
                            <div class="mt-3 d-block d-md-flex justify-content-between">
                                <p class="m-0 mr-3">Client</p>
                                <p class="m-0 text-muted">{{ $task->customer }}</p>
                            </div>
                            <div class="mt-3 d-block d-md-flex justify-content-between">
                                <p class="m-0 mr-3">Worker</p>
                                <p class="m-0 text-muted">{{ $task->worker }}</p>
                            </div>
                            <div class="mt-3 d-block d-md-flex justify-content-between">
                                <p class="m-0 mr-3">Tanggal Order</p>
                                <p class="m-0 text-muted">{{ hariTglIndo($task->order) }}</p>
                            </div>
                        @endif

                        <div class="mt-3 d-block d-md-flex justify-content-between">
                            <p class="m-0 mr-3">Deadline</p>
                            <p class="m-0 text-muted">{{ hariTglIndo($task->deadline) }}</p>
                        </div>
                        @if (Auth::user()->role == 'Admin')
                            <div class="mt-3 d-block d-md-flex justify-content-between">
                                <p class="m-0 mr-3">Price Order</p>
                                <p class="m-0 text-muted">{{ rupiah($task->price_order, true) }}</p>
                            </div>
                        @endif
                        <div class="mt-3 d-block d-md-flex justify-content-between">
                            <p class="m-0 mr-3">Pay to Worker</p>
                            <p class="m-0 text-muted">{{ rupiah($task->pay_worker, true) }}</p>
                        </div>
                        @if (Auth::user()->role == 'Admin')
                            <div class="mt-3 d-block d-md-flex justify-content-between">
                                <p class="m-0 mr-3">Margin</p>
                                <p class="m-0 text-muted">{{ rupiah($task->margin, true) }}</p>
                            </div>
                        @endif
                        <div class="mt-3 d-block d-md-flex justify-content-between">
                            <p class="m-0 mr-3">Task Status</p>
                            <p class="m-0 text-muted">{{ $task->task_status }}</p>
                        </div>
                        <div class="mt-3 d-block d-md-flex justify-content-between">
                            <p class="m-0 mr-3">Pay Status</p>
                            <p class="m-0 text-muted">{{ $task->pay_status }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4>File</h4>
                    @if (Auth::user()->role == 'Worker')
                        <div class="card-header-action">
                            <button class="btn btn-primary btn-lg " data-toggle="modal" data-target="#modal_add"><i class="fas fa-plus"></i> Tambah</button>
                        </div>
                    @endif
                </div>
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-lg-3 col-md-6 col-12 mb-1">
                            <input type="text" id="search_filter" class="form-control" placeholder="Search..." />
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped" id="table" style="width: 100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Deskripsi</th>
                                    <th>File</th>
                                    <th>Waktu Upload</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $no = 1;
                                @endphp
                                @foreach ($detail as $row)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $row->deskripsi }}</td>
                                        <td><a href="{{ asset($row->file) }}" target="_blank">{{ str_replace('storage/task/', '', $row->file) }}</a></td>
                                        <td>{{ tglIndo($row->created_at) }}</td>
                                        <td class="text-nowrap">
                                            <a href="javascript:;" onclick="editData('{{ $row }}')" class="btn btn-icon btn-sm btn-warning mx-1"><i class="fas fa-edit" style="width: 16px"></i></a>
                                            <a href="javascript:;" onclick="deleteData('{{ $row->id }}')" class="btn btn-icon btn-sm btn-danger"><i class="fas fa-trash" style="width: 16px"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
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
                    <h5 class="modal-title" id="formModal">Tambah File</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form_add" enctype="multipart/form-data">
                        <input type="hidden" name="kode_task" value="{{ $task->kode_task }}">
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi_add" class="form-control"></textarea>
                            <div id="error_deskripsi_add" class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label>File</label>
                            <input type="file" name="file" id="file_add" class="form-control">
                            <div id="error_deskripsi_add" class="invalid-feedback"></div>
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
                    <h5 class="modal-title" id="formModal">Edit File</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form_edit" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id_edit">
                        <div class="form-group">
                            <label>Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi_edit" class="form-control"></textarea>
                            <div id="error_deskripsi_edit" class="invalid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label>File</label>
                            <input type="file" name="file" id="file_edit" class="form-control">
                            <div id="error_deskripsi_edit" class="invalid-feedback"></div>
                        </div>
                        <button type="submit" id="btn_edit" class="btn btn-primary m-t-15 waves-effect">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- modal edit --}}
@endsection
@push('js')
    <script>
        var datatable = $("#table").DataTable({
            "dom": "<'dt--top-section'>" +
                "<''tr>" +
                "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--length-info d-flex justify-content-center align-middle 'l<'dt--pages-count ml-1'i>><'dt--pagination mt-sm-0 mt-3'p>>",
            "oLanguage": {
                "sLengthMenu": "_MENU_",
            },
        });

        $("#search_filter").on("keyup", function() {
            datatable.search($(this).val()).draw();
        });

        $("#form_add").submit(function(e) {
            $("#btn_add").prop("disabled", true);

            $("#deskripsi_add").removeClass('is-invalid');
            $("#file_add").removeClass('is-invalid');

            var formdata = new FormData(this);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                cache: false,
                contentType: false,
                processData: false,
                method: 'post',
                url: "{{ url('task/add-file') }}",
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
                                location.reload();
                            }
                        });
                        setTimeout(function() {
                            location.reload();
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

                        if (errorResponse.errors && errorResponse.errors.deskripsi) {
                            let errors = errorResponse.errors;
                            $("#deskripsi_add").addClass('is-invalid');
                            $("#error_deskripsi_add").html(errors.deskripsi[0]);
                        }
                        if (errorResponse.errors && errorResponse.errors.file) {
                            let errors = errorResponse.errors;
                            $("#file_add").addClass('is-invalid');
                            $("#error_file_add").html(errors.file[0]);
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
            $("#deskripsi_edit").val(rowData.deskripsi);
            $("#modal_edit").modal("show");
        }

        $("#form_edit").submit(function(e) {
            $("#btn_edit").prop("disabled", true);

            $("#deskripsi_edit").removeClass('is-invalid');
            $("#file_edit").removeClass('is-invalid');

            var formdata = new FormData(this);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                cache: false,
                contentType: false,
                processData: false,
                method: 'post',
                url: "{{ url('task/edit-file') }}",
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
                                location.reload();
                            }
                        });
                        setTimeout(function() {
                            location.reload();
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

                        if (errorResponse.errors && errorResponse.errors.deskripsi) {
                            let errors = errorResponse.errors;
                            $("#deskripsi_edit").addClass('is-invalid');
                            $("#error_deskripsi_edit").html(errors.deskripsi[0]);
                        }
                        if (errorResponse.errors && errorResponse.errors.file) {
                            let errors = errorResponse.errors;
                            $("#file_edit").addClass('is-invalid');
                            $("#error_file_edit").html(errors.file[0]);
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
                        url: "{{ url('task/delete-file') }}",
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
                                        location.reload();
                                    }
                                });
                                setTimeout(function() {
                                    location.reload();
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
