@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="d-flex mb-2">
                            <h4 class="mb-0"><i class="fa fa-calendar-alt"></i> Patches</h4>
                            <a href="{{route('patches.create')}}" class="btn btn-primary mb-0 ms-auto"><i class="fa fa-plus me-1"></i>Add</a>
                        </div>
                        <div>
                            <div class="calendar" data-bs-toggle="calendar" id="calendar-patchess"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{asset('assets/js/plugins/fullcalendar.min.js')}}"></script>
    <script>
        var calendar = new FullCalendar.Calendar(document.getElementById("calendar-patchess"), {
            contentHeight: 'auto',
            initialView: "dayGridMonth",
            headerToolbar: {
                start: 'title', // will normally be on the left. if RTL, will be on the right
                center: '',
                end: 'today prev,next' // will normally be on the right. if RTL, will be on the left
            },
            selectable: true,
            editable: false,
            initialDate: "{{$initialDate}}",
            events: {!! json_encode($patches) !!},
            views: {
                month: {
                    titleFormat: {
                        month: "long",
                        year: "numeric"
                    }
                },
                agendaWeek: {
                    titleFormat: {
                        month: "long",
                        year: "numeric",
                        day: "numeric"
                    }
                },
                agendaDay: {
                    titleFormat: {
                        month: "short",
                        year: "numeric",
                        day: "numeric"
                    }
                }
            },
        });

    calendar.render();
    </script>
@endsection

