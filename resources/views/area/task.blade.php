@extends('area._base')
@push('head')
@endpush
@section('content')
    <div class="card ">
        <div class="card-header">
            <h4>Data Tasking</h4>

            <div class="card-header-action">
                @if (Auth::user()->role == 'Admin')
                    <button class="btn btn-primary btn-lg mb-1" data-toggle="modal" data-target="#modal_add"><i class="fas fa-plus"></i> Tambah</button>
                @endif
                <button type="button" onclick="exportTask()" class="btn btn-success btn-lg ml-1 mb-1"><i class="fas fa-download"></i> Export Excel</button>
            </div>

        </div>
        <div class="card-body">
            <button class="btn btn-primary mb-2 d-lg-none" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                <i class="fas fa-filter"></i> Filter
            </button>
            <div class="collapse d-lg-block" id="collapseExample">
                <div class="row mb-2">
                    <div class="col-lg-2 col-md-6 col-12 mb-1">
                        <label class="m-0">Cari</label>
                        <input type="text" id="search_filter" class="form-control" placeholder="Search..." />
                    </div>
                    <div class="col-lg-2 col-md-6 col-12 mb-1">
                        <label class="m-0">Tanggal Mulai</label>
                        <input type="date" id="tanggal_mulai_filter" class="form-control" onchange="reloadDataTable()" />
                    </div>
                    <div class="col-lg-2 col-md-6 col-12 mb-1">
                        <label class="m-0">Tanggal Akhir</label>
                        <input type="date" id="tanggal_akhir_filter" class="form-control" onchange="reloadDataTable()" />
                    </div>
                    <div class="col-lg-2 col-md-6 col-12 mb-1">
                        <label class="m-0">Task Status</label>
                        <select id="task_status_filter" class="form-control" onchange="reloadDataTable()">
                            <option value="">Seluruh Data</option>
                            <option value="Waiting">Waiting</option>
                            <option value="Progress">Progress</option>
                            <option value="Done">Done</option>
                        </select>
                    </div>
                    <div class="col-lg-2 col-md-6 col-12 mb-1">
                        <label class="m-0">Pay Status</label>
                        <select id="pay_status_filter" class="form-control" onchange="reloadDataTable()">
                            <option value="">Seluruh Data</option>
                            <option value="Paid">Paid</option>
                            <option value="Hold">Hold</option>
                        </select>
                    </div>
                </div>
            </div>
            <table class="table table-striped" id="table-1" style="width: 100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kode</th>
                        <th>Customer</th>
                        @if (Auth::user()->role == 'Admin')
                            <th>Worker</th>
                        @endif
                        <th>Deskripsi</th>
                        <th>Tanggal Order</th>
                        <th>Deadline</th>
                        @if (Auth::user()->role == 'Admin')
                            <th>Price Order</th>
                            <th>Pay to Worker</th>
                            <th>Margin</th>
                        @else
                            <th>Pay to Worker</th>
                        @endif
                        <th>Task Status</th>
                        <th>Pay Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
