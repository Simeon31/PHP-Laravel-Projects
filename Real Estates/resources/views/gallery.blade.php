<?php

/** @var $gallery \Illuminate\Pagination\LengthAwarePaginator */

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>Gallery</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('Bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/templatemo-villa-agency.css')}}">
    <link rel="stylesheet" href="{{ asset('css/custom-footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/gallery.css')}}">
    <link rel="stylesheet" href="{{ asset('css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <!--

-->
</head>

<body>
    <!-- ***** Preloader Start ***** -->
    <div id="js-preloader" class="js-preloader">
        <div class="preloader-inner">
            <span class="dot"></span>
            <div class="dots">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- ***** Preloader End ***** -->

    <div class="sub-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8">
                    <ul class="info">
                        <li><i class="fa fa-envelope"></i> info@company.com</li>
                        <li><i class="fa fa-map"></i> Sunny Isles Beach, FL 33160</li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-4">
                    <ul class="social-links">
                        <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                        <li><a href="https://x.com/minthu" target="_blank"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                        <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- ***** Header Area Start ***** -->
    <x-app-layout>
        <header class="header-area header-sticky sticky top-0 z-40">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav class="main-nav">
                            <!-- ***** Logo Start ***** -->
                            <a href="{{ route('index') }}" class="logo">
                                <h1>House</h1>
                            </a>
                            <!-- ***** Logo End ***** -->

                            <!-- ***** Menu Start ***** -->
                            <ul class="nav">
                                <li><a href="{{ route('index') }}">{{__('home')}}</a></li>
                                <li><a href="{{ route('properties') }}">{{__('Properties')}}</a></li>
                                <li><a href="{{ route('contact') }}">{{__('Contact Us')}}</a></li>
                                <li><a href="{{ route('gallery') }}">{{__('Gallery')}}</a></li>
                                <li><a href="{{ route('about-us') }}">{{__('About us')}}</a></li>
                            </ul>
                            <a class='menu-trigger'>
                                <span>Menu</span>
                            </a>
                            <!-- ***** Menu End ***** -->
                        </nav>
                    </div>
                </div>
            </div>
        </header>
        <!-- ***** Header Area End ***** -->

        <div class="page-heading header-text">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <span class="breadcrumb"><a href="{{ route('index') }}">{{__('home')}}</a> / {{__('Gallery')}}</span>
                        <h3>{{__('Gallery')}}</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Video Section -->
        <div class="tm-hero" id="tm-video-container">
            <video autoplay muted loop id="tm-video">
                <source src="{{ asset('video/CINEMATIC_REAL_ESTATE_VIDEO_PALM BEACH PENTHOUSE_SONY_FX3.mp4') }}" type="video/mp4">
            </video>
            <i id="tm-video-control-button" class="fas fa-pause"></i>
            <!-- Search Form -->
            <form method="get" action="{{ route('gallery') }}" class="d-flex position-absolute tm-search-form">
                <input name="query" value="{{ request()->get('query') }}" class="form-control tm-search-input" type="search" placeholder="{{__('Search')}}" aria-label="Search">
                <button class="btn btn-outline-success tm-search-btn" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </form>

        </div>

        <!-- Container-->
        <div class="container-fluid tm-container-content tm-mt-60">
            <div class="row mb-4">
                <h2 class="col-6 tm-text-primary">
                {{__('Gallery')}}
                </h2>
            </div>

            <!-- Display Results or No Results Message -->
            @if($noResults)
            <p style="color: #FF4B33; font-weight: bold; font-size: x-large; border: 1px; background-color:#1c2331; border-radius: 20px; text-align: center; padding-bottom: 3vh; padding-top: 3vh">
                No images were found.
            </p>

            <!-- Pagination Links -->
            {{ $gallery->links() }}
            @endif

            <!-- Display -->
            <div class="row tm-mb-90 tm-gallery">
                @foreach ($gallery as $propertyGallery)
                <x-gallery :propertyGallery="$propertyGallery"></x-gallery>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="row">
                <div class="col-lg-12">
                    {{$gallery->onEachSide(1)->links()}}
                </div>
            </div>
        </div>
        <!-- container-fluid, tm-container-content -->

        <!-- Footer -->
        <x-footer />
        <!-- Footer -->

        <!-- Scripts -->
        <!-- Bootstrap core JavaScript -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('Bootstrap/js/bootstrap.min.js')}}"></script>
        <script src="{{ asset('js/isotope.min.js') }}"></script>
        <script src="{{ asset('js/owl-carousel.js') }}"></script>
        <script src="{{ asset('js/counter.js') }}"></script>
        <script src="{{ asset('js/custom.js') }}"></script>

</body>

</html>
</x-app-layout>