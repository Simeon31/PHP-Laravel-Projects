<div class="properties">
    <div class="item">
        <a href="{{ route('property-details', $property->id )}}">
            <img src="{{$property->getImage()}}" alt="">
        </a>
        <span class="category">
            @php
            $propertyType = $property->typeOfProperty->property_type;
            @endphp
            @if ($propertyType == "apartment" || $propertyType == "апартамент")
            {{ __("Apartment") }}
            @elseif ($propertyType == "vila" || $propertyType == "вила")
            {{ __("Villa") }}
            @elseif ($propertyType == "penthouse" || $propertyType == "пентхаус")
            {{ __("Penthouse") }}
            @endif
        </span>
        <h6>
            <strong>${{ number_format($property->price, 2) }}</strong>
        </h6>
        <h4 style="font-weight: bold;">
            <a href="{{ route('property-details', $property->id )}}">{{ $property->property_name }}</a>
        </h4>
        <ul>
            <li>{{__('Bedrooms')}}: <span>{{ $property->bedrooms }}</span></li>
            <li>{{__('Bathrooms')}}: <span>{{ $property->bathrooms }}</span></li>
            <li>{{__('Area')}}: <span>{{ $property->area }}</span></li>
            <li>{{__('Floor')}}: <span>{{ $property->floor }}</span></li>
            <li>{{__('Parking')}}: <span>{{ $property->parking_spots }}</span></li>
        </ul>
        <div class="main-button">
            <a href="{{ route('property-details', $property->id )}}">{{__('See property')}}</a>
        </div>
    </div>
</div>