@section('modal')
    {{-- modal add --}}
    <div class="modal fade" id="modal_add" role="dialog" aria-labelledby="formModal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModal">Tambah Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form_add">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Customer</label>
                                    <select name="client_id" id="client_id_add" class="form-control">
                                        <option></option>
                                    </select>
                                    <div id="error_client_id_add" class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Worker</label>
                                    <select name="worker_id" id="worker_id_add" class="form-control">
                                        <option></option>
                                    </select>
                                    <div id="error_worker_id_add" class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Task Description</label>
                            <textarea name="task" id="task_add" class="form-control"></textarea>
                            <div id="error_task_add" class="invalid-feedback"></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Tanggal Order</label>
                                    <input type="date" name="order" id="order_add" class="form-control">
                                    <div id="error_order_add" class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Deadline</label>
                                    <input type="date" name="deadline" id="deadline_add" class="form-control">
                                    <div id="error_deadline_add" class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Price Order</label>
                                    <input type="number" name="price_order" id="price_order_add" class="form-control">
                                    <div id="error_price_order_add" class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Pay to Worker</label>
                                    <input type="number" name="pay_worker" id="pay_worker_add" class="form-control">
                                    <div id="error_pay_worker_add" class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Task Status</label>
                                    <select name="task_status" id="task_status_add" class="form-control">
                                        <option></option>
                                        <option value="Waiting">Waiting</option>
                                        <option value="Progress">Progress</option>
                                        <option value="Done">Done</option>
                                    </select>
                                    <div id="error_task_status_add" class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Pay Status</label>
                                    <select name="pay_status" id="pay_status_add" class="form-control">
                                        <option></option>
                                        <option value="Paid">Paid</option>
                                        <option value="Hold">Hold</option>
                                    </select>
                                    <div id="error_pay_status_add" class="invalid-feedback"></div>
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
                    <h5 class="modal-title" id="formModal">Edit Task</h5>
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
                                    <label>Customer</label>
                                    <select name="client_id" id="client_id_edit" class="form-control">
                                    </select>
                                    <div id="error_client_id_edit" class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Worker</label>
                                    <select name="worker_id" id="worker_id_edit" class="form-control">
                                    </select>
                                    <div id="error_worker_id_edit" class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Task Description</label>
                            <textarea name="task" id="task_edit" class="form-control"></textarea>
                            <div id="error_task_edit" class="invalid-feedback"></div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Tanggal Order</label>
                                    <input type="date" name="order" id="order_edit" class="form-control">
                                    <div id="error_order_edit" class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Deadline</label>
                                    <input type="date" name="deadline" id="deadline_edit" class="form-control">
                                    <div id="error_deadline_edit" class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Price Order</label>
                                    <input type="number" name="price_order" id="price_order_edit" class="form-control">
                                    <div id="error_price_order_edit" class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Pay to Worker</label>
                                    <input type="number" name="pay_worker" id="pay_worker_edit" class="form-control">
                                    <div id="error_pay_worker_edit" class="invalid-feedback"></div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Task Status</label>
                                    <select name="task_status" id="task_status_edit" class="form-control">
                                        <option value="Waiting">Waiting</option>
                                        <option value="Progress">Progress</option>
                                        <option value="Done">Done</option>
                                    </select>
                                    <div id="error_task_status_edit" class="invalid-feedback"></div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Pay Status</label>
                                    <select name="pay_status" id="pay_status_edit" class="form-control">
                                        <option value="Paid">Paid</option>
                                        <option value="Hold">Hold</option>
                                    </select>
                                    <div id="error_pay_status_edit" class="invalid-feedback"></div>
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
    {{-- modal edit pay --}}
    <div class="modal fade" id="modal_edit_pay" role="dialog" aria-labelledby="formModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModal">Pay</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form_edit_pay">
                        <input type="hidden" name="id" id="id_edit_pay">
                        <input type="hidden" name="price_order" id="price_order_edit_pay">
                        <div class="form-group">
                            <label>Task Description</label>
                            <textarea readonly id="task_edit_pay" class="form-control"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Pay</label>
                            <input type="number" name="pay_worker" id="pay_worker_edit_pay" class="form-control">
                            <div id="error_pay_worker_edit_pay" class="invalid-feedback"></div>
                        </div>
                        <button type="submmit" id="btn_edit_pay" class="btn btn-primary m-t-15 waves-effect">Submit Pengajuan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- modal edit pay --}}
    {{-- modal edit status --}}
    <div class="modal fade" id="modal_edit_status" role="dialog" aria-labelledby="formModal" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModal">Update Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form_edit_status">
                        <input type="hidden" name="id" id="id_edit_status">
                        <div class="form-group">
                            <label>Task Status</label>
                            <select name="task_status" id="task_status_edit_status" class="form-control">
                                <option value="Progress">Progress</option>
                                <option value="Done">Done</option>
                            </select>
                            <div id="error_task_status_edit_status" class="invalid-feedback"></div>
                        </div>
                        <button type="submmit" id="btn_edit_status" class="btn btn-primary m-t-15 waves-effect">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- modal edit status --}}
