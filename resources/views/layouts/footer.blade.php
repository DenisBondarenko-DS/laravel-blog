<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                <div class="widget">
                    <h2 class="widget-title">Recent Posts</h2>
                    <div class="blog-list-widget">
                        @if (count($recent_posts))
                            <div class="list-group">
                                @foreach($recent_posts as $post)
                                    <a href="{{ route('posts.single', ['slug' => $post->slug]) }}" class="list-group-item list-group-item-action flex-column align-items-start">
                                        <div class="w-100 justify-content-between">
                                            <img src="{{ $post->getImage() }}" alt="" class="img-fluid float-left">
                                            <h5 class="mb-1">{{ $post->title }}</h5>
                                            <small>{{ $post->getPostDate() }}</small>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        @else
                            <p>There are no posts</p>
                        @endif
                    </div><!-- end blog-list -->
                </div><!-- end widget -->
            </div><!-- end col -->

            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                <div class="widget">
                    <h2 class="widget-title">Popular Posts</h2>
                    <div class="blog-list-widget">
                        @if (count($popular_posts))
                            <div class="list-group">
                                @foreach($popular_posts as $post)
                                    <a href="{{ route('posts.single', ['slug' => $post->slug]) }}" class="list-group-item list-group-item-action flex-column align-items-start">
                                        <div class="w-100 justify-content-between">
                                            <img src="{{ $post->getImage() }}" alt="" class="img-fluid float-left">
                                            <h5 class="mb-1">{{ $post->title }}</h5>
                                            <small><i class="fa fa-eye"></i> {{ $post->views }}</small>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        @else
                            <p>There are no posts</p>
                        @endif
                    </div><!-- end blog-list -->
                </div><!-- end widget -->
            </div><!-- end col -->

            <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                <div class="widget">
                    <h2 class="widget-title">Categories</h2>
                    <div class="link-widget">
                        @if (count($categories))
                            <ul>
                                @foreach($categories as $category)
                                    <li>
                                        <a href="{{ route('categories.single', ['category' => $category->slug]) }}">
                                            {{ $category->title }} <span>({{ $category->posts_count }})</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p>There are no categories</p>
                        @endif
                    </div><!-- end link-widget -->
                </div><!-- end widget -->
            </div><!-- end col -->
        </div><!-- end row -->

        <div class="row">
            <div class="col-md-12 text-center">
                <br>
                <br>
                <div class="copyright">&copy; Laravel Blog</div>
            </div>
        </div>
    </div><!-- end container -->
</footer><!-- end footer -->
