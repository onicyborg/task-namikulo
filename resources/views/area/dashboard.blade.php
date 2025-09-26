@extends('area._base')
@push('head')
    {{-- <link rel="stylesheet" href="{{ asset('assets/bundles/fullcalendar/fullcalendar.min.css') }}"> --}}
@endpush
@section('content')
    <div class="row ">
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="card">
                <div class="card-statistic-4">
                    <div class="align-items-center justify-content-between">
                        <div class="row ">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                <div class="card-content">
                                    <h5 class="font-15">Total Task</h5>
                                    <h2 class="mb-3 font-18">{{ $statistik['waiting'] + $statistik['progress'] + $statistik['done'] }}</h2>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                <div class="banner-img">
                                    <img src="{{ asset('assets/img/banner/1.png') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="card">
                <div class="card-statistic-4">
                    <div class="align-items-center justify-content-between">
                        <div class="row ">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                <div class="card-content">
                                    <h5 class="font-15"> Total Waiting</h5>
                                    <h2 class="mb-3 font-18">{{ $statistik['waiting'] }}</h2>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                <div class="banner-img">
                                    <img src="{{ asset('assets/img/banner/2.png') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="card">
                <div class="card-statistic-4">
                    <div class="align-items-center justify-content-between">
                        <div class="row ">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                <div class="card-content">
                                    <h5 class="font-15">Total Done</h5>
                                    <h2 class="mb-3 font-18">{{ $statistik['done'] }}</h2>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                <div class="banner-img">
                                    <img src="{{ asset('assets/img/banner/3.png') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <div class="card">
                <div class="card-statistic-4">
                    <div class="align-items-center justify-content-between">
                        <div class="row ">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                <div class="card-content">
                                    <h5 class="font-15">{{ Auth::user()->role == 'Admin' ? 'Total Margin' : 'Total Revenue (Order' }}</h5>
                                    <h2 class="mb-3 font-18">{{ Auth::user()->role == 'Admin' ? rupiah($statistik['margin'], true) : rupiah($statistik['pay_worker'], true) }}</h2>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                <div class="banner-img">
                                    <img src="{{ asset('assets/img/banner/4.png') }}" alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-sm-12 col-lg-12">
            <div class="card ">
                <div class="card-header">
                    <h4>Statistik Task</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-9">
                            <p class="text-muted">Grafik Task 6 Bulan Terakhir</p>
                            <div id="chart1"></div>
                        </div>
                        <div class="col-lg-3">
                            <p class="text-muted">Statistik Keseluruhan</p>
                            <div class="row">
                                <div class="col-7 col-xl-7 mb-3">Total Task Waiting</div>
                                <div class="col-5 col-xl-5 mb-3">
                                    <span class="text-big">{{ $statistik['waiting'] }}</span>
                                    <sup class="text-warning">Task</sup>
                                </div>
                                <div class="col-7 col-xl-7 mb-3">Total Task Progress</div>
                                <div class="col-5 col-xl-5 mb-3">
                                    <span class="text-big">{{ $statistik['progress'] }}</span>
                                    <sup class="col-blue">Task</sup>
                                </div>
                                <div class="col-7 col-xl-7 mb-3">Total Task Done</div>
                                <div class="col-5 col-xl-5 mb-3">
                                    <span class="text-big">{{ $statistik['done'] }}</span>
                                    <sup class="text-success">Task</sup>
                                </div>
                                @if (Auth::user()->role == 'Admin')
                                    <div class="col-7 col-xl-7 mb-3">Total Price Order</div>
                                    <div class="col-5 col-xl-5 mb-3">
                                        <span class="text-big">{{ rupiah($statistik['price'], true) }}</span>
                                    </div>
                                    <div class="col-7 col-xl-7 mb-3">Total Pay to Worker</div>
                                    <div class="col-5 col-xl-5 mb-3">
                                        <span class="text-big">{{ rupiah($statistik['pay_worker'], true) }}</span>
                                    </div>
                                    <div class="col-7 col-xl-7 mb-3">Total Margin</div>
                                    <div class="col-5 col-xl-5 mb-3">
                                        <span class="text-big">{{ rupiah($statistik['margin'], true) }}</span>
                                    </div>
                                @else
                                    <div class="col-7 col-xl-7 mb-3">Total Revenue</div>
                                    <div class="col-5 col-xl-5 mb-3">
                                        <span class="text-big">{{ rupiah($statistik['pay_worker'], true) }}</span>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4>Timeline</h4>
        </div>
        <div class="card-body" style="max-height: 500px; overflow-y: auto;">
            <div class="row mt-4">
                <div class="col-12">
                    @php
                        $prevMonth = null;
                        if (count($timeline) == 0) {
                            echo '<p class="text-muted">Tidak ada data</p>';
                        }
                    @endphp
                    @foreach ($timeline as $item)
                        @php
                            $currentMonth = bulanIndo(date('m', strtotime($item->deadline))) . ' ' . date('Y', strtotime($item->deadline));
                            if ($currentMonth != $prevMonth) {
                                if ($prevMonth != null) {
                                    echo '</div>';
                                }
                                echo '<div class="activities"><div class="activity-title"><h5> ' . $currentMonth . '</h5> </div>';
                            }

                            if ($item->task_status == 'Waiting') {
                                $status_color = 'text-warning';
                            }
                            if ($item->task_status == 'Progress') {
                                $status_color = 'col-blue';
                            }
                            if ($item->task_status == 'Done') {
                                $status_color = 'text-success';
                            }
                        @endphp
                        <div class="activity">
                            <div class="activity-icon bg-primary text-white">
                                <i class="fas fa-arrows-alt"></i>
                            </div>
                            <div class="activity-detail">
                                <div class="mb-2">
                                    <span class="text-job mr-2">{{ tglIndo($item->deadline) }}</span>
                                    <span class="bullet"></span>
                                    <span class="text-job mr-4">{{ $item->fullname }}</span>
                                    <div class="float-right">
                                        <span class="text-job text-muted">Client : {{ $item->customer }}</span>
                                    </div>
                                </div>
                                <p>{{ $item->task }}</p>
                                <div class="text-right">
                                    <span class="{{ $status_color }}" style="font-size: 12px">{{ $item->task_status }}</span>
                                </div>
                            </div>
                        </div>

                        @php
                            $prevMonth = $currentMonth;
                        @endphp
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
@section('modal')
@endsection
@push('js')
    <script src="{{ asset('assets/bundles/apexcharts/apexcharts.min.js') }}"></script>
    <script>
        $(function() {
            chart1();
        });


        function chart1() {

            const grafik = @json($grafik);
            const bulan = [];
            const waiting = [];
            const progress = [];
            const done = [];

            grafik.forEach((item) => {
                bulan.push(item.bulan);
                waiting.push(parseInt(item.waiting));
                progress.push(parseInt(item.progress));
                done.push(parseInt(item.done));
            });
            const maxDataValue = Math.max(...waiting, ...progress, ...done);

            var options = {
                chart: {
                    height: 300,
                    type: "line",
                    shadow: {
                        enabled: true,
                        color: "#000",
                        top: 18,
                        left: 7,
                        blur: 10,
                        opacity: 1
                    },
                    toolbar: {
                        show: false
                    }
                },
                colors: ["#ffc107", "#6777ef", "#54ca68"],
                dataLabels: {
                    enabled: true,
                },
                stroke: {
                    curve: "smooth"
                },
                series: [{
                        name: "Waiting",
                        data: waiting
                    },
                    {
                        name: "Progress",
                        data: progress
                    }, {
                        name: "Done",
                        data: done
                    },
                ],
                grid: {
                    borderColor: "#e7e7e7",
                    row: {
                        colors: ["#f3f3f3", "transparent"], // takes an array which will be repeated on columns
                        opacity: 0.0
                    }
                },
                markers: {
                    size: 6
                },
                xaxis: {
                    categories: bulan,
                    tickPlacement: 'between',
                    labels: {
                        style: {
                            colors: "#9aa0ac"
                        },

                    },
                },
                yaxis: {
                    title: {
                        text: "Total"
                    },
                    labels: {
                        style: {
                            color: "#9aa0ac"
                        }
                    },
                    max: maxDataValue + (maxDataValue * 0.1)

                },
                legend: {
                    show: false,
                },
                fill: {
                    opacity: 1
                },
            };

            var chart = new ApexCharts(document.querySelector("#chart1"), options);

            chart.render();
        }
    </script>
@endpush
