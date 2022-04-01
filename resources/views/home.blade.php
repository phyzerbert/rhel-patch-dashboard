@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        {{-- <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div> --}}

        <div class="col-md-6 mb-4">
            <div class="card z-index-2">
                <div class="card-header p-3 pb-0">
                    <h6>Inventory Count</h6>
                </div>
                <div class="card-body p-3">
                    <div class="chart">
                        <canvas id="chart-inventory-count" class="chart-canvas" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 mb-4">
            <div class="card z-index-2">
                <div class="card-header p-3 pb-0">
                    <h6>Application Count</h6>
                </div>
                <div class="card-body p-3">
                    <div class="chart">
                        <canvas id="chart-application-count" class="chart-canvas" height="300"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card z-index-2">
                <div class="card-header p-3 pb-0">
                    <h6>Patch Timeline</h6>
                </div>
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <table class="table table-flush" id="datatable-timeline">
                            <thead class="thead-light">
                                <tr>
                                    <th>Hostname</th>
                                    <th>Patch Timeline</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($timelines as $item)
                                    <tr>
                                        <td class="font-weight-normal text-sm">{{$item->server_name}}</td>
                                        <td class="font-weight-normal text-sm">{{$item->patch_timeline}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                      </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 mb-4">
            <div class="card z-index-2">
                <div class="card-header p-3 pb-0">
                    <h6>All Servers</h6>
                </div>
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <table class="table table-flush" id="datatable-servers">
                            <thead class="thead-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Missing Updates</th>
                                    <th>Installed Packages</th>
                                    <th>Last Installation</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($servers as $item)
                                    @php
                                        $lastTimeline = $item->timelines()->orderBy('patch_timeline', 'desc')->first();
                                        $lastInstalledDate = $lastTimeline ? \Carbon\Carbon::parse($lastTimeline->patch_timeline)->format('d-M-y') : '';
                                    @endphp
                                    <tr>
                                        <td class="font-weight-normal text-sm">{{$item->name}}</td>
                                        <td class="font-weight-normal text-sm">{{$item->installable_updates_package_count}}</td>
                                        <td class="font-weight-normal text-sm">{{$item->application->packages_installed ?? 0}}</td>
                                        <td class="font-weight-normal text-sm">{{$lastInstalledDate}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                      </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="{{asset('assets/js/plugins/chartjs.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/datatables.js')}}"></script>
    <script>
        // Inventory Count
        var inventoryCount = document.getElementById("chart-inventory-count").getContext("2d");

        new Chart(inventoryCount, {
            type: "bar",
            data: {
                labels: {!! json_encode($os_array) !!},
                datasets: [{
                    label: "Inventory Count",
                    weight: 5,
                    borderWidth: 0,
                    borderRadius: 4,
                    backgroundColor: '#3A416F',
                    data: {!! json_encode($inventory_count) !!},
                    fill: false,
                }],
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false,
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                let label = context.dataset.label;
                                let value = context.dataset.data[context.dataIndex];
                                let labels = [label + ': ' + value, '']
                                var inventoryServers = {!! json_encode($inventory_servers) !!}
                                return labels.concat(inventoryServers[context.dataIndex])
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#9ca2b7'
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: true,
                            drawTicks: true,
                        },
                        ticks: {
                            display: true,
                            color: '#9ca2b7',
                            padding: 10
                        }
                    },
                },
            },
        });

        // Application
        var applicationCount = document.getElementById("chart-application-count").getContext("2d");

        new Chart(applicationCount, {
            type: "bar",
            data: {
                labels: {!! json_encode($server_array) !!},
                datasets: [{
                    label: "Application Count",
                    weight: 5,
                    borderWidth: 0,
                    borderRadius: 4,
                    backgroundColor: '#3A416F',
                    data: {!! json_encode($application_count) !!},
                    fill: false
                }],
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                legend: {
                    display: false,
                }
                },
                scales: {
                    y: {
                        grid: {
                            drawBorder: false,
                            display: true,
                            drawOnChartArea: true,
                            drawTicks: false,
                            borderDash: [5, 5]
                        },
                        ticks: {
                            display: true,
                            padding: 10,
                            color: '#9ca2b7'
                        }
                    },
                    x: {
                        grid: {
                            drawBorder: false,
                            display: false,
                            drawOnChartArea: true,
                            drawTicks: true,
                        },
                        ticks: {
                            display: true,
                            color: '#9ca2b7',
                            padding: 10
                        }
                    },
                },
            },
        });

    </script>
    {{-- DataTables --}}
    <script>
        const dataTableTimeline = new simpleDatatables.DataTable("#datatable-timeline", {
            searchable: true,
            fixedHeight: true
        });
        const dataTableServers = new simpleDatatables.DataTable("#datatable-servers", {
            searchable: true,
            fixedHeight: true
        });
    </script>
@endsection
