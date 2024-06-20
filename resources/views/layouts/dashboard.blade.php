<!doctype html>
<html lang="en">

<head>

    <base href="{{ URL::to('/') }}"/>
    <meta charset="utf-8"/>
    <title>Dashboard | Minia - Minimal Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description"/>
    <meta content="Themesbrand" name="author"/>
    <!-- App favicon -->
    <link rel="shortcut icon" href="dashboard/images/favicon.ico">

    <!-- Scripts -->
    @vite('resources/css/dashboard.css')

</head>

<body>
<div id="layout-wrapper">

    <livewire:layout.dashboard.header/>

    <livewire:layout.dashboard.sidebar/>

    {{ $slot }}

    <livewire:layout.dashboard.rightbar/>

</div>

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

<script src="dashboard/libs/jquery/jquery.min.js"></script>
<script data-navigate-once src="dashboard/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="dashboard/libs/metismenu/metisMenu.min.js"></script>
<script src="dashboard/libs/simplebar/simplebar.min.js"></script>
<script src="dashboard/libs/node-waves/waves.min.js"></script>
<script src="dashboard/libs/feather-icons/feather.min.js"></script>
<!-- pace js -->
<script src="dashboard/libs/pace-js/pace.min.js"></script>

<!-- apexcharts -->
<script src="dashboard/libs/apexcharts/apexcharts.min.js"></script>

<!-- Plugins js-->
<script src="dashboard/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="dashboard/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js"></script>
<!-- dashboard init -->
<script src="dashboard/js/pages/dashboard.init.js"></script>

<script src="dashboard/js/app.js"></script>


</body>

</html>
