@extends('front.layouts.master')
@push('css')
@endpush

@section('content')
    <!-- ======= Portfolio Details Section ======= -->
    <section id="portfolio-details" class="portfolio-details">
      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-8">
            <div class="portfolio-details-slider swiper">
              <div class="swiper-wrapper align-items-center">
              @foreach (json_decode($favorite_details->property->image) as $image)
                <div class="swiper-slide">
                @if($favorite_details->property->type == 'House')
                  @if($favorite_details->house->type == 'Room')
                    <img src="/uploads/images/property/house/room/{{$image}}" alt="">
                  @elseif($favorite_details->house->type == 'Studio')
                    <img src="/uploads/images/property/house/studio/{{$image}}" alt="">
                  @elseif($favorite_details->house->type == 'Apartment')
                    <img src="/uploads/images/property/house/studio/{{$image}}" alt="">
                  @endif
                @elseif($favorite_details->property->type == 'Vehicle')
                  @if($favorite_details->vehicle->type == 'Bike')
                    <img src="/uploads/images/property/vehicle/bike/{{$image}}" alt="">
                  @elseif($favorite_details->vehicle->type == 'Car')
                    <img src="/uploads/images/property/vehicle/car/{{$image}}" alt="">
                  @endif
                @elseif($favorite_details->property->type == 'Land')
                  <img src="/uploads/images/property/land/{{$image}}" alt="">
                @endif
                </div>
              @endforeach
              </div>
              <div class="swiper-pagination"></div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="portfolio-info">
              <h3>Property information</h3>
              <ul>
                <li><strong>Property Type</strong>: {{ $favorite_details->property->type}}
                @if($favorite_details->property->type == 'House')
                , {{ $favorite_details->house->type}}
                @elseif($favorite_details->property->type == 'Vehicle')
                , {{ $favorite_details->vehicle->type}}
                @endif
              </li>
                <li><strong>Location</strong>: {{ $favorite_details->property->city}}</li>
                <li><strong>Date</strong>: {{ $favorite_details->property->date}}</li>
              </ul>
              <a href="javascript: void(0);" class="btn btn-sm mb-0" target="_blank"><img src="{{URL::to('frontend/assets/img/blog-author.jpg')}}" class="rounded-circle flex-shrink-0 d-lg-block d-none" alt="" width="30" height="30"></a>
              <a class="btn btn-sm mb-0" href="javascript: void(0);">{{ $favorite_details->user->name }}</a>    
            </div>
            <div class="portfolio-description">
              <h2>{{ $favorite_details->property->name}}</h2>
              <p>{!! $favorite_details->property->description !!}</p>
            </div>
            <a href="https://wa.me/+237{{$favorite_details->user->mobile}}?text=I%20am%20interested%20in%20this%20property%20{{ $favorite_details->property->name}}%20with%20id%20{{ $favorite_details->property->id}}" class="btn btn-success btn-sm mb-0" target="_blank">Whatsapp Agent</a>
            <a class="btn btn-primary btn-sm mb-0" href="tel:+237{{$favorite_details->user->mobile}}">Call Agent</a>
          </div>

        </div>

      </div>
    </section><!-- End Portfolio Details Section -->

    <div class="container-xxl py-5">
    <div class="container">
        <div class="tab-content">
            <div class="row g-4">
            @foreach($relatedProperties as $relatedProperty)
                    @if($relatedProperty->property->status == 1)
                        @if($relatedProperty->property->type == 'House')
                            <div class="col-lg-4 col-md-6 wow fadeInUp {{$relatedProperty->action}}" data-wow-delay="0.1s">
                                <div class="property-item rounded overflow-hidden">
                                    <div class="position-relative overflow-hidden">
                                        <a href="{{ route('propertyDetail',$relatedProperty->id) }}">
                                            @if($relatedProperty->house->type == 'Room')
                                            <img class="img-fluid" src="/uploads/images/property/house/room/{{json_decode($relatedProperty->property->image)[0]}}" alt="">
                                            @elseif($relatedProperty->house->type == 'Studio')
                                            <img class="img-fluid" src="/uploads/images/property/house/studio/{{json_decode($relatedProperty->property->image)[0]}}" alt="">
                                            @elseif($relatedProperty->house->type == 'Apartment')
                                            <img class="img-fluid" src="/uploads/images/property/house/apartment/{{json_decode($relatedProperty->property->image)[0]}}" alt="">
                                            @endif
                                        </a>
                                        <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">{{$relatedProperty->property->action}}</div>
                                        <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">{{$relatedProperty->house->type}}</div>
                                    </div>
                                    <div class="p-4 pb-0">
                                        <h5 class="text-primary mb-3">XAF{{$relatedProperty->property->amount}}</h5>
                                        <a class="d-block h5 mb-2" href="{{ route('propertyDetail',$relatedProperty->id) }}">{{$relatedProperty->property->name}}</a>
                                        <p><i class="fa fa-map-marker-alt text-primary me-2"></i>{{$relatedProperty->property->quater}}, {{$relatedProperty->property->city}}, {{$relatedProperty->property->region}}</p>
                                    </div>
                                    <div class="d-flex border-top">
                                        @if($relatedProperty->house->type == 'Room')
                                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-bed text-primary me-2"></i>{{$relatedProperty->room->type}}</small>
                                            <small class="flex-fill text-center border-end py-2"></small>
                                            <small class="flex-fill text-center py-2"></small>
                                        @elseif($relatedProperty->house->type == 'Studio')
                                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-bed text-primary me-2"></i>{{$relatedProperty->studio->type}}</small>
                                            <small class="flex-fill text-center border-end py-2"></small>
                                            <small class="flex-fill text-center py-2"></small>
                                        @elseif($relatedProperty->house->type == 'Apartment')
                                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-ruler-combined text-primary me-2"></i>{{$relatedProperty->apartment->livingroom}} Palours</small>
                                            <small class="flex-fill text-center border-end py-2"><i class="fa fa-bed text-primary me-2"></i>{{$relatedProperty->apartment->bedroom}} Beds</small>
                                            <small class="flex-fill text-center py-2"><i class="fa fa-bath text-primary me-2"></i>{{$relatedProperty->apartment->bathroom}} Baths</small>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @elseif($relatedProperty->property->type == 'Land')
                            <div class="col-lg-4 col-md-6 wow fadeInUp {{$relatedProperty->action}}" data-wow-delay="0.1s">
                                <div class="property-item rounded overflow-hidden">
                                    <div class="position-relative overflow-hidden">
                                        <a href="{{ route('propertyDetail',$relatedProperty->id) }}"><img class="img-fluid" src="/uploads/images/property/land/{{json_decode($relatedProperty->property->image)[0]}}" alt=""></a>
                                        <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">{{$relatedProperty->property->action}}</div>
                                        <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">{{$relatedProperty->property->type}}</div>
                                    </div>
                                    <div class="p-4 pb-0">
                                        <h5 class="text-primary mb-3">XAF{{$relatedProperty->property->amount}}</h5>
                                        <a class="d-block h5 mb-2" href="{{ route('propertyDetail',$relatedProperty->id) }}">{{$relatedProperty->property->name}}</a>
                                        <p><i class="fa fa-map-marker-alt text-primary me-2"></i>{{$relatedProperty->property->quater}}, {{$relatedProperty->property->city}}, {{$relatedProperty->property->region}}</p>
                                    </div>
                                    <div class="d-flex border-top">
                                        <small class="flex-fill text-center border-end py-2"><i class="fa fa-ruler-combined text-primary me-2"></i>{{$relatedProperty->land->size}} Sqft</small>
                                        <small class="flex-fill text-center border-end py-2"></small>
                                        <small class="flex-fill text-center py-2"></small>
                                    </div>
                                </div>
                            </div>
                        @elseif($relatedProperty->property->type == 'Vehicle')
                            <div class="col-lg-4 col-md-6 wow fadeInUp {{$relatedProperty->action}}" data-wow-delay="0.1s">
                                <div class="property-item rounded overflow-hidden">
                                    <div class="position-relative overflow-hidden">
                                        <a href="{{ route('propertyDetail',$relatedProperty->id) }}">
                                            @if($relatedProperty->vehicle->type == 'Car')
                                            <img class="img-fluid" src="/uploads/images/property/vehicle/car/{{json_decode($relatedProperty->property->image)[0]}}" alt="">
                                            @elseif($relatedProperty->vehicle->type == 'Bike')
                                            <img class="img-fluid" src="/uploads/images/property/vehicle/bike/{{json_decode($relatedProperty->property->image)[0]}}" alt="">
                                            @endif
                                        </a>
                                        <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">{{$relatedProperty->property->action}}</div>
                                        <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">{{$relatedProperty->vehicle->type}}</div>
                                    </div>
                                    <div class="p-4 pb-0">
                                        <h5 class="text-primary mb-3">XAF{{$relatedProperty->property->amount}}</h5>
                                        <a class="d-block h5 mb-2" href="{{ route('propertyDetail',$relatedProperty->id) }}">{{$relatedProperty->property->name}}</a>
                                        <p><i class="fa fa-map-marker-alt text-primary me-2"></i>{{$relatedProperty->property->quater}}, {{$relatedProperty->property->city}}, {{$relatedProperty->property->region}}</p>
                                    </div>
                                    <div class="d-flex border-top">
                                            @if($relatedProperty->vehicle->type == 'Car')
                                                <small class="flex-fill text-center border-end py-2"><i class="fa fa-ruler-combined text-primary me-2"></i>{{$relatedProperty->vehicle->sits}} Seats</small>
                                                <small class="flex-fill text-center border-end py-2"><i class="fa fa-bed text-primary me-2"></i>{{$relatedProperty->vehicle->color}}</small>
                                                <small class="flex-fill text-center py-2"><i class="fa fa-bath text-primary me-2"></i>{{$relatedProperty->car->brand}}</small>
                                            @elseif($relatedProperty->vehicle->type == 'Bike')
                                                <small class="flex-fill text-center border-end py-2"><i class="fa fa-ruler-combined text-primary me-2"></i>{{$relatedProperty->bike->model}}</small>
                                                <small class="flex-fill text-center py-2"><i class="fa fa-bath text-primary me-2"></i>{{$relatedProperty->bike->brand}}</small>
                                                <small class="flex-fill text-center border-end py-2"><i class="fa fa-bed text-primary me-2"></i>{{$relatedProperty->bike->color}}</small>
                                            @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
@endpush