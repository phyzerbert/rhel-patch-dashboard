@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex">
                            <h4 class="mb-0"><i class="fa fa-list"></i> Patch Installed Dates</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-flush" id="datatable-capsule-servers">
                                <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Server</th>
                                        {{-- <th>File Date</th> --}}
                                        <th>Patch Installed Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td class="font-weight-normal text-sm" style="width: 80px;">{{$loop->index + 1}}</td>
                                            <td class="font-weight-normal text-sm name">{{$item->server_name}}</td>
                                            {{-- <td class="font-weight-normal text-sm name">{{$item->file_date}}</td> --}}
                                            <td class="font-weight-normal text-sm name">{{\Carbon\Carbon::parse($item->patch_installed_date)->format('d M Y')}}</td>
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