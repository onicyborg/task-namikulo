@extends('area._base')
@push('head')
@endpush
@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Calendar</h4>
        </div>
        <div class="card-body">
            @if (Auth::user()->role == 'Admin')
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label>Worker</label>
                            <select name="worker_id" id="worker_id" class="form-control" onchange="loadCalendar()">
                            </select>
                        </div>
                    </div>
                </div>
            @endif
            <div id="calendar">

            </div>
        </div>
    </div>
@endsection
@section('modal')
    {{-- modal detail calendar --}}
    <div class="modal fade" id="modal_detail_calendar" role="dialog" aria-labelledby="formModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModal">Detail Data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="d-block d-md-flex justify-content-between">
                        <p class="m-0 mr-3">Kode</p>
                        <p class="m-0 text-muted" id="kode_detail"></p>
                    </div>
                    <div class="mt-3 d-block d-md-flex justify-content-between">
                        <p class="m-0 mr-3">Deskripsi</p>
                        <p class="m-0 text-muted" id="task_detail"></p>
                    </div>
                    <div class="mt-3 d-block d-md-flex justify-content-between">
                        <p class="m-0 mr-3">Client</p>
                        <p class="m-0 text-muted" id="client_detail"></p>
                    </div>
                    @if (Auth::user()->role == 'Admin')
                        <div class="mt-3 d-block d-md-flex justify-content-between">
                            <p class="m-0 mr-3">Worker</p>
                            <p class="m-0 text-muted" id="worker_detail"></p>
                        </div>
                        <div class="mt-3 d-block d-md-flex justify-content-between">
                            <p class="m-0 mr-3">Tanggal Order</p>
                            <p class="m-0 text-muted" id="order_detail"></p>
                        </div>
                    @endif
                    <div class="mt-3 d-block d-md-flex justify-content-between">
                        <p class="m-0 mr-3">Deadline</p>
                        <p class="m-0 text-muted" id="deadline_detail"></p>
                    </div>
                    @if (Auth::user()->role == 'Admin')
                        <div class="mt-3 d-block d-md-flex justify-content-between">
                            <p class="m-0 mr-3">Price Order</p>
                            <p class="m-0 text-muted" id="price_order_detail"></p>
                        </div>
                    @endif

                    <div class="mt-3 d-block d-md-flex justify-content-between">
                        <p class="m-0 mr-3">Pay to Worker</p>
                        <p class="m-0 text-muted" id="pay_worker_detail"></p>
                    </div>
                    @if (Auth::user()->role == 'Admin')
                        <div class="mt-3 d-block d-md-flex justify-content-between">
                            <p class="m-0 mr-3">Margin</p>
                            <p class="m-0 text-muted" id="margin_detail"></p>
                        </div>
                    @endif

                    <div class="mt-3 d-block d-md-flex justify-content-between">
                        <p class="m-0 mr-3">Task Status</p>
                        <p class="m-0 text-muted" id="task_status_detail"></p>
                    </div>
                    <div class="mt-3 d-block d-md-flex justify-content-between">
                        <p class="m-0 mr-3">Pay Status</p>
                        <p class="m-0 text-muted" id="pay_status_detail"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- modal detail calendar --}}
@endsection
@push('js')
    <script src='{{ asset('assets/fullcalendar/fullcalendar.js') }}'></script>
    <script>
        $(document).ready(function() {
            $('#worker_id').select2({
                width: '100%',
                ajax: {
                    url: '{{ url('worker/search') }}',
                    data: {
                        'empty_result': 'true'
                    },
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

            $("#worker_id").select2("trigger", "select", {
                data: {
                    id: 'all',
                    text: 'Seluruh Worker'
                }
            });
        });

        var calendar;
        var date_start;
        var date_end;
        var todayDate = moment().startOf('day');
        var YM = todayDate.format('YYYY-MM');
        var YESTERDAY = todayDate.clone().subtract(1, 'day').format('YYYY-MM-DD');
        var TODAY = todayDate.format('YYYY-MM-DD');
        var TOMORROW = todayDate.clone().add(1, 'day').format('YYYY-MM-DD');

        var calendarEl = document.getElementById('calendar');
        calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,listMonth'
            },
            height: 800,
            contentHeight: 780,
            aspectRatio: 3,
            nowIndicator: true,
            now: TODAY + 'T09:25:00', // just for demo
            views: {
                dayGridMonth: {
                    buttonText: 'month'
                }
            },
            initialView: 'dayGridMonth',
            initialDate: TODAY,
            editable: false,
            dayMaxEvents: true,
            navLinks: true,
            datesSet: function(info) {
                var start = info.startStr;
                var end = info.endStr;
                date_start = start;
                date_end = end;
                loadCalendar()
            },
            eventClick: function(info) {
                detailCalendar(info.event.id)
            },
            eventDidMount: function(info) {
                var eventEl = info.el;
                var event = info.event;

                eventEl.style.backgroundColor = event.backgroundColor;
                eventEl.style.borderColor = event.borderColor; // Opsional, jika Anda ingin mengatur warna border
                eventEl.style.color = event.textColor; // Opsional, jika Anda ingin mengatur warna teks
            }

        });
        calendar.render();

        function loadCalendar() {
            var worker_id = $("#worker_id").val();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "GET",
                url: "{{ url('task/get-by-date') }}",
                data: {
                    start: date_start,
                    end: date_end,
                    worker_id: worker_id
                },
                dataType: 'json',
                success: function(response) {
                    if (response.status == 1) {
                        var data = response.task;
                        var currentEvents = calendar.getEvents();
                        currentEvents.forEach(function(event) {
                            event.remove();
                        });
                        var events = [];
                        data.forEach(function(task) {
                            var event = {
                                id: task.id,
                                title: task.fullname + ' - ' + task.task,
                                start: task.deadline,
                                end: task.deadline,
                                description: task.task,
                                className: "text-left mx-1 mb-1 px-1",
                                backgroundColor: task.hex,
                                borderColor: task.hex,
                                textColor: "#FFFFFF",
                                allDay: true
                            };
                            events.push(event);
                        });

                        calendar.addEventSource(events);

                    } else {
                        Swal.fire("Oops!", response.msg, "error");
                    }
                },
                error: function(response) {
                    errorAjaxResponse(response);
                }
            });
        }

        function detailCalendar(id) {
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
                        $("#kode_detail").html(data.kode_task);
                        $("#task_detail").html(data.task);
                        $("#client_detail").html(data.customer);
                        @if (Auth::user()->role == 'Admin')

                            $("#order_detail").html(data.order_indo);
                            $("#worker_detail").html(data.worker);
                            $("#price_order_detail").html(idrFormat(data.price_order, true));
                            $("#margin_detail").html(idrFormat(data.margin, true));
                        @endif
                        $("#deadline_detail").html(data.deadline_indo);
                        $("#pay_worker_detail").html(idrFormat(data.pay_worker, true));
                        $("#task_status_detail").html(data.task_status);
                        $("#pay_status_detail").html(data.pay_status);
                        $("#modal_detail_calendar").modal("show");
                    } else {
                        Swal.fire("Oops!", response.msg, "error");
                    }
                },
                error: function(response) {
                    errorAjaxResponse(response);
                }
            });
        }
    </script>
@endpush
