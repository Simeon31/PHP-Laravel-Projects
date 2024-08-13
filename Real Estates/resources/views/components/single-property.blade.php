<div class="single-property section">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">
        <div class="main-image">
          <img src="{{$property->getImage()}}" alt="">
        </div>
        <div class="main-content">
          <span class="category">{{ $property->typeOfProperty->property_type }}</span>
          <h6 class="address"><i class="fas fa-map-marker-alt"></i> {{ $property->address }}</h6>
          <h4 class="property-name">{{ $property->property_name }}</h4>
          <!-- Description -->
          <section class="border rounded-lg p-6" style="background-color: #111827">
            <h3 class="text-xl font-semibold text-white mb-4">{{__('Description')}}</h3>
            <p class="leading-relaxed">
              {!! $property->description !!}
            </p>
          </section>
        </div>
        <!-- Property additional features-->
        <section class="property-features-section border rounded-lg p-6 mt-6 bg-dark">
          <h3 class="text-2xl font-bold text-white mb-4">{{__('Property Features')}}</h3>
          <ul class="list-disc list-inside space-y-4 text-white">
            <li class="flex items-start underline-item">
              <strong class="w-32">{{__('Bedrooms')}}:</strong>
              <span>{{ $property->bedrooms }}</span>
            </li>
            <li class="flex items-start underline-item">
              <strong class="w-32">{{__('Bathrooms')}}:</strong>
              <span>{{ $property->bathrooms }}</span>
            </li>
            <li class="flex items-start underline-item">
              <strong class="w-32">{{__('Floor')}}:</strong>
              <span>{{ $property->floor }}</span>
            </li>
            <li class="flex items-start underline-item">
              <strong class="w-32">{{__('Parking Spots')}}:</strong>
              <span>{{ $property->parking_spots }}</span>
            </li>
            <li class="flex items-start underline-item">
              <strong class="w-32">{{__('Area')}}:</strong>
              <span>{{ $property->area }} m²</span>
            </li>
            <li class="flex items-start underline-item">
              <strong class="w-32">{{__('Price')}}:</strong>
              <span>${{ number_format($property->price, 2) }}</span>
            </li>
            <li class="flex items-start underline-item">
              <strong class="w-32">{{__('Parking')}}:</strong>
              <span>{{ $property->is_parking_available ? __('Yes') : __('No') }}</span>
            </li>
            <li class="flex items-start underline-item">
              <strong class="w-32">{{__('Safety')}}:</strong>
              <span>{{ $property->safety }}</span>
            </li>
            <li class="flex items-start underline-item">
              <strong class="w-32">{{__('Payment')}}:</strong>
              <span>{{ $property->payment_process }}</span>
            </li>
          </ul>
        </section>

        <!-- Gallery -->

        @if($property->gallery->isNotEmpty())
        <section class="property-gallery-section border rounded-lg p-6 mt-6 bg-dark">
          <h3 class="text-2xl font-bold text-white mb-4">{{__('Gallery')}}</h3>
          <div class="gallery-grid grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
            @foreach($property->gallery as $galleryImage)
            @foreach($galleryImage->image_url as $url)
            <a href="{{ asset('storage/' . $url) }}" data-fancybox="gallery" data-caption="{{ $property->property_name }}">
              <img src="{{ asset('storage/' . $url) }}" alt="Gallery Image" class="rounded-lg w-full h-auto" loading="lazy">
            </a>
            @endforeach
            @endforeach
            <button id="load-more" style="display: none;">{{__('See More')}}</button>
          </div>
        </section>
        @endif

      </div>
      <div class="col-lg-4">
        <div class="info-table">
          <ul>
            <li>
              <img src="{{ asset('Images/info-icon-01.png') }}" alt="" style="max-width: 52px;">
              <h4>{{ $property->area }} m²<br><span>{{__('Total Flat Space')}}</span></h4>
            </li>
            <li>
              <img src="{{ asset('Images/info-icon-02.png') }}" alt="" style="max-width: 52px;">
              <h4>{{__('Contract')}}<br><span>{{__('Contract Ready')}}</span></h4>
            </li>
            <li>
              <img src="{{ asset('Images/info-icon-03.png') }}" alt="" style="max-width: 52px;">
              <h4>{{__('Payment')}}<br><span>{{ $property->payment_process }}</span></h4>
            </li>
            <li>
              <img src="{{ asset('Images/info-icon-04.png') }}" alt="" style="max-width: 52px;">
              <h4>{{__('Safety')}}<br><span>{{ $property->safety }}</span></h4>
            </li>
          </ul>
        </div>
      </div>
      <!-- Modal Structure -->
      <div id="image-modal" class="modal" style="display: none;">
        <div class="modal-content">
          <span class="close-button">&times;</span>
          <div id="modal-gallery" class="gallery-grid grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
          </div>
        </div>
      </div>
    </div>