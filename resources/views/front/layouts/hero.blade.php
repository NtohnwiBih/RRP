 <!-- ======= Hero Section ======= -->
 <section id="hero" class="d-flex align-items-center">
    <div class="container position-relative" data-aos="fade-up" data-aos-delay="500">
        <div class="row fullscreen">
			<div class="banner-content col-lg-12 col-md-12">
				<h1>We’re Real Estate King</h1>
				<h2 class="text-warning">Easiest way to find your dream property</h2>
				<a href="#about" class="btn-get-started scrollto">Properties</a>
				<a href="{{route('register')}}" class="btn-get-started-second scrollto">Become an Agent</a>
				<!-- <div class="search-field">
					<form class="search-form" action="{{ route('search') }}" method="POST">
					@csrf
						<div class="row">
							<div class="col-lg-12 d-flex align-items-center justify-content-center toggle-wrap">
								<h4 class="search-title">Search Properties For</h4>
							</div>
							<div class="col-lg-4 col-md-6 col-xs-6">
								<select name="type" class="app-select form-control" required>
									<option data-display="Property Type">Property Type</option>
									<option>House</option>
									<option>Land</option>
									<option>Vehicle</option>
									<option>Guest House</option>
								</select>
							</div>
							<div class="col-lg-4 col-md-6 col-xs-6">
								<select name="region_id" class="app-select form-control" required>
									<option data-display="Choose locations">Choose region</option>
									@foreach($regions as $item)
										<option value="{{$item->id}}">{{$item->designation}}</option>
									@endforeach
								</select>
							</div>
							<div class="col-lg-4 col-md-6 col-xs-6">
								<input type="text" class="app-select form-control" name="keyword" placeholder="Search by keywords">
							</div>
						</div>
						<div class="searchOptions d-flex justify-content-end">
							<button type="submit" class="btn btn-primary">Search Properties<span class="lnr lnr-arrow-right"></span></button>
						</div>
					</form>
				</div> -->
			</div>
		</div>
    </div>
  </section><!-- End Hero -->