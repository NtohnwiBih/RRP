
            <div id="comment-2" class="comment">
                <div class="d-flex">
                    <div class="comment-img"><img src="assets/img/blog/comments-2.jpg" alt=""></div>
                    <div>
                    <h5><a href="">{{ $comment->user->name }}</a> <a href="javascript: void(0);" class="reply">{{$comment->created_at->diffForHumans()}}</a></h5>
                    <p>{{ $comment->body }}</p>
                    </div>
                </div>

            </div><!-- End comment reply #1-->

                
