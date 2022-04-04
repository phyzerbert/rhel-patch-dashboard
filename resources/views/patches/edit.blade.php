@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex mb-2">
                            <h4 class="mb-0"><i class="fa fa-calendar-alt"></i> Edit Patch</h4>
                        </div>
                        <form action="{{route('patches.update')}}" method="post">
                            @csrf
                            <input type="hidden" value="{{$model->id}}">
                            <div class="form-group">
                                <label for="">Site</label>
                                <select type="text" class="form-control site" name="site_id" required>
                                    <option value="" hidden>Select Site</option>
                                    @foreach ($sites as $item)
                                        <option value="{{$item->id}}" @if($model->site_id == $item->id) selected @endif>{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Server</label>
                                <select type="text" class="form-control server" name="server_id" required>
                                    <option value="" hidden>Select Server</option>
                                    @foreach ($servers as $item)
                                        <option value="{{$item->id}}" @if($model->server_id == $item->id) selected @endif data-site="{{$item->site_id}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Date</label>
                                <input type="date" class="form-control" name="date" placeholder="Date" value="{{$model->date}}" required />
                            </div>
                            <div class="form-group">
                                <label for="">Start Time - EST</label>
                                <input type="text" class="form-control @error('start_time') is-invalid @enderror" name="start_time" value="{{$model->start_time}}" placeholder="Ex. 09:00" required />
                                @error('start_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">End Time - EST</label>
                                <input type="text" class="form-control @error('end_time') is-invalid @enderror" name="end_time" value="{{$model->end_time}}" placeholder="Ex. 17:00" required />
                                @error('end_time')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Title</label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" placeholder="Event Summary Title" value="{{$model->title}}" required />
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="">Detail</label>
                                <textarea rows="5" class="form-control" name="detail" placeholder="Event Detail" maxlength="10000">{{$model->detail}}</textarea>
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