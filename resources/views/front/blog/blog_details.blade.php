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
                        <h1>Blog Details</h1>
                    </div>
                </div>
        </div>
    </section><!-- End Hero -->

  <!-- Blog-details Section - Blog Details Page -->
    <section id="blog-details" class="blog-details">

        <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row g-5">

            <div class="col-lg-8">

            <article class="article">

                <div class="post-img">
                <img src="{{ asset('uploads/images/blog/' . $post_details['image']) }}" alt="" class="img-fluid">
                </div>

                <h2 class="title">{{ $post_details['title'] }}</h2>

                <div class="meta-top">
                <ul>
                    <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="blog-details.html">{{ $post_details->user->name }}</a></li>
                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="blog-details.html"><time datetime="2020-01-01">{{ $post_details->date }}</time></a></li>
                    <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a href="blog-details.html">{{ $post_details->comments->count() }} Comments</a></li>
                </ul>
                </div><!-- End meta top -->

                <div class="content">
                <p>
                  {{ $post_details['short'] }}
                </p>{{ $post_details['content'] }}</p>

                </div><!-- End post content -->
            </article><!-- End post article -->

            <div class="comments">

                <h4 class="comments-count">{{ $post_details->comments->count() }} Comments</h4>

                <div class="row px-2">
                    <div class="col-md-2 col-2">
                       <img src="{{URL::to('frontend/assets/img/blog-author.jpg')}}" class="rounded-circle flex-shrink-0 d-lg-block d-none" alt="" width="110" height="110">
                       <img src="{{URL::to('frontend/assets/img/blog-author.jpg')}}" class="rounded-circle flex-shrink-0 d-lg-none d-block mt-3" alt="" width="70" height="70">
                    </div>
                    <div class="col-md-10 col-10">
                    <form action="{{ route('comments.store',  $post_details->id) }}" method="POST" class="mt-3">
                        @csrf
                        <div class="form-group mb-2">
                            <textarea class="form-control" name="body" placeholder="Add a comment" rows="3"></textarea>
                        </div>
                        <div class="text-end">
                            <button type="reset" class="btn btn-secondary">Cancel</button>
                            <button type="submit" class="btn btn-primary">Comment</button>
                        </div>
                    </form>
                    </div>
                </div>

            @foreach($post_details->comments as $comment)
                @include('front.comments.partials.comment', ['comment' => $comment])
            @endforeach

            </div><!-- End blog comments -->

            </div>

            <div class="col-lg-4">

            <div class="sidebar">

                <div class="sidebar-item recent-posts">
                <h3 class="sidebar-title">Recent Posts</h3>
                @foreach($relatedPosts as $relatedPost)
                <div class="post-item">
                    <img src="{{ asset('uploads/images/blog/' . $relatedPost['image']) }}" alt="" class="flex-shrink-0">
                    <div>
                    <h4><a href="{{ route('blogDetail', $relatedPost->id) }}">{{ $relatedPost['title'] }}</a></h4>
                    <time datetime="2020-01-01">{{ $relatedPost['date'] }}</time>
                    </div>
                </div><!-- End recent post item-->
                @endforeach
                </div><!-- End sidebar recent posts-->

            </div><!-- End Sidebar -->

            </div>

        </div>

        </div>

    </section><!-- End Blog-details Section -->
@endsection

@push('js')
@endpush