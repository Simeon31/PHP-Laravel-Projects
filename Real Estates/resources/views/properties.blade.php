<?php

/** @var $properties \Illuminate\Pagination\LengthAwarePaginator */

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

  <title>Real Estates</title>

  <!-- Bootstrap core CSS -->
  <link href="{{ asset('Bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

  <!-- Additional CSS Files -->
  <link rel="stylesheet" href="{{ asset('css/fontawesome.css') }}">
  <link rel="stylesheet" href="{{ asset('css/templatemo-villa-agency.css') }}">
  <link rel="stylesheet" href="{{ asset('css/custom-footer.css') }}">
  <link rel="stylesheet" href="{{ asset('css/owl.css') }}">
  <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
  <!--

TemplateMo 591 villa agency

https://templatemo.com/tm-591-villa-agency

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

  <x-app-layout>
    <!-- ***** Header Area Start ***** -->
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
            <span class="breadcrumb"><a href="{{ route('index') }}">{{__('home')}}</a> / {{__('Properties')}}</span>
            <h3>{{__('Properties')}}</h3>
          </div>
        </div>
      </div>
    </div>

    <!-- Search Form -->
    <form action="{{ route('properties') }}" method="GET" class="mt-5 mx-auto max-w-xl py-2 px-6 rounded-full bg-gray-50 border flex focus-within:border-gray-300 grow h-14">
      <input type="text" placeholder="{{__('Search by property name or category...')}}" class="bg-transparent w-full focus:outline-none pr-4 font-semibold border-0 focus:ring-0 px-0 py-0" name="query">
      <button type="submit" class="flex flex-row items-center justify-center min-w-[130px] px-4 rounded-full font-medium tracking-wide border disabled:cursor-not-allowed disabled:opacity-50 transition ease-in-out duration-150 text-base bg-black text-white border-transparent py-1.5 h-[38px] -mr-3">
        <i class="fas fa-search" style="margin-right: 0.5rem;"></i>
        {{__('Search')}}
      </button>
    </form>

    <!-- No Results Message -->
    @if($noResults)
    <p style="color: #FF4B33; font-weight: bold; font-size: x-large; border: 1px; background-color:#1c2331; border-radius: 20px; text-align: center; padding-bottom: 3vh; padding-top: 3vh; margin-top: 5rem; ">
      No properties were found.
    </p>

    <!-- Pagination Links -->
    {{ $properties->links() }}
    @endif

    <!-- Property section-->
    <div class="section properties">
      <div class="container">
        <div class="row properties-box">
          @foreach ($properties as $property)
          <div class="col-lg-4 col-md-6 align-self-center mb-30 properties-items col-md-6">
            <x-post-item :property="$property"></x-post-item>
          </div>
          @endforeach
        </div>

        <!-- Pagination -->
        <div class="row">
          <div class="col-lg-12">
            {{$properties->onEachSide(1)->links()}}
          </div>
        </div>
      </div>

      <!-- Footer -->
      <x-footer />
      <!-- Footer -->

      <!-- Scripts -->
      <!-- Bootstrap core JavaScript -->
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script src="{{ asset('jquery/jquery.min.js') }}"></script>
      <script src="{{ asset('Bootstrap/js/bootstrap.min.js')}}"></script>
      <script src="{{ asset('js/isotope.min.js') }}"></script>
      <script src="{{ asset('js/owl-carousel.js') }}"></script>
      <script src="{{ asset('js/counter.js') }}"></script>
      <script src="{{ asset('js/custom.js') }}"></script>

</body>

</html>
</x-app-layout>