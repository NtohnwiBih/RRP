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
                @endif
                </div>
              @endforeach
              </div>
              <div class="swiper-pagination"></div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="portfolio-info">
              <h3>Project information</h3>
              <ul>
                <li><strong>Property Type</strong>: Web design</li>
                <li><strong>Standard</strong>: ASU Company</li>
                <li><strong>Location</strong>: 01 March, 2020</li>
              </ul>
              
            </div>
            <div class="portfolio-description">
              <h2>{{ $favorite_details->property->name}}</h2>
              <p>{{ $favorite_details->property->description }}</p>
            </div>
          </div>

        </div>

      </div>
    </section><!-- End Portfolio Details Section -->
@endsection

@push('js')
@endpush