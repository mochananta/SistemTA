<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Kapella Bootstrap Admin Dashboard Template</title>
    <!-- base:css -->
    <link rel="stylesheet" href="{{ asset('admin/vendors/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/vendors/base/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('admin/images/favicon.png') }}" />
</head>

<body>
    <div class="container-scroller">
        @include('admin.partical.navbar')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <div class="main-panel">
                @yield('content')
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                @include('admin.partical.footer')
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- base:js -->
    <script src="{{ asset('admin/vendors/base/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page-->
    <!-- End plugin js for this page-->
    <!-- inject:js -->
    <script src="{{ asset('admin/js/template.js') }}"></script>
    <!-- endinject -->
    <!-- plugin js for this page -->
    <!-- End plugin js for this page -->
    <script src="{{ asset('admin/vendors/chart.js/Chart.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/progressbar.js/progressbar.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/chartjs-plugin-datalabels/chartjs-plugin-datalabels.js') }}"></script>
    <script src="{{ asset('admin/vendors/justgage/raphael-2.1.4.min.js') }}"></script>
    <script src="{{ asset('admin/vendors/justgage/justgage.js') }}"></script>
    <script src="{{ asset('admin/js/jquery.cookie.js') }}" type="text/javascript"></script>
    <!-- Custom js for this page-->
    <script src="{{ asset('admin/js/dashboard.js') }}"></script>
    <!-- End custom js for this page-->
</body>

</html>
