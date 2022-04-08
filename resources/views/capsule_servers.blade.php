@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex">
                            <h4 class="mb-0"><i class="fa fa-capsules"></i> Capsule Servers</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-flush" id="datatable-capsule-servers">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Capsule</th>
                                        <th>Fully qualified domain name</th>
                                        <th>Operating System</th>
                                        <th>Operational status</th>
                                        <th>OS Version</th>
                                        <th>Kernel Release</th>
                                        <th>IP Address</th>
                                        <th>HostedApplication</th>
                                        <th>Support group</th>
                                        <th>Environment</th>
                                        <th>Patching schedule</th>
                                        <th>Location</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td class="font-weight-normal text-sm" style="width: 80px;">{{$loop->index + 1}}</td>
                                            <td class="font-weight-normal text-sm name">{{$item->capsule}}</td>
                                            <td class="font-weight-normal text-sm name">{{$item->fully_qualified_domain_name}}</td>
                                            <td class="font-weight-normal text-sm name">{{$item->operating_system}}</td>
                                            <td class="font-weight-normal text-sm name">{{$item->optional_status}}</td>
                                            <td class="font-weight-normal text-sm name">{{$item->os_version}}</td>
                                            <td class="font-weight-normal text-sm name">{{$item->kernel_release}}</td>
                                            <td class="font-weight-normal text-sm name">{{$item->ip_address}}</td>
                                            <td class="font-weight-normal text-sm name">{{$item->hosted_application}}</td>
                                            <td class="font-weight-normal text-sm name">{{$item->support_group}}</td>
                                            <td class="font-weight-normal text-sm name">{{$item->environment}}</td>
                                            <td class="font-weight-normal text-sm name">{{$item->patching_schedule}}</td>
                                            <td class="font-weight-normal text-sm name">{{$item->location}}</td>
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
        const dataTableSites = new simpleDatatables.DataTable("#datatable-capsule-servers", {
            searchable: true,
            fixedHeight: true
        });
    </script>
@endsection