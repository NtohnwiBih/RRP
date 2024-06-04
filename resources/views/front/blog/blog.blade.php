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
					<h1>Blog Posts</h1>
                    <nav aria-label="breadcrumb animated fadeIn">
                        <ol class="breadcrumb text-uppercase">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                            <li class="breadcrumb-item text-body active" aria-current="page">Blog</li>
                        </ol>
                    </nav>
				</div>
			</div>
    </div>
  </section><!-- End Hero -->

    <!-- Blog Section - Blog Page -->
    <section id="blog" class="blog">
        <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4 posts-list">
        @foreach ($newPosts as $post)
                   

            <div class="col-xl-4 col-lg-6">
            <article>

                <div class="post-img">
                <img src="{{ asset('uploads/images/blog/' . $post['image']) }}" alt="" class="img-fluid">
                </div>

                <p class="post-category">Politics</p>

                <h2 class="title">
                <a href="{{ route('blogDetail',$post->id) }}">{{$post['title'] }}</a>
                </h2>

                <div class="d-flex align-items-center">
                <img src="{{ url('uploads/images/profile/' . $post->user->image)}}" alt="" class="img-fluid post-author-img flex-shrink-0">
                <div class="post-meta">
                    <p class="post-author">Maria Doe</p>
                    <p class="post-date">
                    <time datetime="2022-01-01">Jan 1, 2022</time>
                    </p>
                </div>
                </div>

            </article>
            </div><!-- End post list item -->

            @endforeach

        </div><!-- End blog posts list -->

        <div class="pagination d-flex justify-content-center">
            <ul>
            <li><a href="#">1</a></li>
            <li class="active"><a href="#">2</a></li>
            <li><a href="#">3</a></li>
            </ul>
        </div><!-- End pagination -->

        </div>
    </section><!-- End Blog Section -->
@endsection

@push('js')
@endpush