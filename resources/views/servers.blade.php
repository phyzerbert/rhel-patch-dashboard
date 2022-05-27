@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex">
                            <h4 class="mb-0"><i class="fa fa-server"></i> Servers @if ($os) - {{$os}} @endif</h4>
                            <form action="{{route('servers')}}" method="post" class="d-flex ms-auto">
                                @csrf
                                <div style="width: 150px;">
                                    <select name="site_id" class="form-control form-control-sm" id="search_site">
                                        <option value="" hidden>Select Site</option>
                                        @foreach ($sites as $site)
                                            <option value="{{$site->id}}" @if($site_id == $site->id) selected @endif>{{$site->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-sm btn-primary ms-2 px-3" style="white-space: nowrap;"><i class="fa fa-search"></i> Search</button>
                                <button type="button" class="btn btn-sm btn-danger ms-2 px-3" id="btn-reset" style="white-space: nowrap;"><i class="fa fa-times"></i> Reset</button>
                            </form>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered" id="datatable-servers">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Missing Updates</th>
                                        <th>Installed Packages</th>
                                        <th>Last Installation</th>
                                        <th>Site</th>
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
                                            <td class="font-weight-normal text-sm">{{$item->site->name ?? ''}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex mt-2">
                                <div style="margin: 0;">
                                    <p>Total <strong style="color: red">{{ $data->total() }}</strong> Entries</p>
                                </div>
                                <div class="ms-auto" style="margin: 0;">
                                    {!! $data->appends([
                                        'site_id' => $site_id
                                    ])->links() !!}
                                </div>
                            </div>
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
        // const dataTableServers = new simpleDatatables.DataTable("#datatable-servers", {
        //     searchable: true,
        //     fixedHeight: true
        // });

        $(document).ready(function () {
            $("#btn-reset").click(function(){
                $("#search_site").val('');
            });
        })
    </script>
@endsection