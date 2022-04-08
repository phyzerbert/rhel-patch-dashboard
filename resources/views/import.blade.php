@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 py-5">
                <h3 class="text-center text-light">Import CSV Files Here</h3>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3>Import Servers</h3>
                        <form action="{{route('import.servers')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <input class="form-control" name="file" type="file" accept=".csv" required  />
                            </div>
                            <button type="submit" class="btn btn-primary">Import</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3>Import Patch Timeline</h3>
                        <form action="{{route('import.timeline')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <input class="form-control" name="file" type="file" accept=".csv" required />
                            </div>
                            <button type="submit" class="btn btn-primary">Import</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3>Import Package Installed</h3>
                        <form action="{{route('import.packages_installed')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <input class="form-control" name="file" type="file" accept=".csv" required  />
                            </div>
                            <button type="submit" class="btn btn-primary">Import</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3>Import Sites</h3>
                        <form action="{{route('import.sites')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <input class="form-control" name="file" type="file" accept=".csv" required  />
                            </div>
                            <button type="submit" class="btn btn-primary">Import</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3>Capsule Servers</h3>
                        <form action="{{route('import.capsule_servers')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <input class="form-control" name="file" type="file" accept=".csv" required  />
                            </div>
                            <button type="submit" class="btn btn-primary">Import</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3>Site Code Subnets</h3>
                        <form action="{{route('import.site_code_subnets')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <input class="form-control" name="file" type="file" accept=".csv" required  />
                            </div>
                            <button type="submit" class="btn btn-primary">Import</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <h3>CVE Data</h3>
                        <form action="{{route('import.cve_data')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <input class="form-control" name="file" type="file" accept=".zip" required  />
                            </div>
                            <button type="submit" class="btn btn-primary">Import</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection