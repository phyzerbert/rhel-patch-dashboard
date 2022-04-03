@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex">
                            <h4 class="mb-0"><i class="fa fa-globe-americas"></i> Sites</h4>
                            <button class="btn btn-primary mb-0 ms-auto" id="btn-add"><i class="fa fa-plus me-1"></i>Add</button>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-flush" id="datatable-sites">
                                <thead class="thead-light">
                                    <tr>
                                        <th>Name</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td class="font-weight-normal text-sm name">{{$item->name}}</td>
                                            <td class="font-weight-normal text-sm" style="width: 80px;">
                                                <a href="javascript:;" class="btn-edit" title="Edit" data-id="{{$item->id}}"><i class="fa fa-pencil"></i></a>
                                                <a href="{{route('sites.delete', $item->id)}}" class="btn-delete btn-confirm ms-2" title="Delete" onclick="return window.confirm('Are you sure?')"><i class="fa fa-trash"></i></a>
                                            </td>
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

    <div class="modal fade" id="addSiteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Add Site</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{route('sites.save')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name" class="form-control name" placeholder="Site name" required />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editSiteModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Edit Site</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <form action="{{route('sites.update')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" class="id" name="id" />
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="name" class="form-control name" placeholder="Site name" required />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fa fa-times"></i> Close</button>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('assets/js/plugins/datatables.js')}}"></script>
    <script>
        const dataTableSites = new simpleDatatables.DataTable("#datatable-sites", {
            searchable: true,
            fixedHeight: true
        });

        $(document).ready(function() {
            $("#btn-add").click(function () {
                $("#addSiteModal .name").val('')
                var addSiteModal = new bootstrap.Modal(document.getElementById('addSiteModal'), {})
                addSiteModal.show()
            })

            $(".btn-edit").click(function () {
                let id = $(this).data('id')
                let name = $(this).parents('tr').find('.name').text();
                $("#editSiteModal .id").val(id)
                $("#editSiteModal .name").val(name)
                var editSiteModal = new bootstrap.Modal(document.getElementById('editSiteModal'), {})
                editSiteModal.show()
            })
        });
    </script>
@endsection