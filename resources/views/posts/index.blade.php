@extends('layouts.layout')

@section('title', 'Laravel Blog | Home')

@section('content')

    <div class="page-wrapper">
        <div class="blog-custom-build">
            @if (count($posts))
                @foreach ($posts as $post)
                    <div class="blog-box wow fadeIn">
                        <div class="post-media">
                            <a href="{{ route('posts.single', ['post' => $post->slug]) }}" title="">
                                <img src="{{ $post->getImage() }}" alt="" class="img-fluid">
                                <div class="hovereffect">
                                    <span></span>
                                </div>
                                <!-- end hover -->
                            </a>
                        </div>
                        <!-- end media -->

                        <div class="blog-meta big-meta text-center">
                            <h4><a href="{{ route('posts.single', ['post' => $post->slug]) }}" title="">{{ $post->title }}</a></h4>
                            <p>{!! $post->description !!}</p>
                            <small>
                                <a href="{{ route('categories.single', ['category' => $post->category->slug]) }}" title="">
                                    {{ $post->category->title }}
                                </a>
                            </small>
                            <small>{{ $post->getPostDate() }}</small>
                            <small><i class="fa fa-eye"></i> {{ $post->views }}</small>
                        </div><!-- end meta -->
                    </div><!-- end blog-box -->

                    <hr class="invis">
                @endforeach
            @else
                <p class="mb-0">There are no posts</p>
            @endif
        </div>
    </div>

    <hr class="invis">

    <div class="row">
        <div class="col-md-12">
            <nav aria-label="Page navigation">
                {{ $posts->links() }}
            </nav>
        </div><!-- end col -->
    </div><!-- end row -->

@endsection
