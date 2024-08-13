<?php
$categoryIds = [1, 2, 3];
$bestDealProperties = \App\Models\BestDealProperty::getBestDealProperties($categoryIds);
?>
<div class="section best-deal">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="section-heading">
                    <h6>| {{__('Best Deal')}}</h6>
                    <h2>{{__('Find Your Best Deal Right Now')}}!</h2>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="tabs-content">
                    <div class="row">
                        <div class="nav-wrapper">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="apartment-tab" data-bs-toggle="tab" data-bs-target="#apartment" type="button" role="tab" aria-controls="apartment" aria-selected="true">{{__('Apartment')}}</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="villa-tab" data-bs-toggle="tab" data-bs-target="#villa" type="button" role="tab" aria-controls="villa" aria-selected="false">{{__('Villa House')}}</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="penthouse-tab" data-bs-toggle="tab" data-bs-target="#penthouse" type="button" role="tab" aria-controls="penthouse" aria-selected="false">{{__('Penthouse')}}</button>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content" id="myTabContent">
                            @php
                            $categories = [1 => 'apartment', 2 => 'villa', 3 => 'penthouse'];
                            @endphp
                            
                            @foreach($categories as $categoryId => $tabId)
                            @php
                            $bestDealProperty = $bestDealProperties->get($categoryId);
                            @endphp
                            
                            <div class="tab-pane fade @if($loop->first) show active @endif" id="{{ $tabId }}" role="tabpanel" aria-labelledby="{{ $tabId }}-tab">
                                @if($bestDealProperty && $bestDealProperty->property)
                                <div class="row">
                                    <div class="col-lg-3">
                                        <div class="info-table">
                                            <ul>
                                                <li>{{__('Total Flat Space')}} <span>{{ $bestDealProperty->property->area ?? 'No property area' }} m2</span></li>
                                                <li>{{__('Floor number')}} <span>{{ $bestDealProperty->property->floor ?? 'No property floor' }}th</span></li>
                                                <li>{{__('Number of rooms')}} <span>{{ $bestDealProperty->property->bedrooms ?? 'No bedrooms' }}</span></li>
                                                <li>{{__('Parking Available')}} <span>{{ $bestDealProperty->property->is_parking_available ? __('Yes') : __('No') }}</span></li>
                                                <li>{{__('Payment Process')}} <span>{{ $bestDealProperty->property->payment_process ?? 'No property payment process' }}</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <img src="{{ $bestDealProperty->property->getImage() ?? 'No property image' }}" alt="" loading="lazy">
                                    </div>
                                    <div class="col-lg-3">
                                        <h4>{{__('Description')}}</h4>
                                        <p style="color: #000727;">{!! $bestDealProperty->property->description ?? 'No property description' !!}</p>
                                        <div class="icon-button">
                                            <a href="{{ route('property-details', $bestDealProperty->property->id) }}"><i class="fa fa-calendar"></i>{{__('See property')}}</a>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <p class="error-message">No best deal available for this category.</p>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>