@extends('area._base')
@push('head')
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header">
                    <h4>Profil</h4>
                </div>
                <div class="card-body">
                    <div class="text-center">
                        <img src="{{ asset(Auth::user()->img) }}" class="rounded" style="width: 100px" alt="">
                    </div>
                    <div class="d-block d-md-flex justify-content-between mt-4">
                        <p class="m-0 mr-3">Username</p>
                        <p class="m-0 text-muted">{{ Auth::User()->username }}</p>
                    </div>
                    <div class="d-block d-md-flex justify-content-between mt-4">
                        <p class="m-0 mr-3">Fullname</p>
                        <p class="m-0 text-muted">{{ Auth::User()->fullname }}</p>
                    </div>
                    <div class="d-block d-md-flex justify-content-between mt-4">
                        <p class="m-0 mr-3">Handphone</p>
                        <p class="m-0 text-muted">{{ Auth::User()->handphone ?? '-' }}</p>
                    </div>
                    <div class="d-block d-md-flex justify-content-between mt-4">
                        <p class="m-0 mr-3">Asal</p>
                        <p class="m-0 text-muted">{{ Auth::User()->asal ?? '-' }}</p>
                    </div>
                    <div class="d-block d-md-flex justify-content-between mt-4">
                        <p class="m-0 mr-3">Jenis Kelamin</p>
                        <p class="m-0 text-muted">{{ Auth::User()->jk ?? '-' }}</p>
                    </div>
                    <div class="d-block d-md-flex justify-content-between mt-4">
                        <p class="m-0 mr-3">Email</p>
                        <p class="m-0 text-muted">{{ Auth::User()->email ?? '-' }}</p>
                    </div>
                    <button type="button" class="btn btn-primary mt-4 w-100" onclick="editData('{{ Auth::user() }}')">Edit Profil</button>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('modal')
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
                                    <label>Foto</label>
                                    <input type="file" accept=".png, .jpg, .jpeg" class="form-control" name="img" id="img_edit">
                                    <span style="font-size: 10px" class="text-muted">*kosongkan bila tidak ingin mengganti foto</span>
                                    <div id="error_img_edit" class="invalid-feedback"></div>
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
            $('#jk_edit').select2({
                width: '100%',
                placeholder: 'Pilih',
            });
        });

        function editData(data) {
            var decodedData = decodeURIComponent(data);
            var rowData = JSON.parse(decodedData);
            $("#fullname_edit").val(rowData.fullname);
            $("#handphone_edit").val(rowData.handphone);
            $("#asal_edit").val(rowData.asal);
            $("#jk_edit").val(rowData.jk).change();
            $("#username_edit").val(rowData.username);
            $("#email_edit").val(rowData.email);
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
            $("#password_edit").removeClass('is-invalid');
            $("#img_edit").removeClass('is-invalid');

            var formdata = new FormData(this);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                cache: false,
                contentType: false,
                processData: false,
                method: 'post',
                url: "{{ url('profil/edit') }}",
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
                        if (errorResponse.errors && errorResponse.errors.img) {
                            let errors = errorResponse.errors;
                            $("#img_edit").addClass('is-invalid');
                            $("#error_img_edit").html(errors.img[0]);
                        }
                    } else {
                        errorAjaxResponse(response);
                    }
                }
            });
            e.preventDefault();
        });
    </script>
@endpush
