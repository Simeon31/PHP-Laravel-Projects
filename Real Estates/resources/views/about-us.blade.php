<?php

/** @var $members \Illuminate\Pagination\LengthAwarePaginator */

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <title>About Us</title>

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('Bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">


    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="{{ asset('css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/templatemo-villa-agency.css')}}">
    <link rel="stylesheet" href="{{ asset('css/custom-footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/gallery.css')}}">
    <link rel="stylesheet" href="{{ asset('css/owl.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('css/about-us.css') }}">
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
                        <span class="breadcrumb"><a href="{{ route('index') }}">{{__('home')}}</a> / {{__('About Us')}}</span>
                        <h3>{{__('About Us')}}</h3>
                    </div>
                </div>
            </div>
        </div>

        <main>
            <div class="container">
                <section class="intro">
                    <h2>{{__('Welcome to Real Estates Express')}}!</h2>
                    <p>{{__('At Real Estates Express, we’re passionate about helping more && more people to find their new home. Our mission is to provide suitable properties to our clients')}}.
                    </p>
                </section>

                <section class="who-we-are">
                    <h2>{{__('Who We Are')}}</h2>
                    <p>{{__('Founded in 2015, we are a team of dedicated professionals with a shared vision of contributing to the real estate industry. Our diverse team brings together expertise in selling properties as well as ensuring that we approach every challenge with creativity and commitment')}}.</p>
                </section>

                <section class="mission">
                    <h2>{{__('Our Mission')}}</h2>
                    <p>{{__('At Real Estates Express, our mission is simple: to assist people in finding their desired home. We believe in teamwork, and we strive to reflect these values in every aspect of our work')}}.</p>
                </section>

                <section class="unique">
                    <h2>{{__('What Sets Us Apart')}}</h2>
                    <ul>
                        <li><strong>{{__('Quality')}}:</strong> {{__('We take pride in the experience of our agents')}}.</li>
                        <li><strong>{{__('Innovation')}}:</strong> {{__('Our team is always exploring new ways of guarantying more secure properties')}}.</li>
                        <li><strong>{{__('Customer-Centric')}}:</strong> {{__('Your satisfaction is our top priority. We’re taking into account every single detail of our potential clients')}}.</li>
                    </ul>
                </section>
                <!-- Team section -->
                <section class="team-section">
                    <div class="container">
                        <h2>{{__('Meet the Team')}}</h2>

                        @foreach ($members as $member)
                        <x-members :member="$member" />
                        @endforeach

                        <!-- Pagination -->
                        {{ $members->links() }}
                    </div>
                </section>

                <section class="contact">
                    <div class="container">
                        <h2>{{__('Join Us on Our Journey')}}</h2>
                        <p>{{__('We’re excited about the future and warmly invite you to be a part of it. Connect with us through our various channels to stay updated on the latest innovations and insights. Follow us on social media, subscribe to our newsletter, or visit our blog for the latest updates')}}.</p>
                        <p>{{__('Thank you for visiting us. We are committed to further improving our company, and we look forward to achieving great things together')}}.</p>
                        <p><strong>{{__('Contact Us')}}:</strong> {{__('If you have any questions or just want to say hello, feel free to reach out at')}} <a href="mailto:info@yourcompany.com">info@yourcompany.com</a> {{__('or call us at')}} <a href="tel:+1234567890">+1 (234) 567-890</a>. {{__('We’d love to hear from you')}}!</p>
                        <div class="contact-channels">
                            <a href="https://facebook.com/yourcompany" class="social-icon facebook">Facebook</a>
                            <a href="https://twitter.com/yourcompany" class="social-icon twitter">Twitter</a>
                            <a href="https://instagram.com/yourcompany" class="social-icon instagram">Instagram</a>
                            <a href="https://linkedin.com/company/yourcompany" class="social-icon linkedin">LinkedIn</a>
                        </div>
                    </div>
                </section>
            </div>
        </main>

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