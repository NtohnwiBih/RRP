  <!-- ======= Top Bar ======= -->
  <section id="topbar" class="d-flex align-items-center">
    <div class="container d-flex justify-content-center justify-content-md-between">
      <div class="contact-info d-flex align-items-center">
        <i class="bi bi-envelope-fill"></i><a href="contact@rocheli.com">contact@rocheli.com</a>
        <i class="bi bi-phone-fill phone-icon"></i> +237 676 396 854
      </div>
      <div class="social-links d-none d-md-block">
        <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
        <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
        <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></i></a>
      </div>
    </div>
  </section>

  <!-- ======= Header ======= -->
  <header id="header" class="d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <!-- <h1 class="logo"><a href="#">Rocheli</a></h1> -->
      <!-- Uncomment below if you prefer to use an image logo -->
      <a href="{{ route('home') }}" class="logo"><img src="{{URL::to('frontend/assets/img/logo.png')}}" alt="" class="img-fluid"></a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="nav-link scrollto" href="{{ route('home') }}">Home</a></li>
          <li><a class="nav-link scrollto" href="{{route('properties.buy')}}">Buy</a></li>
          <li><a class="nav-link scrollto" href="{{route('properties.rent')}}">Rent</a></li>
          <li class="dropdown"><a href="#"><span>Properties</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              <li><a href="{{ route('properties.type', ['type' => 'Land']) }}">Land</a></li>
              <li class="dropdown"><a href="javascript: void(0);"><span>House</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="{{ route('properties.house.type', ['type' => 'Room']) }}">Room</a></li>
                  <li><a href="{{ route('properties.house.type', ['type' => 'Studio']) }}">Studio</a></li>
                  <li><a href="{{ route('properties.house.type', ['type' => 'Apartment']) }}">Apartment</a></li>
                </ul>
              </li>
              <li class="dropdown"><a href="javascript: void(0);"><span>Vehicle</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="{{ route('properties.vehicle.type', ['type' => 'Bike']) }}">Bike</a></li>
                  <li><a href="{{ route('properties.vehicle.type', ['type' => 'Car']) }}">Car</a></li>
                </ul>
              </li>
              <li><a href="#">Guest House</a></li>
            </ul>
          </li>
          <li><a class="nav-link scrollto" href="{{ route('about') }}">About</a></li>
          <li><a class="nav-link scrollto " href="{{ route('blog') }}">Blog</a></li>
          <li><a class="nav-link scrollto" href="#">Contact</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->