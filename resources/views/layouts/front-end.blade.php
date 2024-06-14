<!doctype html>
<html lang="en" class="light-theme">

<head>
    <base href="{{ URL::to('/') }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="front-end-assets/images/favicon-32x32.webp" type="image/webp" />

    <!-- CSS files -->
    <link href="front-end-assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <!-- Plugins -->
    <link rel="stylesheet" type="text/css" href="front-end-assets/plugins/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="front-end-assets/plugins/slick/slick-theme.css" />

    <link href="front-end-assets/css/style.css" rel="stylesheet">
    <link href="front-end-assets/css/dark-theme.css" rel="stylesheet">

    <title>Shopingo - eCommerce HTML Template</title>
</head>

<body>

<livewire:layout.front-end.header />

{{ $slot }}

<livewire:layout.front-end.footer />

<livewire:layout.front-end.copyright />

<!--Start Back To Top Button-->
<a href="javaScript:;" class="back-to-top"><i class="bi bi-arrow-up"></i></a>
<!--End Back To Top Button-->

<!-- JavaScript files -->
<script src="front-end-assets/js/bootstrap.bundle.min.js"></script>
<script src="front-end-assets/js/jquery.min.js"></script>
<script src="front-end-assets/plugins/slick/slick.min.js"></script>
<script src="front-end-assets/js/main.js"></script>
<script src="front-end-assets/js/index.js"></script>
<script src="front-end-assets/js/loader.js"></script>

</body>

</html>