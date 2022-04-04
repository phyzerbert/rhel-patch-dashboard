<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'RHEL Patch Dashboard') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{asset('assets/css/nucleo-icons.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/nucleo-svg.css')}}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{asset('assets/css/nucleo-svg.css')}}" rel="stylesheet" />

    <!-- Styles -->
    <link href="{{ asset('assets/css/argon-dashboard.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/plugins/toastr/toastr.min.css') }}" rel="stylesheet">

    <link href="{{ asset('assets/css/custom.css') }}" rel="stylesheet">

    @yield('style')
</head>
<body class="g-sidenav-show bg-gray-100">
    <div class="min-height-300 bg-primary position-absolute w-100"></div>
    @include('layouts.aside')

    <main class="main-content position-relative border-radius-lg ">
        @include('layouts.header')

        @yield('content')
    </main>


    <!-- Scripts -->
    <script src="{{asset('assets/js/core/popper.min.js')}}"></script>
    <script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/perfect-scrollbar.min.js')}}"></script>
    <script src="{{asset('assets/js/plugins/smooth-scrollbar.min.js')}}"></script>
    <script src="{{asset('assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('assets/plugins/toastr/toastr.min.js')}}"></script>

    @yield('script')

    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script src="{{asset('assets/js/argon-dashboard.min.js')}}"></script>

    <script>
        var notification = '{{ session()->get("success")}}';
        if(notification != ''){
            toastr_call("success", "Success", notification);
        }
        var errors_string = '<?php echo json_encode($errors->all()); ?>';
        errors_string=errors_string.replace("[","").replace("]","").replace(/\"/g,"");
        var errors = errors_string.split(",");
        if (errors_string != "") {
            for (let i = 0; i < errors.length; i++) {
                const element = errors[i];
                toastr_call("error", "Error", element);
            }
        }

        function toastr_call(type, title, msg, override){
            toastr[type](msg, title, override);
            toastr.options = {
                "closeButton": false,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-top-center",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }
        }
    </script>
</body>
</html>
