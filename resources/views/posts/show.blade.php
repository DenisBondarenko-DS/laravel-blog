@extends('layouts.layout')

@section('title', 'Laravel Blog | ' . $post->title)

@section('content')

    <div class="page-wrapper">
        <div class="blog-title-area">
            <ol class="breadcrumb hidden-xs-down">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item">
                    <a href="{{ route('categories.single', ['category' => $post->category->slug]) }}">
                        {{ $post->category->title }}
                    </a>
                </li>
                <li class="breadcrumb-item active">{{ $post->title }}</li>
            </ol>

            <span class="color-yellow">
                <a href="{{ route('categories.single', ['category' => $post->category->slug]) }}" title="">
                    {{ $post->category->title }}
                </a>
            </span>

            <h3>{{ $post->title }}</h3>

            <div class="blog-meta big-meta">
                <small>{{ $post->getPostDate() }}</small>
                <small><i class="fa fa-eye"></i> {{ $post->views }}</small>
            </div><!-- end meta -->

        </div><!-- end title -->

        <div class="single-post-media">
            <img src="{{ $post->getImage() }}" alt="" class="img-fluid">
        </div><!-- end media -->

        <div class="blog-content">
            {!! $post->content !!}
        </div><!-- end content -->

        <div class="blog-title-area">
            @if ($post->tags->count())
                <div class="tag-cloud-single">
                    <span>Tags</span>
                    @foreach ($post->tags as $tag)
                        <small><a href="{{ route('tags.single', ['tag' => $tag->slug]) }}" title="">{{ $tag->title }}</a></small>
                    @endforeach
                </div><!-- end meta -->
            @endif
        </div><!-- end title -->

        <hr class="invis1">

        @if (auth()->user())
            <div class="custombox clearfix">
                <h4 class="small-title">Leave a Reply</h4>
                <div class="row">
                    <div class="col-lg-12">
                        <form method="post" action="{{ route('posts.comments.store', ['post' => $post->id]) }}" class="form-wrapper">
                            @csrf
                            <textarea class="form-control mb-0" name="text" placeholder="Your comment"></textarea>
                            @error('text')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            <button class="btn btn-primary mt-4" id="submit">Submit Comment</button>
                        </form>
                    </div>
                </div>
            </div>
        @else
            <div>
                <a href="{{ route('login_form') }}">Log in to your account</a> to leave a comment!
            </div>
        @endif

        <hr class="invis1">

        @if ($comments->count())
            <div class="custombox commentsBlock clearfix">
                <h4 class="small-title"><span class="comments-number">{{ $comments->count() }}</span> Comment(s)</h4>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="comments-list">
                            @foreach ($comments as $comment)
                                <div class="media">
                                    <p class="media-left">
                                        <img src="{{ $comment->user->getImage() }}" alt="" class="rounded-circle">
                                    </p>
                                    <div class="media-body">
                                        <h4 class="media-heading user_name">{{ $comment->user->name }} <small>{{ $comment->getCommentDate() }}</small></h4>
                                        <p>{{ $comment->text }}</p>

                                        @can('delete', $comment)
                                            <div class="delete-comment" data-comment-id="{{ $comment->id }}">
                                                Delete
                                            </div>
                                        @endcan
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end custom-box -->
        @else
            <p>No comments yet</p>
        @endif

    </div><!-- end page-wrapper -->

@endsection

@section('script')

    <script>
        $('.delete-comment').on('click', function (event) {
            let id = event.target.getAttribute('data-comment-id');
            let commentContainer = event.target.parentNode.parentNode;

            $.ajax({
                url: '{{ route('home') }}/comments/' + id,
                type: "DELETE",
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function (response) {
                    commentContainer.remove();

                    if (response.commentsCount === 0) {
                        $('.commentsBlock').remove();
                    } else {
                        $('.comments-number').text(response.commentsCount);
                    }
                }
            })
        })
    </script>

@endsection
