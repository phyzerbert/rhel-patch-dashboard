@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex">
                            <h4 class="mb-0"><i class="fa fa-ethernet"></i> Site Code Subnets</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-flush" id="datatable-capsule-servers">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Site</th>
                                        <th>Site Code</th>
                                        <th>Business Unit Site ID</th>
                                        <th>Domain</th>
                                        <th>New Code</th>
                                        <th>Subnet</th>
                                        <th>vlan tag</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td class="font-weight-normal text-sm" style="width: 80px;">{{$loop->index + 1}}</td>
                                            <td class="font-weight-normal text-sm name">{{$item->site}}</td>
                                            <td class="font-weight-normal text-sm name">{{$item->site_code}}</td>
                                            <td class="font-weight-normal text-sm name">{{$item->business_unit_site_id}}</td>
                                            <td class="font-weight-normal text-sm name">{{$item->domain}}</td>
                                            <td class="font-weight-normal text-sm name">{{$item->new_code}}</td>
                                            <td class="font-weight-normal text-sm name">{{$item->sub_net}}</td>
                                            <td class="font-weight-normal text-sm name">{{$item->vlan_tag}}</td>
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