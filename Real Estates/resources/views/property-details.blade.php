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
  <link rel="stylesheet" href="{{ asset('css/best-deal-property.css') }}">
  <link rel="stylesheet" href="{{ asset('css/single-property.css') }}">
  <link rel="stylesheet" href="{{ asset('css/owl.css') }}">
  <link rel="stylesheet" href="{{ asset('css/animate.css') }}">

  <!-- Include Fancybox CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css">

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
            <span class="breadcrumb"><a href="{{ route('index') }}">{{__('home')}}</a> / {{__('Single Property')}}</span>
            <h3>{{__('Single Property')}}</h3>
          </div>
        </div>
      </div>
    </div>

    <!-- Details page -->
    <x-single-property :property="$property" />

    </div>

    <!-- Best deal section -->
    <x-best-deal-property />

    <!-- Footer -->
    <x-footer />
    <!-- Footer -->

    <!-- Scripts -->
    <!-- Bootstrap core JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/jquery.min.js') }}"></script>

    <!-- Include Fancybox JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
    <script>
      $(document).ready(function() {
        // Define the maximum number of images to display initially
        const maxImages = 5;

        // Find all gallery items
        const galleryItems = $('.gallery-grid a');

        // Hide extra images if there are more than the maximum allowed
        if (galleryItems.length > maxImages) {
          galleryItems.slice(maxImages).hide();
          $('#load-more').show(); // Show the 'See More' button
        }

        // Handle the 'See More' button click
        $('#load-more').on('click', function() {
          // Show all hidden images
          galleryItems.show();

          // Hide the 'See More' button after clicking
          $(this).hide();
        });

        // Handle the modal open and close
        $('#load-more').on('click', function() {
          const additionalImages = galleryItems.slice(maxImages).clone().show();
          $('#modal-gallery').empty().append(additionalImages);
          $('#image-modal').fadeIn();
        });

        $('.close-button').on('click', function() {
          $('#image-modal').fadeOut();
        });

        // Initialize Fancybox
        $('[data-fancybox="gallery"]').fancybox({
          afterLoad: function(instance, current) {
            if (current.type === 'image') {
              current.$content.attr('loading', 'lazy');
            }
          }
        });
      });
    </script>

    <script src="{{ asset('Bootstrap/js/bootstrap.min.js')}}"></script>
    <script src="{{ asset('js/isotope.min.js') }}"></script>
    <script src="{{ asset('js/owl-carousel.js') }}"></script>
    <script src="{{ asset('js/counter.js') }}"></script>
    <script src="{{ asset('js/custom.js') }}"></script>

</body>

</html>
</x-app-layout>