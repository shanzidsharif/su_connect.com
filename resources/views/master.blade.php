<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ !empty($title) ? $title : '-' }} SU</title>

    <!-- Google Font: Source Sans Pro -->
    @include('includes.style')
    @yield('style')

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src ="{{ asset('/public') }}/assets/dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->

    @include('includes.header')

    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    @include('includes.sidebar')

    <!-- Content Wrapper. Contains page content -->
    @yield('content')
    <!-- /.content-wrapper -->

    @include('includes.footer')

    <!-- Control Sidebar -->

    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
@include('includes.script')
@yield('script')
</body>
</html>
