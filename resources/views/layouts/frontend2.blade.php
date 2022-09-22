<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Manup Template">
    <meta name="keywords" content="Manup, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$title}} &#8211; House Beladio</title>
    <link href="{{ asset('/img/logo1.png') }}" rel="icon" type="image/png">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:400,500,600,700,800,900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap" rel="stylesheet">


    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}" type="text/css">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
	<link rel="stylesheet" href="/resources/demos/style.css">
</head>

<body>
    <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>

    <!-- Header Section Begin -->
    <header class="header-section">
        <div class="container">
            <div class="logo">
                <a href="{{ url('/') }}">
                    <img src="{{ asset('img/logo1.png') }}" alt="" style="max-width: 80px;">
                </a>
            </div>
            <div class="nav-menu">
                <nav class="mainmenu mobile-menu">
                    <ul>
                        <li class="active"><a href="https://housebeladio.com/">Main Site</a></li>
                        <li class="active"><a href="#home">House Beladio</a></li>
                        <li class="active"><a href="#booking">Booking</a></li>
                    </ul>
                </nav>
                <a href="https://housebeladio.com/?page_id=610" class="primary-btn top-btn">
					<i class="fa fa-phone"></i> Contact
				</a>
            </div>
            <div id="mobile-menu-wrap"></div>
        </div>
    </header>
    <!-- Header End -->

    <!-- Main Content Begin -->
	@yield('content')
    <!-- Main Content End -->

    <!-- Footer Section Begin -->
    <footer class="footer-section">
        <div class="container">
            <div class="partner-logo owl-carousel">
                <?php
                $bookings = \App\Models\Booking::orderByDesc('created_at')->limit('10')->get(); //var_dump($bookings);
                ?>
                @foreach ($bookings as $booking)
                <?php $bk = new  \App\Models\Booking; ?>
                <a href="javascript:void()" class="pl-table">
                    <div class="pl-tablecell">
                        <span class="text-secondary small">{{ $booking->created_at }}</span><br>
                        <span class="h5">{{ $bk->getEventSpaceName($booking->event_center_id) }}</span><br>
                        <span class="text-mv small">Booked by {{ $booking->name }}</span><br>
                    </div>
                </a>
                @endforeach
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="footer-text">
                        <div class="ft-logo">
                            <a href="{{ url('/') }}" class="footer-logo">
                                <img src="{{ asset('img/logo-white.png') }}" alt="logo" style="max-width: 80px;">
                            </a>
                        </div>
                        <ul>
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li><a href="{{ url('/#booking') }}">Booking</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                        <div class="copyright-text">
                            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy; {{ date('Y') }} <a href="https://housebeladio.com/" target="_blank">House Beladio</a>. All rights reserved
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    @stack('custom-script')
</body>

</html>