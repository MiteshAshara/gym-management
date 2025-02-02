<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ URL::to('/admin/plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="icon" class="bg-white" sizes="64x64" type="image/png" href="{{ asset('admin/dist/img/au-favicon.png') }}">
    <link rel="stylesheet" href="{{ URL::to('/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('/admin/plugins/jqvmap/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('/admin/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('/admin/plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ URL::to('/admin/plugins/summernote/summernote-bs4.min.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        @include('admin.includes.header')

        @include('admin.includes.sidebar')

        <div class="content-wrapper bg-white">
            @yield('admin.content')
        </div>

        @include('admin.includes.footer')
        <aside class="control-sidebar control-sidebar-dark">
        </aside>
    </div>

    <script src="{{ URL::to('/admin/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    <script src="{{ URL::to('/admin/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ URL::to('/admin/dist/js/adminlte.js') }}"></script>
    <script src="{{ URL::to('/admin/plugins/chart.js/Chart.min.js') }}"></script>
    <script src="{{ URL::to('/admin/plugins/sparklines/sparkline.js') }}"></script>
    <script src="{{ URL::to('/admin/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
    <script src="{{ URL::to('/admin/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
    <script src="{{ URL::to('/admin/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
    <script src="{{ URL::to('/admin/plugins/moment/moment.min.js') }}"></script>
    <script src="{{ URL::to('/admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ URL::to('/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <script src="{{ URL::to('/admin/plugins/summernote/summernote-bs4.min.js') }}"></script>
    <script src="{{ URL::to('/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#membersTable').DataTable();
        });
        $(document).ready(function () {
            $('#feesTable').DataTable();
        });
    </script>
</body>

</html>