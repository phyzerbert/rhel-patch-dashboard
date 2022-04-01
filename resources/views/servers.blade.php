@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3>Servers @if ($os) - {{$os}} @endif</h3>
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
                                    @foreach ($data as $item)
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
    <script src="{{asset('assets/js/plugins/datatables.js')}}"></script>
    <script>
        const dataTableServers = new simpleDatatables.DataTable("#datatable-servers", {
            searchable: true,
            fixedHeight: true
        });
    </script>
@endsection