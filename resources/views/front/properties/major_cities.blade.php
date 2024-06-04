@extends('front.layouts.master')
@push('css')
@endpush

@section('content')
<!-- ======= About Section ======= -->
<section id="about" class="about">
    <div class="container-xxl">
        <div class="container">   
            <div class="section-title">
                <span>Properties in {{ $city }}</span>
                <h2>Property in {{ $city }}</h2>
                <p>Properties available for rent and for sale</p>
            </div>
            <div class="tab-content">
                <div class="row g-4">
                    @forelse($favorites as $favorite)
                       @if($favorite->property->status == 1)
                            @if($favorite->property->type == 'House')
                                <div class="col-lg-4 col-md-6 wow fadeInUp {{$favorite->action}}" data-wow-delay="0.1s">
                                    <div class="property-item rounded overflow-hidden">
                                        <div class="position-relative overflow-hidden">
                                            <a href="{{ route('propertyDetail',$favorite->id) }}">
                                                @if($favorite->house->type == 'Room')
                                                <img class="img-fluid" src="/uploads/images/property/house/room/{{json_decode($favorite->property->image)[0]}}" alt="">
                                                @elseif($favorite->house->type == 'Studio')
                                                <img class="img-fluid" src="/uploads/images/property/house/studio/{{json_decode($favorite->property->image)[0]}}" alt="">
                                                @elseif($favorite->house->type == 'Apartment')
                                                <img class="img-fluid" src="/uploads/images/property/house/apartment/{{json_decode($favorite->property->image)[0]}}" alt="">
                                                @endif
                                            </a>
                                            <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">{{$favorite->property->action}}</div>
                                            <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">{{$favorite->house->type}}</div>
                                        </div>
                                        <div class="p-4 pb-0">
                                            <h5 class="text-primary mb-3">XAF{{$favorite->property->amount}}</h5>
                                            <a class="d-block h5 mb-2" href="{{ route('propertyDetail',$favorite->id) }}">{{$favorite->property->name}}</a>
                                            <p><i class="fa fa-map-marker-alt text-primary me-2"></i>{{$favorite->property->quater}}, {{$favorite->property->city}}, {{$favorite->property->region}}</p>
                                        </div>
                                        <div class="d-flex border-top">
                                            @if($favorite->house->type == 'Room')
                                                <small class="flex-fill text-center border-end py-2"><i class="fa fa-bed text-primary me-2"></i>{{$favorite->room->type}}</small>
                                                <small class="flex-fill text-center border-end py-2"></small>
                                                <small class="flex-fill text-center py-2"></small>
                                            @elseif($favorite->house->type == 'Studio')
                                                <small class="flex-fill text-center border-end py-2"><i class="fa fa-bed text-primary me-2"></i>{{$favorite->studio->type}}</small>
                                                <small class="flex-fill text-center border-end py-2"></small>
                                                <small class="flex-fill text-center py-2"></small>
                                            @elseif($favorite->house->type == 'Apartment')
                                                <small class="flex-fill text-center border-end py-2"><i class="fa fa-ruler-combined text-primary me-2"></i>{{$favorite->apartment->livingroom}} Palours</small>
                                                <small class="flex-fill text-center border-end py-2"><i class="fa fa-bed text-primary me-2"></i>{{$favorite->apartment->bedroom}} Beds</small>
                                                <small class="flex-fill text-center py-2"><i class="fa fa-bath text-primary me-2"></i>{{$favorite->apartment->bathroom}} Baths</small>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @elseif($favorite->property->type == 'Land')
                                <div class="col-lg-4 col-md-6 wow fadeInUp {{$favorite->action}}" data-wow-delay="0.1s">
                                    <div class="property-item rounded overflow-hidden">
                                        <div class="position-relative overflow-hidden">
                                            <a href="{{ route('propertyDetail',$favorite->id) }}"><img class="img-fluid" src="/uploads/images/property/land/{{json_decode($favorite->property->image)[0]}}" alt=""></a>
                                            <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">{{$favorite->property->action}}</div>
                                            <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">{{$favorite->property->type}}</div>
                                        </div>
                                        <div class="p-4 pb-0">
                                            <h5 class="text-primary mb-3">XAF{{$favorite->property->amount}}</h5>
                                            <a class="d-block h5 mb-2" href="{{ route('propertyDetail',$favorite->id) }}">{{$favorite->property->name}}</a>
                                            <p><i class="fa fa-map-marker-alt text-primary me-2"></i>{{$favorite->property->quater}}, {{$favorite->property->city}}, {{$favorite->property->region}}</p>
                                        </div>
                                        <div class="d-flex border-top">
                                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-ruler-combined text-primary me-2"></i>{{$favorite->land->size}} Sqft</small>
                                            <small class="flex-fill text-center border-end py-2"></small>
                                            <small class="flex-fill text-center py-2"></small>
                                        </div>
                                    </div>
                                </div>
                            @elseif($favorite->property->type == 'Vehicle')
                                <div class="col-lg-4 col-md-6 wow fadeInUp {{$favorite->action}}" data-wow-delay="0.1s">
                                    <div class="property-item rounded overflow-hidden">
                                        <div class="position-relative overflow-hidden">
                                            <a href="{{ route('propertyDetail',$favorite->id) }}">
                                                @if($favorite->vehicle->type == 'Car')
                                                <img class="img-fluid" src="/uploads/images/property/vehicle/car/{{json_decode($favorite->property->image)[0]}}" alt="">
                                                @elseif($favorite->vehicle->type == 'Bike')
                                                <img class="img-fluid" src="/uploads/images/property/vehicle/bike/{{json_decode($favorite->property->image)[0]}}" alt="">
                                                @endif
                                            </a>
                                            <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">{{$favorite->property->action}}</div>
                                            <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">{{$favorite->vehicle->type}}</div>
                                        </div>
                                        <div class="p-4 pb-0">
                                            <h5 class="text-primary mb-3">XAF{{$favorite->property->amount}}</h5>
                                            <a class="d-block h5 mb-2" href="{{ route('propertyDetail',$favorite->id) }}">{{$favorite->property->name}}</a>
                                            <p><i class="fa fa-map-marker-alt text-primary me-2"></i>{{$favorite->property->quater}}, {{$favorite->property->city}}, {{$favorite->property->region}}</p>
                                        </div>
                                        <div class="d-flex border-top">
                                                @if($favorite->vehicle->type == 'Car')
                                                    <small class="flex-fill text-center border-end py-2"><i class="fa fa-ruler-combined text-primary me-2"></i>{{$favorite->vehicle->sits}} Seats</small>
                                                    <small class="flex-fill text-center border-end py-2"><i class="fa fa-bed text-primary me-2"></i>{{$favorite->vehicle->color}}</small>
                                                    <small class="flex-fill text-center py-2"><i class="fa fa-bath text-primary me-2"></i>{{$favorite->car->brand}}</small>
                                                @elseif($favorite->vehicle->type == 'Bike')
                                                    <small class="flex-fill text-center border-end py-2"><i class="fa fa-ruler-combined text-primary me-2"></i>{{$favorite->bike->model}}</small>
                                                    <small class="flex-fill text-center py-2"><i class="fa fa-bath text-primary me-2"></i>{{$favorite->bike->brand}}</small>
                                                    <small class="flex-fill text-center border-end py-2"><i class="fa fa-bed text-primary me-2"></i>{{$favorite->bike->color}}</small>
                                                @endif
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif
                        @empty
                         <h5 class="text-center">No properties found in this city.</h5>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section><!-- End About Section -->
@endsection

@push('js')
@endpush