<!doctype html>
<html lang="en" class="light-theme">

<head>
    <base href="{{ URL::to('/') }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--favicon-->
    <link rel="icon" href="front-end-assets/images/gsm_logo_transparent.png"/>

    <!-- Scripts -->
    @vite('resources/css/front-end.css')

    <!-- CSS files -->
    <link data-navigate-once href="front-end-assets/plugins/slick/slick-theme.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">

    <link data-navigate-once rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

    <style>
        * {
            font-family: Poppins, serif;
        }

        .btn {
            border-radius: 0 !important;
        }

    </style>

    <!-- init js -->
    @stack('css')

    <title>GSM Interior LTD</title>

</head>

<body>

<livewire:layout.front-end.header/>

{{ $slot }}

<livewire:layout.front-end.footer/>

<livewire:layout.front-end.copyright/>

<!--Start Back To Top Button-->
<a href="javaScript:;" class="back-to-top"><i class="bi bi-arrow-up"></i></a>
<!--End Back To Top Button-->

<!-- JavaScript files -->
<script data-navigate-once src="front-end-assets/js/bootstrap.bundle.min.js"></script>
<script data-navigate-once src="front-end-assets/js/jquery.min.js"></script>
<script data-navigate-once src="front-end-assets/plugins/slick/slick.min.js"></script>
<script data-navigate-once src="front-end-assets/js/main.js"></script>
<script data-navigate-once src="front-end-assets/js/index.js"></script>
<script data-navigate-once src="front-end-assets/js/loader.js"></script>

<!-- sweet alert js -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<!--Start of Tawk.to Script-->
<script data-navigate-once>
    $(document).ready(function () {
        document.addEventListener("livewire:navigated", function () {
            var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
            (function () {
                var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
                s1.async = true;
                s1.src = 'https://embed.tawk.to/66d8b66dea492f34bc0dbe56/1i6v8h7t3';
                s1.charset = 'UTF-8';
                s1.setAttribute('crossorigin', '*');
                s0.parentNode.insertBefore(s1, s0);
            })();
        })
    });
</script>
<!--End of Tawk.to Script-->


<!-- init js -->
@stack('js')

<x-livewire-alert::scripts/>

</body>

</html>
