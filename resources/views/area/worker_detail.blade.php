@extends('area._base')
@push('head')
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-3">
            <div class="card" id="card1">
                <div class="card-body">
                    <p style="margin: 0px"><b>{{ $worker->fullname }}</b></p>
                    <p class="text-muted" style="margin: 0px"><i class="fas fa-map-marker-alt mr-2"></i>{{ empty($worker->asal) ? '-' : $worker->asal }}</p>
                    <p class="text-muted" style="margin: 0px"><i class="fas fa-phone mr-2"></i>{{ empty($worker->handphone) ? '-' : $worker->handphone }}</p>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card" id="card2">
                <div class="card-body text-center d-flex">
                    <div class="m-auto">
                        <h2 style="margin: 0px">{{ rupiah($worker->total) }}</h2>
                        <p style="margin: 0px">Total Order</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card" id="card3">
                <div class="card-body text-center d-flex">
                    <div class="m-auto">
                        <h2 style="margin: 0px">{{ rupiah($worker->pay, true) }}</h2>
                        <p style="margin: 0px">Total Pay Worker</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card" id="card4">
                <div class="card-body text-center d-flex">
                    <div class="m-auto">
                        <h2 style="margin: 0px">{{ rupiah($worker->margin, true) }}</h2>
                        <p style="margin: 0px">Total Margin</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-0">
        <div class="card-header">
            <h4>Data Task Worker</h4>
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
            <div class="table-responsive">
                <table class="table table-striped" id="table-1" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Kode</th>
                            <th>Customer</th>
                            <th>Worker</th>
                            <th>Deskripsi</th>
                            <th>Tanggal Order</th>
                            <th>Deadline</th>
                            <th>Price Order</th>
                            <th>Pay to Worker</th>
                            <th>Margin</th>
                            <th>Task Status</th>
                            <th>Pay Status</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('modal')
@endsection
@push('js')
    <script>
        window.onload = function() {
            var card1Height = document.getElementById('card1').clientHeight;
            document.getElementById('card2').style.height = card1Height + 'px';
            document.getElementById('card3').style.height = card1Height + 'px';
            document.getElementById('card4').style.height = card1Height + 'px';
        };
        $(document).ready(function() {
            $('#pay_status_filter').select2({
                width: '100%',
            });
            $('#task_status_filter').select2({
                width: '100%',
            });

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
        });

        var tanggal_mulai = $("#tanggal_mulai_filter").val();
        var tanggal_akhir = $("#tanggal_akhir_filter").val();
        var task_status = $("#task_status_filter").val();
        var pay_status = $("#pay_status_filter").val();

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
                url: '{{ url('task/list') }}' + '?tanggal_mulai_filter=' + tanggal_mulai + '&tanggal_akhir_filter=' + tanggal_akhir + '&task_status_filter=' + task_status + '&pay_status_filter=' + pay_status + '&worker_id_filter={{ $worker->id }}',
            },
            columns: [{
                "data": "DT_RowIndex",
                "name": "DT_RowIndex",
                "orderable": false,
                "searchable": false
            }, {
                data: 'kode_task',
                name: 'kode_task',
            }, {
                data: 'customer',
                name: 'client.customer',
            }, {
                data: 'fullname',
                name: 'users.fullname',
            }, {
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
            }, {
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
            }, {
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

            }, ],
            order: [],
            "initComplete": function(settings, json) {
                $('[data-kt-menu]').each(function() {
                    var menu = new KTMenu(this);
                });
            },
            "columnDefs": [{
                className: "text-nowrap",
                "targets": [7, 8, 9]
            }]
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

            var newUrl = currentUrl + '?tanggal_mulai_filter=' + tanggal_mulai + '&tanggal_akhir_filter=' + tanggal_akhir + '&task_status_filter=' + task_status + '&pay_status_filter=' + pay_status + '&worker_id_filter={{ $worker->id }}';
            datatable.ajax.url(newUrl).load(function() {
                $('[data-kt-menu]').each(function() {
                    var menu = new KTMenu(this);
                });
            });
        }
    </script>
@endpush