@endsection
@push('js')
    <script>
        $(document).ready(function() {
            tanggalFilter();
            tanggalAdd();
            tanggalEdit();

            $('#pay_status_filter').select2({
                width: '100%',
            });
            $('#task_status_filter').select2({
                width: '100%',
            });

            $('#task_status_add').select2({
                width: '100%',
                placeholder: 'Pilih',
            });
            $('#pay_status_add').select2({
                width: '100%',
                placeholder: 'Pilih',
            });
            $('#task_status_edit_status').select2({
                width: '100%',
                placeholder: 'Pilih',
            });
            $('#client_id_add').select2({
                width: '100%',
                placeholder: 'Pilih',
                ajax: {
                    url: '{{ url('client/search') }}',
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                },
            });
            $('#worker_id_add').select2({
                width: '100%',
                placeholder: 'Pilih',
                ajax: {
                    url: '{{ url('worker/search') }}',
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                },
            });

            $('#client_id_edit').select2({
                width: '100%',
                ajax: {
                    url: '{{ url('client/search') }}',
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                },
            });
            $('#worker_id_edit').select2({
                width: '100%',
                ajax: {
                    url: '{{ url('worker/search') }}',
                    dataType: 'json',
                    delay: 250,
                    processResults: function(data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                },
            });
            $('#task_status_edit').select2({
                width: '100%',
                placeholder: 'Pilih',
            });
            $('#pay_status_edit').select2({
                width: '100%',
                placeholder: 'Pilih',
            });
        });

        function tanggalFilter() {
            var inputTanggalAwal = document.getElementById("tanggal_mulai_filter");
            var inputTanggalAkhir = document.getElementById("tanggal_akhir_filter");
            inputTanggalAkhir.min = inputTanggalAwal.value;

            inputTanggalAwal.addEventListener("change", function() {
                var tanggalAwalBaru = new Date(inputTanggalAwal.value);
                var tanggalAkhirLama = new Date(inputTanggalAkhir.value);
                if (tanggalAwalBaru > tanggalAkhirLama) {
                    inputTanggalAkhir.value = inputTanggalAwal.value;
                }
                inputTanggalAkhir.min = inputTanggalAwal.value;
            });
        }

        function tanggalAdd() {
            var order = document.getElementById("order_add");
            var deadline = document.getElementById("deadline_add");
            deadline.min = order.value;

            order.addEventListener("change", function() {
                var orderBaru = new Date(order.value);
                var deadlineLama = new Date(deadline.value);
                if (orderBaru > deadlineLama) {
                    deadline.value = order.value;
                }
                deadline.min = order.value;
            });
        }

        function tanggalEdit() {
            var inputTanggalAwal = document.getElementById("tanggal_mulai_filter");
            var inputTanggalAkhir = document.getElementById("tanggal_akhir_filter");
            inputTanggalAkhir.min = inputTanggalAwal.value;

            inputTanggalAwal.addEventListener("change", function() {
                var tanggalAwalBaru = new Date(inputTanggalAwal.value);
                var tanggalAkhirLama = new Date(inputTanggalAkhir.value);
                if (tanggalAwalBaru > tanggalAkhirLama) {
                    inputTanggalAkhir.value = inputTanggalAwal.value;
                }
                inputTanggalAkhir.min = inputTanggalAwal.value;
            });
        }

        var tanggal_mulai = $("#tanggal_mulai_filter").val();
        var tanggal_akhir = $("#tanggal_akhir_filter").val();
        var task_status = $("#task_status_filter").val();
        var pay_status = $("#pay_status_filter").val();

        var url_datatable = '{{ url('task/list') }}' + '?tanggal_mulai_filter=' + tanggal_mulai + '&tanggal_akhir_filter=' + tanggal_akhir + '&task_status_filter=' + task_status + '&pay_status_filter=' + pay_status;
        if ('{{ Auth::user()->role }}' == "Worker") {
            url_datatable += '&worker_id_filter={{ Auth::user()->id }}';
        }
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
                url: url_datatable,
            },
            scrollX: true,
            scrollY: false,
            @if (Auth::user()->role == 'Admin')
                fixedColumns: {
                    leftColumns: 4

                },
            @endif
            columns: [{
                    "data": "DT_RowIndex",
                    "name": "DT_RowIndex",
                    "orderable": false,
                    "searchable": false
                }, {
                    data: 'kode_task',
                    name: 'kode_task',
                },
                {
                    data: 'customer',
                    name: 'client.customer',
                },
                @if (Auth::user()->role == 'Admin')
                    {
                        data: 'fullname',
                        name: 'users.fullname',
                    },
                @endif {
                    data: 'task',
                    name: 'task',
                }, {
                    "searchable": false,
                    data: 'order',
                    name: 'order',
                }, {
                    "searchable": false,
                    data: 'deadline',
                    name: 'deadline',
                },
                @if (Auth::user()->role == 'Admin')
                    {
                        data: 'price_order',
                        name: 'price_order',
                        render: function(data, type, row) {
                            return idrFormat(data, true);
                        },
                    }, {
                        data: 'pay_worker',
                        name: 'pay_worker',
                        render: function(data, type, row) {
                            return idrFormat(data, true);
                        },
                    }, {
                        data: 'margin',
                        name: 'margin',
                        render: function(data, type, row) {
                            return idrFormat(data, true);
                        },
                    },
                @else
                    {
                        data: 'pay_worker',
                        name: 'pay_worker',
                        render: function(data, type, row) {
                            return idrFormat(data, true);
                        },
                    },
                @endif {
                    data: 'task_status',
                    name: 'task_status',
                    render: function(data, type, row) {

                        if (data == 'Waiting') {
                            return '<span class="badge badge-warning">' + data + '</span>';
                        } else if (data == 'Progress') {
                            return '<span class="badge badge-primary">' + data + '</span>';
                        } else {
                            return '<span class="badge badge-success">' + data + '</span>';
                        }
                    },
                }, {
                    data: 'pay_status',
                    name: 'pay_status',
                    render: function(data, type, row) {
                        if (data == 'Paid') {
                            return '<span class="badge badge-success">' + data + '</span>';
                        } else {
                            return '<span class="badge badge-danger">' + data + '</span>';
                        }
                    },

                }, {
                    "orderable": false,
                    "searchable": false,
                    "data": null,
                    "render": function(data, type, row, meta) {
                        var html = '';
                        var url_detail = '{{ asset('task/detail') }}/' + row.id;
                        @if (Auth::user()->role == 'Admin')
                            html = '<div class="text-nowrap">';
                            html += '<a href="' + url_detail + '" class="btn btn-icon btn-sm btn-info mr-1"><i class="fas fa-file-alt" style="width: 16px"></i></a>';
                            html += '<a href="javascript:;" onclick="editData(\'' + row.id + '\')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Data" class="btn btn-icon btn-sm btn-warning mr-1"><i class="fas fa-edit" style="width: 16px"></i></a>';
                            html += '<a href="javascript:;" onclick="deleteData(\'' + row.id + '\')" class="btn btn-icon btn-sm btn-danger mr"><i class="fas fa-trash" style="width: 16px"></i></a>';
                            html += '</div>';
                        @else
                            html = '<div class="text-nowrap">';
                            if (row.task_status == 'Waiting') {
                                html += '<a href="javascript:;" onclick="editPay(\'' + row.id + '\')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Data" class="btn btn-icon btn-sm btn-info mr-1"><i class="fas fa-money-check" style="width: 16px"></i></a>';
                            }
                            html += '<a href="' + url_detail + '" data-toggle="tooltip" data-placement="top" title="" data-original-title="Detail Data" class="btn btn-icon btn-sm btn-warning mr-1"><i class="fas fa-edit" style="width: 16px"></i></a>';
                            html += '<a href="javascript:;" onclick="editStatus(\'' + row.id + '\',\'' + row.task_status + '\')" class="btn btn-icon btn-sm btn-success"><i class="fas fa-check" style="width: 16px"></i></a>';
                            html += '</div>';
                        @endif

                        return html;
                    },
                }
            ],
            order: [],
            "initComplete": function(settings, json) {
                $('[data-kt-menu]').each(function() {
                    var menu = new KTMenu(this);
                });
            },
            "columnDefs": [
                @if (Auth::user()->role == 'Admin')
                    {
                        className: "text-nowrap",
                        "targets": [7, 8, 9]
                    }
                @else
                    {
                        className: "text-nowrap",
                        "targets": [5]
                    }
                @endif
            ]

        });

        $("#search_filter").on("keyup", function() {
            datatable.search($(this).val()).draw();
        });

        function reloadDataTable() {

            var currentUrl = '{{ url('task/list') }}';
            var tanggal_mulai = $("#tanggal_mulai_filter").val();
            var tanggal_akhir = $("#tanggal_akhir_filter").val();
            var task_status = $("#task_status_filter").val();
            var pay_status = $("#pay_status_filter").val();

            var newUrl = currentUrl + '?tanggal_mulai_filter=' + tanggal_mulai + '&tanggal_akhir_filter=' + tanggal_akhir + '&task_status_filter=' + task_status + '&pay_status_filter=' + pay_status;
            if ('{{ Auth::user()->role }}' == "Worker") {
                newUrl += '&worker_id_filter={{ Auth::user()->id }}';
            }
            datatable.ajax.url(newUrl).load(function() {
                $('[data-kt-menu]').each(function() {
                    var menu = new KTMenu(this);
                });
            });
        }

        function exportTask() {
            var tanggal_mulai = $("#tanggal_mulai_filter").val();
            var tanggal_akhir = $("#tanggal_akhir_filter").val();
            var task_status = $("#task_status_filter").val();
            var pay_status = $("#pay_status_filter").val();
            var search = $("#search_filter").val();

            var url = "{{ url('task/export') }}";
            url += '?search_filter=' + search + '&tanggal_mulai_filter=' + tanggal_mulai + '&tanggal_akhir_filter=' + tanggal_akhir + '&task_status_filter=' + task_status + '&pay_status_filter=' + pay_status;

            window.location.href = url;
        }

        $("#form_add").submit(function(e) {
            $("#btn_add").prop("disabled", true);

            $("#client_id_add").removeClass('is-invalid');
            $("#worker_id_add").removeClass('is-invalid');
            $("#task_add").removeClass('is-invalid');
            $("#order_add").removeClass('is-invalid');
            $("#deadline_add").removeClass('is-invalid');
            $("#price_order_add").removeClass('is-invalid');
            $("#pay_worker_add").removeClass('is-invalid');
            $("#task_status_add").removeClass('is-invalid');
            $("#pay_status_add").removeClass('is-invalid');

            var formdata = new FormData(this);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                cache: false,
                contentType: false,
                processData: false,
                method: 'post',
                url: "{{ url('task/add') }}",
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
                                $('#client_id_add').val('').change();
                                $('#worker_id_add').val('').change();
                                $('#task_status_add').val('').change();
                                $('#pay_status_add').val('').change();
                                $('#modal_add').modal('hide');
                                reloadDataTable();
                            }
                        });
                        setTimeout(function() {
                            Swal.close();
                            $('#form_add')[0].reset();
                            $('#client_id_add').val('').change();
                            $('#worker_id_add').val('').change();
                            $('#task_status_add').val('').change();
                            $('#pay_status_add').val('').change();
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

                        if (errorResponse.errors && errorResponse.errors.client_id) {
                            let errors = errorResponse.errors;
                            $("#client_id_add").addClass('is-invalid');
                            $("#error_client_id_add").html(errors.client_id[0]);
                        }
                        if (errorResponse.errors && errorResponse.errors.worker_id) {
                            let errors = errorResponse.errors;
                            $("#worker_id_add").addClass('is-invalid');
                            $("#error_worker_id_add").html(errors.worker_id[0]);
                        }
                        if (errorResponse.errors && errorResponse.errors.task) {
                            let errors = errorResponse.errors;
                            $("#task_add").addClass('is-invalid');
                            $("#error_task_add").html(errors.task[0]);
                        }
                        if (errorResponse.errors && errorResponse.errors.order) {
                            let errors = errorResponse.errors;
                            $("#order_add").addClass('is-invalid');
                            $("#error_order_add").html(errors.order[0]);
                        }
                        if (errorResponse.errors && errorResponse.errors.deadline) {
                            let errors = errorResponse.errors;
                            $("#deadline_add").addClass('is-invalid');
                            $("#error_deadline_add").html(errors.deadline[0]);
                        }
                        if (errorResponse.errors && errorResponse.errors.price_order) {
                            let errors = errorResponse.errors;
                            $("#price_order_add").addClass('is-invalid');
                            $("#error_price_order_add").html(errors.price_order[0]);
                        }
                        if (errorResponse.errors && errorResponse.errors.pay_worker) {
                            let errors = errorResponse.errors;
                            $("#pay_worker_add").addClass('is-invalid');
                            $("#error_pay_worker_add").html(errors.pay_worker[0]);
                        }
                        if (errorResponse.errors && errorResponse.errors.task_status) {
                            let errors = errorResponse.errors;
                            $("#task_status_add").addClass('is-invalid');
                            $("#error_task_status_add").html(errors.task_status[0]);
                        }
                        if (errorResponse.errors && errorResponse.errors.pay_status) {
                            let errors = errorResponse.errors;
                            $("#pay_status_add").addClass('is-invalid');
                            $("#error_pay_status_add").html(errors.pay_status[0]);
                        }

                    } else {
                        errorAjaxResponse(response);
                    }
                }
            });
            e.preventDefault();
        });

        function editData(id) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                url: "{{ url('task/detail') }}/" + id,
                dataType: 'json',
                success: function(response) {
                    if (response.status == 1) {
                        data = response.task;
                        console.log(data);
                        $("#id_edit").val(data.id);
                        $("#client_id_edit").select2("trigger", "select", {
                            data: {
                                id: data.client_id,
                                text: data.customer
                            }
                        });
                        $("#worker_id_edit").select2("trigger", "select", {
                            data: {
                                id: data.worker_id,
                                text: data.worker
                            }
                        });
                        $("#task_edit").val(data.task);
                        $("#order_edit").val(data.order);
                        $("#deadline_edit").val(data.deadline);
                        $("#price_order_edit").val(data.price_order);
                        $("#pay_worker_edit").val(data.pay_worker);
                        $("#task_status_edit").val(data.task_status).change();
                        $("#pay_status_edit").val(data.pay_status).change();
                        $("#modal_edit").modal("show");
                    } else {
                        Swal.fire("Oops!", response.msg, "error");
                    }
                },
                error: function(response) {
                    errorAjaxResponse(response);
                }
            });
        }

        $("#form_edit").submit(function(e) {
            $("#btn_edit").prop("disabled", true);

            $("#client_id_edit").removeClass('is-invalid');
            $("#worker_id_edit").removeClass('is-invalid');
            $("#task_edit").removeClass('is-invalid');
            $("#order_edit").removeClass('is-invalid');
            $("#deadline_edit").removeClass('is-invalid');
            $("#price_order_edit").removeClass('is-invalid');
            $("#pay_worker_edit").removeClass('is-invalid');
            $("#task_status_edit").removeClass('is-invalid');
            $("#pay_status_edit").removeClass('is-invalid');

            var formdata = new FormData(this);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                cache: false,
                contentType: false,
                processData: false,
                method: 'post',
                url: "{{ url('task/edit') }}",
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
                                $('#client_id_edit').val('').change();
                                $('#worker_id_edit').val('').change();
                                $('#task_status_edit').val('').change();
                                $('#pay_status_edit').val('').change();
                                $('#modal_edit').modal('hide');
                                reloadDataTable();
                            }
                        });
                        setTimeout(function() {
                            Swal.close();
                            $('#form_edit')[0].reset();
                            $('#client_id_edit').val('').change();
                            $('#worker_id_edit').val('').change();
                            $('#task_status_edit').val('').change();
                            $('#pay_status_edit').val('').change();
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

                        if (errorResponse.errors && errorResponse.errors.client_id) {
                            let errors = errorResponse.errors;
                            $("#client_id_edit").addClass('is-invalid');
                            $("#error_client_id_edit").html(errors.client_id[0]);
                        }
                        if (errorResponse.errors && errorResponse.errors.worker_id) {
                            let errors = errorResponse.errors;
                            $("#worker_id_edit").addClass('is-invalid');
                            $("#error_worker_id_edit").html(errors.worker_id[0]);
                        }
                        if (errorResponse.errors && errorResponse.errors.task) {
                            let errors = errorResponse.errors;
                            $("#task_edit").addClass('is-invalid');
                            $("#error_task_edit").html(errors.task[0]);
                        }
                        if (errorResponse.errors && errorResponse.errors.order) {
                            let errors = errorResponse.errors;
                            $("#order_edit").addClass('is-invalid');
                            $("#error_order_edit").html(errors.order[0]);
                        }
                        if (errorResponse.errors && errorResponse.errors.deadline) {
                            let errors = errorResponse.errors;
                            $("#deadline_edit").addClass('is-invalid');
                            $("#error_deadline_edit").html(errors.deadline[0]);
                        }
                        if (errorResponse.errors && errorResponse.errors.price_order) {
                            let errors = errorResponse.errors;
                            $("#price_order_edit").addClass('is-invalid');
                            $("#error_price_order_edit").html(errors.price_order[0]);
                        }
                        if (errorResponse.errors && errorResponse.errors.pay_worker) {
                            let errors = errorResponse.errors;
                            $("#pay_worker_edit").addClass('is-invalid');
                            $("#error_pay_worker_edit").html(errors.pay_worker[0]);
                        }
                        if (errorResponse.errors && errorResponse.errors.task_status) {
                            let errors = errorResponse.errors;
                            $("#task_status_edit").addClass('is-invalid');
                            $("#error_task_status_edit").html(errors.task_status[0]);
                        }
                        if (errorResponse.errors && errorResponse.errors.pay_status) {
                            let errors = errorResponse.errors;
                            $("#pay_status_edit").addClass('is-invalid');
                            $("#error_pay_status_edit").html(errors.pay_status[0]);
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
                        url: "{{ url('task/delete') }}",
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

        function editPay(id) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                url: "{{ url('task/detail') }}/" + id,
                dataType: 'json',
                success: function(response) {
                    if (response.status == 1) {
                        data = response.task;
                        console.log(data);
                        $("#id_edit_pay").val(data.id);
                        $("#task_edit_pay").val(data.task);
                        $("#pay_worker_edit_pay").val(data.pay_worker);
                        $("#price_order_edit_pay").val(data.price_order);
                        $("#modal_edit_pay").modal("show");
                    } else {
                        Swal.fire("Oops!", response.msg, "error");
                    }
                },
                error: function(response) {
                    errorAjaxResponse(response);
                }
            });
        }
        $("#form_edit_pay").submit(function(e) {
            $("#btn_edit_pay").prop("disabled", true);
            $("#pay_worker_edit_pay").removeClass('is-invalid');

            var formdata = new FormData(this);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                cache: false,
                contentType: false,
                processData: false,
                method: 'post',
                url: "{{ url('task/edit-pay') }}",
                data: formdata,
                dataType: 'json',
                success: function(response) {
                    $("#btn_edit_pay").prop("disabled", false);
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
                                $('#form_edit_pay')[0].reset();
                                $('#modal_edit_pay').modal('hide');
                                reloadDataTable();
                            }
                        });
                        setTimeout(function() {
                            Swal.close();
                            $('#form_edit_pay')[0].reset();
                            $('#modal_edit_pay').modal('hide');
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
                    $("#btn_edit_pay").prop("disabled", false);
                    if (response.status == 422) {
                        let errorResponse = JSON.parse(response.responseText);


                        if (errorResponse.errors && errorResponse.errors.pay_worker) {
                            let errors = errorResponse.errors;
                            $("#pay_worker_edit_pay").addClass('is-invalid');
                            $("#error_pay_worker_edit_pay").html(errors.pay_worker[0]);
                        }

                    } else {
                        errorAjaxResponse(response);
                    }
                }
            });
            e.preventDefault();
        });

        function editStatus(id, status) {
            $("#id_edit_status").val(id);
            $("#task_status_edit_status").val(status).change();
            $("#modal_edit_status").modal("show");
        }
        $("#form_edit_status").submit(function(e) {
            $("#btn_edit_status").prop("disabled", true);
            $("#task_status_edit_status").removeClass('is-invalid');

            var formdata = new FormData(this);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                cache: false,
                contentType: false,
                processData: false,
                method: 'post',
                url: "{{ url('task/edit-status') }}",
                data: formdata,
                dataType: 'json',
                success: function(response) {
                    $("#btn_edit_status").prop("disabled", false);
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
                                $('#form_edit_status')[0].reset();
                                $('#modal_edit_status').modal('hide');
                                reloadDataTable();
                            }
                        });
                        setTimeout(function() {
                            Swal.close();
                            $('#form_edit_status')[0].reset();
                            $('#modal_edit_status').modal('hide');
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
                    $("#btn_edit_status").prop("disabled", false);
                    if (response.status == 422) {
                        let errorResponse = JSON.parse(response.responseText);


                        if (errorResponse.errors && errorResponse.errors.task_status) {
                            let errors = errorResponse.errors;
                            $("#task_status_edit_status").addClass('is-invalid');
                            $("#error_task_status_edit_status").html(errors.task_status[0]);
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
