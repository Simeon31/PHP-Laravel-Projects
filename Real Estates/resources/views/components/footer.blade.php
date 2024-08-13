<footer class="text-center text-lg-start text-white" style="background-color: #1c2331">
      <section class="d-flex justify-content-between align-items-center p-4 social-section">
        <!-- Left -->
        <div class="me-5">
          <span>{{__('Get connected with us on social networks')}}:</span>
        </div>
        <!-- Right -->
        <div>
          <a href="#" class="text-white me-4">
            <i class="fab fa-facebook-f"></i>
          </a>
          <a href="#" class="text-white me-4">
            <i class="fab fa-twitter"></i>
          </a>
          <a href="#" class="text-white me-4">
            <i class="fab fa-instagram"></i>
          </a>
          <a href="#" class="text-white me-4">
            <i class="fab fa-linkedin"></i>
          </a>
        </div>
      </section>

      <section>
        <div class="container text-center text-md-start mt-5">
          <div class="row mt-1">
            <!-- Company Section -->
            <div class="col-md-4 col-lg-4 col-xl-12 mx-auto mb-4">
              <h6 class="text-uppercase fw-bold text-center">Real Estates</h6>
              <hr class="mb-1 d-inline-block mx-auto" />
            </div>
            <!-- Properties Section -->
            <div class="col-md-4 col-lg-4 col-xl-4 mb-4 text-center">
              <h6 class="text-uppercase fw-bold">{{__('Properties')}}</h6>
              <hr class="mb-1 mt-0 d-inline-block mx-auto" />
              <p><a href="{{ route('properties') }}" class="text-white">{{__('Apartment')}}</a></p>
              <p><a href="{{ route('properties') }}" class="text-white">{{__('House')}}</a></p>
              <p><a href="{{ route('properties') }}" class="text-white">{{__('Penthouse')}}</a></p>
            </div>
            <!-- Useful Links Section -->
            <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4 text-center">
              <h6 class="text-uppercase fw-bold">{{__('Useful links')}}</h6>
              <hr class="mb-4 mt-0 d-inline-block mx-auto" />
              <p><a href="{{ route('profile.edit') }}" class="text-white">{{__('Your Account')}}</a></p>
              <p><a href="{{ route('index') }}" class="text-white">{{__('Home')}}</a></p>
              <p><a href="{{ route('properties') }}" class="text-white">{{__('Properties')}}</a></p>
            </div>
            <!-- Contact Section -->
            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4 text-center">
              <h6 class="text-uppercase fw-bold">{{__('Contacts')}}</h6>
              <hr class="mb-4 mt-0 d-inline-block mx-auto" />
              <p><i class="fas fa-home me-3"></i> New York, NY 10012, US</p>
              <p><i class="fas fa-envelope me-3"></i> info@example.com</p>
              <p><i class="fas fa-phone me-3"></i> + 01 234 567 88</p>
            </div>
          </div>
        </div>
      </section>

      <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">
        © 2024 Copyright: <a class="text-white" href="#">RealEstates.com</a>
      </div>
    </footer>