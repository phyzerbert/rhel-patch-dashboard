@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex">
                            <h4 class="mb-0"><i class="fa fa-list"></i> CVE</h4>
                            <button type="button" class="btn btn-sm btn-primary ms-auto mb-0" data-bs-toggle="collapse" data-bs-target="#importForm">Import</button>
                        </div>
                        <div class="collapse" id="importForm">
                            <form action="{{route('cbd.import')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label for="">CBD Application Contact Info</label>
                                    </div>
                                    <div class="col-md-5">
                                        <input class="form-control" name="cbd_application_contact_info" type="file" accept=".csv" required  />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label for="">CBD CBP</label>
                                    </div>
                                    <div class="col-md-5">
                                        <input class="form-control" name="cbd_cbp" type="file" accept=".csv" required  />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label for="">CBD Important Notes</label>
                                    </div>
                                    <div class="col-md-5">
                                        <input class="form-control" name="cbd_important_note" type="file" accept=".csv" required  />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label for="">CBD QD</label>
                                    </div>
                                    <div class="col-md-5">
                                        <input class="form-control" name="cbd_qd" type="file" accept=".csv" required  />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-5">
                                        <button type="submit" class="btn btn-primary" >Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-body">
                        <h4>CBD Application Contact Info</h4>
                        <div class="table-responsive">
                            <table class="table table-flush" id="datatable-application-contact-info">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Internal Name</th>
                                        <th>Hostname</th>
                                        <th>Customer Mail ID's</th>
                                        <th>Account DL</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (\App\Models\CbdApplicationContactInfo::all() as $item)
                                        <tr>
                                            <td class="font-weight-normal text-sm" style="width: 80px;">{{$loop->index + 1}}</td>
                                            <td class="font-weight-normal text-sm name">{{$item->internal_name}}</td>
                                            <td class="font-weight-normal text-sm name">{{$item->hostname}}</td>
                                            <td class="font-weight-normal text-sm name">{{$item->customer_mail_ids}}</td>
                                            <td class="font-weight-normal text-sm name">{{$item->account_dl}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-body">
                        <h4>CBD CBP</h4>
                        <div class="table-responsive">
                            <table class="table table-flush" id="datatable-cbp">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Ticket Description</th>
                                        <th>Mail ID's</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (\App\Models\CbdCbp::all() as $item)
                                        <tr>
                                            <td class="font-weight-normal text-sm" style="width: 80px;">{{$loop->index + 1}}</td>
                                            <td class="font-weight-normal text-sm name">{{$item->ticket_description}}</td>
                                            <td class="font-weight-normal text-sm name">{{$item->mail_ids}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-body">
                        <h4>CBD Important Notes</h4>
                        <div class="table-responsive">
                            <table class="table table-flush" id="datatable-important-notes">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Department</th>
                                        <th>Phone Number</th>
                                        <th>On Call Engineer</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (\App\Models\CbdImportantNote::all() as $item)
                                        <tr>
                                            <td class="font-weight-normal text-sm" style="width: 80px;">{{$loop->index + 1}}</td>
                                            <td class="font-weight-normal text-sm name">{{$item->department}}</td>
                                            <td class="font-weight-normal text-sm name">{{$item->phone_number}}</td>
                                            <td class="font-weight-normal text-sm name">{{$item->on_call_engineer}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-body">
                        <h4>CBD CBP</h4>
                        <div class="table-responsive">
                            <table class="table table-flush" id="datatable-qd">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Queue Name</th>
                                        <th>Mail DL's</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (\App\Models\CbdQd::all() as $item)
                                        <tr>
                                            <td class="font-weight-normal text-sm" style="width: 80px;">{{$loop->index + 1}}</td>
                                            <td class="font-weight-normal text-sm name">{{$item->queue_name}}</td>
                                            <td class="font-weight-normal text-sm name">{{$item->mail_dls}}</td>
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
        const dataTableContactInfo = new simpleDatatables.DataTable("#datatable-application-contact-info", {
            searchable: true,
            fixedHeight: true
        });
        const dataTableCbp = new simpleDatatables.DataTable("#datatable-cbp", {
            searchable: true,
            fixedHeight: true
        });
        const dataTableImportantNotes = new simpleDatatables.DataTable("#datatable-important-notes", {
            searchable: true,
            fixedHeight: true
        });
        const dataTableQd = new simpleDatatables.DataTable("#datatable-qd", {
            searchable: true,
            fixedHeight: true
        });
    </script>
@endsection