<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta tags for basic settings and responsive design -->
    <title>@yield('title', 'Chhoti Mandi')</title> <!-- Dynamic title, defaults to 'Chhoti Mandi' if not set -->
    <meta charset="utf-8"> <!-- Character encoding -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"> <!-- Responsive view settings -->

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">

    <!-- CSS Stylesheets -->
    <!-- Third-party and custom stylesheets -->
    <link rel="stylesheet" href="{{ asset('css/open-iconic-bootstrap.min.css') }}"> <!-- Icon fonts -->
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}"> <!-- Animation styles -->

    <!-- Carousel styles -->
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}"> <!-- Lightbox effects -->

    <!-- Additional styles -->
    <link rel="stylesheet" href="{{ asset('css/aos.css') }}"> <!-- Scroll animations -->
    <link rel="stylesheet" href="{{ asset('css/ionicons.min.css') }}"> <!-- Icon fonts -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.css') }}"> <!-- Date picker styles -->
    <link rel="stylesheet" href="{{ asset('css/jquery.timepicker.css') }}"> <!-- Time picker styles -->

    <!-- Custom fonts and styles -->
    <link rel="stylesheet" href="{{ asset('css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/icomoon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}"> <!-- Main custom stylesheet -->
</head>

<body class="goto-here"> <!-- Add a custom class for page styling -->

    <!-- Include header from a partial view -->
    @include('Client.partials.header')

    <!-- Placeholder for page-specific content -->
    @yield('content')

    <!-- Include footer from a partial view -->
    @include('Client.partials.footer')

    <!-- Loader animation -->
    <div id="ftco-loader" class="show fullscreen">
        <svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"></circle>
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"></circle>
        </svg>
    </div>

    <!-- JavaScript files -->
    <!-- jQuery and related libraries -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery-migrate-3.0.1.min.js') }}"></script>

    <!-- Bootstrap and Popper.js -->
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>

    <!-- Additional libraries for animations, carousel, and scroll effects -->
    <script src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="{{ asset('js/jquery.animateNumber.min.js') }}"></script>

    <!-- Plugins for date and time pickers -->
    <script src="{{ asset('js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('js/jquery.timepicker.min.js') }}"></script>

    <!-- Scroll effects -->
    <script src="{{ asset('js/scrollax.min.js') }}"></script>

    <!-- Google Maps API -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="{{ asset('js/google-map.js') }}"></script>

    <!-- Custom JavaScript -->
    <script src="{{ asset('js/main.js') }}"></script>

</body>

</html>