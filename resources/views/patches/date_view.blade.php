@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex mb-2">
                            <h4 class="mb-0"><i class="fa fa-calendar-alt"></i> Patches on {{$date}}</h4>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th style="width: 50px">#</th>
                                        {{-- <th>Title</th> --}}
                                        <th>Site</th>
                                        <th>Server</th>
                                        <th>Date</th>
                                        <th>Start Time</th>
                                        <th>End Time</th>
                                        {{-- <th>Detail</th>
                                        <th>Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $item)
                                        <tr>
                                            <td class="font-weight-normal text-sm">{{ (($data->currentPage() - 1 ) * $data->perPage() ) + $loop->iteration }}</td>
                                            {{-- <td class="font-weight-normal text-sm title">{{$item->title}}</td> --}}
                                            <td class="font-weight-normal text-sm site">{{$item->site->name ?? ''}}</td>
                                            <td class="font-weight-normal text-sm server">{{$item->server->name ?? ''}}</td>
                                            <td class="font-weight-normal text-sm date">{{$item->date}}</td>
                                            <td class="font-weight-normal text-sm start_time">{{$item->start_time}}</td>
                                            <td class="font-weight-normal text-sm end_time">{{$item->end_time}}</td>
                                            {{-- <td class="font-weight-normal text-sm detail">{{$item->detail}}</td>
                                            <td class="font-weight-normal text-sm" style="width: 80px;">
                                                <a href="{{route('events.edit', $item->id)}}" class="btn-edit" title="Edit"><i class="fa fa-pencil"></i></a>
                                                <a href="{{route('events.delete', $item->id)}}" class="btn-delete btn-confirm ms-2" title="Delete" onclick="return window.confirm('Are you sure?')"><i class="fa fa-trash"></i></a>
                                            </td> --}}
                                        </tr>
                                    @empty
                                        <tr><td colspan="15" class="text-center">No Data</td></tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="d-flex mt-2">
                                <div style="margin: 0;">
                                    <p>Total <strong style="color: red">{{ $data->total() }}</strong> Entries</p>
                                </div>
                                <div class="ms-auto" style="margin: 0;">
                                    {!! $data->appends([
                                        // 'site_id' => $site_id
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

