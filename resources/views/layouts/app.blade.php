<!DOCTYPE html>
<html lang="en">
@include('commons.head')
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    @include('commons.header')

    @include('commons.sidebar')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content')
    </div>
    <!-- /.content-wrapper -->
    @include('commons.footer')
</div>
<!-- ./wrapper -->
@include('commons.scripts')
</body>
</html>
