<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui" />
    <title>{{ $title }}</title>
    <meta content="Admin Dashboard" name="description" />
    <meta content="Mannatthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ url('img/middleman3.png') }}" />

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- External CSS Libraries -->
    <!-- Morris Chart CSS -->
    <link rel="stylesheet" href="{{ url('assets/plugins/fullcalendar/vanillaCalendar.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/plugins/jvectormap/jquery-jvectormap-2.0.2.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/plugins/chartist/css/chartist.min.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/plugins/morris/morris.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/plugins/metro/MetroJs.min.css') }}" />

    <!-- Carousel and Animations -->
    <link rel="stylesheet" href="{{ url('assets/plugins/carousel/owl.carousel.min.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/plugins/carousel/owl.theme.default.min.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/plugins/animate/animate.css') }}" type="text/css" />

    <!-- Core Stylesheets -->
    <link rel="stylesheet" href="{{ url('assets/css/bootstrap-material-design.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ url('assets/css/icons.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ url('assets/css/style.css') }}" type="text/css" />

    <!-- DataTables -->
    <link href="{{ url('assets/plugins/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/plugins/datatables/buttons.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/plugins/datatables/responsive.bootstrap4.min.css') }}" rel="stylesheet" type="text/css" />

    <!-- Select2 CSS (missing in your original code) -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- Font Awesome (missing in your original code) -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet" />

    <!-- Vite JS -->
    @vite('resources/js/app.js')

    @stack('styles')
</head>

<body class="fixed-left">

    <!-- Begin page -->
    <div id="wrapper">
        @include('layouts.adminSidebar')
        
        <!-- Start right Content here -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                @include('layouts.adminTopbar')
                @yield('content')
            </div>
            <!-- End content -->

            <footer class="footer">© Middleman | 2024</footer>
        </div>
        <!-- End Right content here -->
    </div>
    <!-- END wrapper -->

    <!-- jQuery -->
    <script src="{{ url('assets/js/jquery.min.js') }}"></script>
    <script src="{{ url('assets/js/popper.min.js') }}"></script>
    <script src="{{ url('assets/js/bootstrap-material-design.js') }}"></script>
    <script src="{{ url('assets/js/modernizr.min.js') }}"></script>
    <script src="{{ url('assets/js/detect.js') }}"></script>
    <script src="{{ url('assets/js/fastclick.js') }}"></script>
    <script src="{{ url('assets/js/jquery.slimscroll.js') }}"></script>
    <script src="{{ url('assets/js/jquery.blockUI.js') }}"></script>
    <script src="{{ url('assets/js/waves.js') }}"></script>
    <script src="{{ url('assets/js/jquery.nicescroll.js') }}"></script>
    <script src="{{ url('assets/js/jquery.scrollTo.min.js') }}"></script>

    <!-- Plugin JS Libraries -->
    <script src="{{ url('assets/plugins/carousel/owl.carousel.min.js') }}"></script>
    <script src="{{ url('assets/plugins/fullcalendar/vanillaCalendar.js') }}"></script>
    <script src="{{ url('assets/plugins/peity/jquery.peity.min.js') }}"></script>
    <script src="{{ url('assets/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ url('assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ url('assets/plugins/chartist/js/chartist.min.js') }}"></script>
    <script src="{{ url('assets/plugins/chartist/js/chartist-plugin-tooltip.min.js') }}"></script>
    <script src="{{ url('assets/plugins/metro/MetroJs.min.js') }}"></script>
    <script src="{{ url('assets/plugins/raphael/raphael.min.js') }}"></script>
    <script src="{{ url('assets/plugins/morris/morris.min.js') }}"></script>

    <!-- App JS -->
    <script src="{{ url('assets/js/app.js') }}"></script>

    <!-- DataTables JS Libraries -->
    <script src="{{ url('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ url('assets/plugins/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ url('assets/plugins/datatables/dataTables.buttons.min.js') }}"></script>
    <script src="{{ url('assets/plugins/datatables/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ url('assets/plugins/datatables/jszip.min.js') }}"></script>
    <script src="{{ url('assets/plugins/datatables/pdfmake.min.js') }}"></script>
    <script src="{{ url('assets/plugins/datatables/vfs_fonts.js') }}"></script>
    <script src="{{ url('assets/plugins/datatables/buttons.html5.min.js') }}"></script>
    <script src="{{ url('assets/plugins/datatables/buttons.print.min.js') }}"></script>
    <script src="{{ url('assets/plugins/datatables/buttons.colVis.min.js') }}"></script>
    <script src="{{ url('assets/plugins/datatables/dataTables.responsive.min.js') }}"></script>
    <script src="{{ url('assets/plugins/datatables/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ url('assets/pages/datatables.init.js') }}"></script>

    <!-- Parsley.js (Form validation) -->
    <script src="{{ url('assets/plugins/parsleyjs/parsley.min.js') }}"></script>
    <script src="{{ url('assets/pages/validation-init.js') }}"></script>

    <!-- Select2 JS (added based on previous code) -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    @stack('scripts')

</body>

</html>
