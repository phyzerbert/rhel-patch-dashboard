@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex mb-2">
                            <h4 class="mb-0"><i class="fa fa-calendar-alt"></i> Add Patch Schedule</h4>
                        </div>
                        <form action="{{route('patches.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="">Site</label>
                                <select type="text" class="form-control site" name="site_id" required>
                                    <option value="" hidden>Select Site</option>
                                    @foreach ($sites as $item)
                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Server</label>
                                <select type="text" class="form-control server" name="server_id" required>
                                    <option value="" hidden>Select Server</option>
                                    @foreach ($servers as $item)
                                        <option value="{{$item->id}}" data-site="{{$item->site_id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Date</label>
                                <input type="date" class="form-control" name="date" placeholder="Date" required />
                            </div>
                            <div class="form-group">
                                <label for="">Start Time - EST</label>
                                <input type="text" class="form-control @error('start_time') is-invalid @enderror" name="start_time" placeholder="Ex. 09:00" required />
                                @error('start_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">End Time - EST</label>
                                <input type="text" class="form-control @error('end_time') is-invalid @enderror" name="end_time" placeholder="Ex. 17:00" required />
                                @error('end_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            @php
                                $authorizations = ['Not Approved', 'Pending Approval', 'Approved'];
                            @endphp
                            <div class="form-group">
                                <label for="">Authorization</label>
                                <select type="text" class="form-control authorization" name="authorization">
                                    <option value="" hidden>Authorization</option>
                                    @foreach ($authorizations as $item)
                                        <option value="{{$item}}">{{$item}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Event Summary Title" required />
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Detail</label>
                                <textarea rows="3" class="form-control" name="detail" placeholder="Event Detail" maxlength="10000"></textarea>
                            </div>
                            @php
                                $statuses = ['Successful', 'Successful with Issues', 'Failed', 'Exceeded Maintenance Window', 'Authorization Pending', 'Other - Non Technical'];
                            @endphp
                            <div class="form-group">
                                <label for="">Patch Status</label>
                                <select type="text" class="form-control status" name="status">
                                    <option value="" hidden>Patch Status</option>
                                    @foreach ($statuses as $item)
                                        <option value="{{$item}}">{{$item}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="fa fa-save me-1"></i> Save</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $("select.site").change(function () {
                let site_id = $(this).val()
                $("select.server option").hide()
                $("select.server option").each(function() {
                    if ($(this).data('site') == site_id) $(this).show()
                })
            })
        })
    </script>
@endsection