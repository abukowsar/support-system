@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-xl-3 col-lg-6">
            <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">{{ _t(__('message.tickets_type',['name'=>''])) }}</h5>
                            <span class="h2 font-weight-bold mb-0">{{ $dashboard['count_ticket'] }}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-danger text-white rounded-circle shadow">
                                <i class="ni ni-archive-2"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                        <span class="text-success mr-2"></span>
                        <span class="text-nowrap"></span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6">
            <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">{{ _t(__('message.tickets_type',['Name' => __('message.open')])) }}</h5>
                            <span class="h2 font-weight-bold mb-0">{{ $dashboard['count_open_ticket'] }}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-info text-white rounded-circle shadow">
                                <i class="ni ni-archive-2"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                        <span class="text-success mr-2"></span>
                        <span class="text-nowrap"></span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6">
            <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">{{ _t(__('message.tickets_type',['Name' => __('message.solved')])) }}</h5>
                            <span class="h2 font-weight-bold mb-0">{{ $dashboard['count_solved_ticket'] }}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-warning text-white rounded-circle shadow">
                                <i class="fas fa-chart-pie"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                        <span class="text-danger mr-2"></span>
                        <span class="text-nowrap"></span>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6">
            <div class="card card-stats mb-4 mb-xl-0">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">{{ _t(__('message.tickets_type',['name' => __('message.closed')])) }}</h5>
                            <span class="h2 font-weight-bold mb-0">{{ $dashboard['count_closed_ticket'] }}</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
                                <i class="fas fa-chart-pie"></i>
                            </div>
                        </div>
                    </div>
                    <p class="mt-3 mb-0 text-muted text-sm">
                        <span class="text-warning mr-2"></span>
                        <span class="text-nowrap"></span>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-xl-12 mb-5 mb-xl-0">
            <div class="card shadow">
                <div class="card-header bg-transparent">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="text-uppercase text-light ls-1 mb-1">{{ _t(__('message.overview')) }}</h6>
                            <h3 class="mb-0">
                                {{ _t(__('message.tickets_type',['name'=>__('message.open')])) }} ,

                                {{ _t(__('message.tickets_type',['name' => __('message.solved')])) }} ,

                                {{ _t(__('message.tickets_type',['name' => __('message.closed')])) }}
                            </h3>
                        </div>
                        <div class="col">
                            <ul class="nav nav-pills justify-content-end">
                                <li class="nav-item mr-2 mr-md-0" data-toggle="chart" data-target="#chart-sales"
                                    data-update='{"data":{"datasets":[{"data":[0, 20, 10, 30, 15, 40, 20, 60, 60]}]}}'
                                    data-prefix="$" data-suffix="k">
                                </li>
                                <li class="nav-item" data-toggle="chart" data-target="#chart-sales"
                                    data-update='{"data":{"datasets":[{"data":[0, 20, 5, 25, 10, 30, 15, 40, 40]}]}}'
                                    data-prefix="$" data-suffix="k">
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Chart -->
                    <div class="chart">
                        <!-- Chart wrapper -->
                        <canvas id="chart-listing"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="row mt-5">
        <div class="col-xl-12 mb-5 mb-xl-0">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">{{ _t(__('message.lists',['name' => __('message.ticket')])) }}</h3>
                        </div>
                        <div class="col text-right">
                            <a href="{{ route('support.ticket.list', ['type' => 'all']) }}"
                               class="btn btn-sm btn-primary">{{ trans('message.see_all') }}</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <!-- Projects table -->
                    <table class="table align-items-center table-flush">
                        <thead class="thead-light">
                        <tr>
                            <th scope="col">{{ _t(__('message.id')) }}</th>
                            <th scope="col">{{ _t(__('message.date')) }}</th>
                            <th scope="col">{{ _t(__('message.subject')) }}</th>
                            <th scope="col">{{ _t(__('message.requester')) }}</th>
                            <th scope="col">{{ _t(__('message.department')) }}</th>
                            <th scope="col">{{ _t(__('message.action')) }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(count($ticketListings) > 0)
                            @foreach($ticketListings as $list)
                                <tr>
                                    <td>{{ $list->id }}</td>
                                    <td>{{ date('d-m-Y',strtotime($list->created_at)) }}</td>
                                    <td>{{ _t(stringLong($list->subject)) }}</td>
                                    <td>{{ _t(optional($list->users)->name) }}</td>

                                    <td>{{ _t(optional($list->departments)->department_name)  }}</td>
                                    <td>
                                        <a href="{{ route('support.ticket.edit', $list->id) }}" class="table-action">
                                            <span class="badge badge-info mr-2">
                                                {{ _t(__('message.view')) }}
                                            </span>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td class="text-center"
                                    colspan="8">{{ trans('message.no_data_available_in_table') }}</td>
                            </tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('body_bottom')
    <script>

        (function ($) {

            "use strict";
            var barChartData = {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                datasets: [
                    {
                        label: "{{ _t(__('message.tickets_type',['name' => __('message.open')])) }} ",
                        backgroundColor: "lightblue",
                        borderColor: "blue",
                        borderWidth: 1,
                        data: [ {{ implode ( ',' ,$countData['list'] ) }} ]
                    },
                    {
                        label: "{{ _t(__('message.tickets_type',['name' => __('message.solved')])) }} ",
                        backgroundColor: "lightgreen",
                        borderColor: "green",
                        borderWidth: 1,
                        data: [ {{ implode ( ',' , $countData['solved'] ) }} ]
                    },
                    {
                        label: "{{ _t(__('message.tickets_type',['name' => __('message.closed')])) }} ",
                        backgroundColor: "yellow",
                        borderColor: "orange",
                        borderWidth: 1,
                        data: [ {{ implode ( ',' ,$countData['closed'] )}} ]
                    }
                ]
            };

            var chartOptions = {
                responsive: true,
                legend: {
                    position: 'top',
                    display: true,
                },
                tooltips: {
                    mode: 'point'
                },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            SuggestedMax: {{ $maxTick }}
                        }
                    }]
                }
            }

            window.onload = function () {
                var ctx = document.getElementById("chart-listing").getContext("2d");

                window.myBar = new Chart(ctx, {
                    type: "bar",
                    data: barChartData,
                    options: chartOptions,
                });
            };

        })(jQuery);

    </script>
@endsection
