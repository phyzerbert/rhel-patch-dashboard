@extends('layouts.app')

@section('style')
    <script src="{{asset('assets/plugins/vuejs/vue.js')}}"></script>
    <script src="{{asset('assets/plugins/vuejs/axios.js')}}"></script>
    <style>
        .progress {
            height: 12px !important;
            width: 100% !important;
        }
        .progress-bar {
            height: 12px;
        }
        #table-filesystem td {
            vertical-align: middle !important;
            padding: 3px 8px !important;
        }
        #table-filesystem td.path {
            width: 50px;
        }
        #table-filesystem td.value {
            width: 50px;
        }

        .nav-link-server.active {
            font-weight: bold;
        }

        .fc .fc-daygrid-body-unbalanced .fc-daygrid-day-events {
            display: none !important;
        }
        .fc-daygrid-day-number {
            cursor: pointer;
        }
    </style>
@endsection

@section('content')
    <div class="container" id="page">
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                    <select class="form-control" v-model="selected_site_id">
                        <option value="" hidden>Select Site</option>
                        <option :value="site.id" v-for="site in sites">@{{site.name}}</option>
                    </select>
                </div>
                <div class="card mt-4" v-if="selected_site">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th v-for="app in apps">@{{app.name}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td v-for="app in apps">
                                            <div class="server mb-2" v-for="server in servers.filter(i => i.site_id == selected_site_id && i.app_id == app.id)">
                                                <a href="javascript:;" class="nav-link-server" :class="{active: selected_server.id == server.id}" @click.prevent="selected_server = server">@{{server.name}}</a>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card mt-4" v-if="selected_site && selected_server">
                    <div class="card-body">
                        <h4>Host Details - @{{selected_server.name}}</h4>
                        <div class="row">
                            <div class="col-md-4" style="margin-top: 35px;">
                                <h6>Server Info: @{{selected_server.name}}</h6>
                                <h6>Hostname: @{{selected_server.hostname}}</h6>
                                <h6>IP Address: @{{selected_server.ip_address}}</h6>
                                <h6>Kernel: @{{selected_server.kernel}}</h6>
                                <h6>Uptime: @{{selected_server.uptime}}</h6>
                            </div>
                            <div class="col-md-4">
                                <h5 class="text-center">File System</h5>
                                <table class="table table-borderless" id="table-filesystem">
                                    <tbody>
                                        <tr>
                                            <td class="path">/</td>
                                            <td><div class="progress"><div class="progress-bar" style="width:75%"></div></div></td>
                                            <td class="value">75%</td>
                                        </tr>
                                        <tr>
                                            <td class="path">/opt</td>
                                            <td><div class="progress"><div class="progress-bar" style="width:80%"></div></div></td>
                                            <td class="value">80%</td>
                                        </tr>
                                        <tr>
                                            <td class="path">/var</td>
                                            <td><div class="progress"><div class="progress-bar" style="width:71%"></div></div></td>
                                            <td class="value">71%</td>
                                        </tr>
                                        <tr>
                                            <td class="path">/</td>
                                            <td><div class="progress"><div class="progress-bar" style="width:50%"></div></div></td>
                                            <td class="value">50%</td>
                                        </tr>
                                        <tr>
                                            <td class="path">/etc</td>
                                            <td><div class="progress"><div class="progress-bar" style="width:30%"></div></div></td>
                                            <td class="value">30%</td>
                                        </tr>
                                        <tr>
                                            <td class="path">/tmp</td>
                                            <td><div class="progress"><div class="progress-bar" style="width:45%"></div></div></td>
                                            <td class="value">45%</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-4" style="margin-top: 35px;">
                                <h6>CPU Info</h6>
                                <h6>RAM Info</h6>
                                <h6>Hypervisor Info</h6>
                                <h6>Patch Info</h6>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6" v-if="selected_site && selected_server">
                                <h4 class="mb-3">Package History</h4>
                                <h6>Installable Packages: @{{selected_server.installable_updates_package_count}}</h6>
                                <h6>Installable Security: @{{selected_server.installable_updates_security}}</h6>
                                <h6>Installable Enhancements: @{{selected_server.installable_updates_enhancements}}</h6>
                            </div>
                            <div class="col-md-6">
                                <h4 class="mb-3">Patch History</h4>
                                <div class="row">
                                    <div class="col-4"></div>
                                    <div class="col-8">
                                        <input type="text" class="d-none" id="selected_server_id" value="" />
                                        <button style="display:none;" id="button_selected_server"></button>
                                        <div>
                                            <div class="calendar" data-bs-toggle="calendar" id="calendar-patches"></div>
                                        </div>

                                        <h6 class="mt-3">Status</h6>
                                        <div class="d-flex justify-content-between">
                                            <span class="badge badge-success">Good</span>
                                            <span class="badge badge-primary">Pending</span>
                                            <span class="badge badge-danger">Failed</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-body">
                        <h4>Group Patch Status</h4>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Server</th>
                                        <th>Installable</th>
                                        <th>Installed</th>
                                        <th>Falied</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="item in group_patches" v-if="group_patches.length">
                                        <td>@{{item.server_name}}</td>
                                        <td>@{{item.installable}}</td>
                                        <td>@{{item.installed}}</td>
                                        <td>@{{item.failed}}</td>
                                    </tr>
                                    <tr v-else>
                                        <td class="text-center" colspan="10">No Data</td>
                                    </tr>
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
    <script src="{{asset('assets/js/plugins/fullcalendar.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/moment.min.js')}}"></script>
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <script>
        var calendar_data = [];

        var calendar = new FullCalendar.Calendar(document.getElementById("calendar-patches"), {
            contentHeight: 'auto',
            initialView: "dayGridMonth",
            headerToolbar: {
                start: '',
                center: 'title',
                end: ''
            },
            selectable: true,
            editable: false,
            events: calendar_data,
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
            eventDidMount: function (info) {
                var dateString = moment(info.event.start).format('YYYY-MM-DD');
                $('.fc-day[data-date="' + dateString + '"]').css('background-color', info.backgroundColor);
            },
            dateClick(info) {
                let date = moment(info.dateStr).format('YYYY-MM-DD')
                window.location.href = `/patches/date_view?date=${date}`
            }
        });

        calendar.render();
        // $(document).ready(function () {
            $("#button_selected_server").click(function() {
                let server_id = $("#selected_server_id").val();
                if (!server_id) return false;
                $.ajax({
                    url: '/get_server_patches_calendar_data',
                    data: {server_id: server_id},
                    type: 'POST',
                    dataType: 'json',
                    success(data) {
                        calendar_data = data;

                        $('.fc-day').css('background-color', 'unset');
                        calendar.removeAllEvents();
                        calendar.addEventSource(calendar_data)
                        calendar.refetchEvents();
                    }
                })
            })
        // });
    </script>
@endsection