@extends('front.layouts.master')
@push('css')
<style>
    
/*--------------------------------------------------------------
# Hero Section
--------------------------------------------------------------*/

</style>
@endpush

@section('content')
 <!-- ======= Hero Section ======= -->
 <section class="hero d-flex align-items-center">
    <div class="container position-relative" data-aos="fade-up" data-aos-delay="500">
      <div class="row fullscreen">
				<div class="col-lg-12 col-md-12 text-center">
					<h1>Who we are</h1>
                    <nav aria-label="breadcrumb animated fadeIn">
                        <ol class="breadcrumb text-uppercase">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                            <li class="breadcrumb-item text-body active" aria-current="page">About</li>
                        </ol>
                    </nav>
				</div>
			</div>
    </div>
  </section><!-- End Hero -->

    <!-- About Start -->
    <section class="py-5">
      <div class="container py-5">
        <div class="row gy-4">
          <div class="col-lg-5">
            <div class="pt-1 bg-primary"><img class="img-fluid" src="{{URL::to('frontend/assets/img/about.jpg')}}" alt=""></div>
          </div>
          <div class="col-lg-7 px-5">
            <p class="h6 mb-1 text-uppercase text-primary mb-3">Our main services</p>
            <h2 class="mb-4">We Work With You To Address Your Most Critical Business Priorities</h2>
            <p class="text-sm text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            <ul class="list-check list-unstyled row px-3 gy-2 mb-4">
              <li class="text-sm text-muted col-lg-6">Acquire live chat enables sales</li>
              <li class="text-sm text-muted col-lg-6">Learn from customer feedback</li>
              <li class="text-sm text-muted col-lg-6">Engage - marketing automation</li>
              <li class="text-sm text-muted col-lg-6">Support -customer support</li>
              <li class="text-sm text-muted col-lg-6">Acquire live chat enables sales</li>
              <li class="text-sm text-muted col-lg-6">Learn from customer feedback</li>
            </ul>
            <ul class="list-inline py-4 border-top border-bottom d-flex align-items-center">
              <li class="list-inline-item pe-4 me-0"><img src="img/about-sign.png" alt="" width="80"></li>
              <li class="list-inline-item px-4 me-0 border-start">
                <h5 class="mb-0">Mforbesi Buesi</h5>
                <p class="small fw-normal text-muted mb-0">CEO and co-founder </p>
              </li>
              <li class="list-inline-item ps-4 border-start">
                <h5 class="mb-0">+237 676 396 854</h5>
                <p class="small fw-normal text-muted mb-0">Call to ask any question</p>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>
    <!-- About End -->
@endsection

@push('js')
@endpush