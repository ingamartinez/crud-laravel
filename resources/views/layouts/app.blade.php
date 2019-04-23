<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        @yield('title')
    </title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <!-- CSS Files -->
    <link href="{{asset('assets/css/bootstrap.min.css')}}" rel="stylesheet" />
    <link href="{{asset('assets/css/paper-dashboard.css?v=2.0.0')}}" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{asset('assets/demo/demo.css')}}" rel="stylesheet" />
    <!-- Toastr -->
    <link href="{{asset('css/toastr.min.css')}}" rel="stylesheet" type="text/css" />
    @stack('css')
</head>

<body class="">
<div class="wrapper ">
    @include('layouts.partials.sidebar')
    <div class="main-panel">
        <!-- Navbar -->
        @include('layouts.partials.topbar')
        <!-- End Navbar -->
        <div class="content">
            @yield('content')
        </div>
        @include('layouts.partials.footer')
    </div>
</div>
@yield('modals')
<!--   Core JS Files   -->
<script src="{{asset('assets/js/core/jquery.min.js')}}"></script>
<script src="{{asset('assets/js/core/popper.min.js')}}"></script>
<script src="{{asset('assets/js/core/bootstrap.min.js')}}"></script>
<script src="{{asset('assets/js/plugins/perfect-scrollbar.jquery.min.js')}}"></script>
<script src="{{asset('js/jquery.serialize-object.min.js')}}"></script>
<!--  Notifications Plugin    -->
<script src="{{asset('assets/js/plugins/bootstrap-notify.js')}}"></script>
<!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
<script src="-{{asset('assets/js/paper-dashboard.min.js?v=2.0.0')}}" type="text/javascript"></script>
<!-- Sweet Alert -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- Toastr -->
<script src="{{asset('js/toastr.min.js')}}"></script>
<!-- Axios -->
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

        let token = document.head.querySelector('meta[name="csrf-token"]');

        if (token) {
            axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
        } else {
            console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
        }
    });
</script>
<!-- Dibujar Errores -->
<script>
    function dibujarErrores(response) {

        if (response.hasOwnProperty('errors')){
            var errores = response['errors'];
            var htmlerrors = '<ul>';
            $('input').removeClass('is-invalid');
            Object.keys(errores).forEach(function (element, index) {
                $('#' + element).addClass('is-invalid');
                var label = $('#' + element).siblings('label').text();
                console.log(label);
                label = label == "" ? element : label;
                var str = errores[element][0];
                if (str.indexOf(element) != -1) {
                    htmlerrors += '<li>' + str.replace(element, '<b>(' + label + ')</b>') + '</li>';
                } else {
                    element = element.replace('_', ' ');
                    htmlerrors += '<li>' + str.replace(element, '<b>(' + label + ')</b>') + '</li>';
                }
            });
        }else{
            console.log(response);
            var errores = response['message'];
            var htmlerrors = '<ul>';
            htmlerrors += '<li><b>' + errores + '</b></li>';
        }
        htmlerrors += '</ul>';


        toastr.options = {
            "closeButton": true,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "5000"
        };
        toastr.error(htmlerrors);
    }
</script>
@stack('scripts')
</body>

</html>