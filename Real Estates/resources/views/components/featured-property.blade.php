@if($property && $property->property)
    <div class="featured section">
      <div class="container">
        <div class="row">
          <div class="col-lg-5">
            <div class="left-image">
              <img src="{{ $property->property->getImage() ?? 'default-image.png' }}" alt="">
              <a>
                <img src="{{ asset('Images/featured-icon.png') }}" alt="" style="max-width: 60px; padding: 0px;">
              </a>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="section-heading">
              <h6>| {{__('Featured')}}</h6>
              <h2>{{ $property->property->property_name ?? 'No Featured Property' }}</h2>
            </div>
            <section class="border rounded-lg p-6 featured-description">
              <h3 class="text-xl font-semibold text-white mb-4">{{__('Property Highlights')}}</h3>
              <p style="color: white;">
                {!! $property->property->description ?? 'No property description' !!}
              </p>
            </section>
          </div>
          <div class="col-lg-3">
            <div class="info-table">
              <ul>
                <li>
                  <img src="{{ asset('Images/info-icon-01.png') }}" alt="" style="max-width: 52px;">
                  <h4>{{ $property->property->area ?? 'No property area' }} m2<br><span>{{__('Total Space')}}</span></h4>
                </li>
                <li>
                  <img src="{{ asset('Images/info-icon-02.png') }}" alt="" style="max-width: 52px;">
                  <h4>{{__('Contract')}}<br><span>Contract Ready</span></h4>
                </li>
                <li>
                  <img src="{{ asset('Images/info-icon-03.png') }}" alt="" style="max-width: 52px;">
                  <h4>{{__('Payment')}}<br><span>{{ $property->property->payment_process ?? 'No property payment process' }}</span></h4>
                </li>
                <li>
                  <img src="{{ asset('Images/info-icon-04.png') }}" alt="" style="max-width: 52px;">
                  <h4>{{__('Safety')}}<br><span>{{ $property->property->safety ?? 'No property safety' }}</span></h4>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    @else
    <p>No featured property available.</p>
    @endif