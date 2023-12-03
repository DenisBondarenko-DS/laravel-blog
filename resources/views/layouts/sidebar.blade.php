<div class="sidebar">
    <div class="widget">
        <form class="form-inline mr-auto" method="get" action="#">
            <input name="s" class="form-control @error('s') is-invalid @enderror" type="text" placeholder="Search" required>
            <button class="btn btn-outline-success btn-search" type="submit">Search</button>
        </form>

        <style>
            .sidebar .form-inline .form-control {
                width: 75%;
                border-radius: 0;
            }
            .sidebar .form-inline .form-control.is-invalid {
                border: 2px solid red;
            }
            .btn-search {
                padding: 10px;
            }
        </style>
    </div>

    <div class="widget">
        <h2 class="widget-title">Popular Posts</h2>
        <div class="blog-list-widget">
            <div class="list-group">
                @foreach ($popular_posts as $post)
                    <a href="{{ route('posts.single', ['slug' => $post->slug]) }}" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="w-100 justify-content-between">
                            <img src="{{ $post->getImage() }}" alt="" class="img-fluid float-left">
                            <h5 class="mb-1">{{ $post->title }}</h5>
                            <small>{{ $post->getPostDate() }}</small>
                        </div>
                    </a>
                @endforeach
            </div>
        </div><!-- end blog-list -->
    </div><!-- end widget -->

    <div class="widget">
        <h2 class="widget-title">Categories</h2>
        <div class="link-widget">
            <ul>
                @foreach ($categories as $category)
                    <li>
                        <a href="#">
                            {{ $category->title }} <span>({{ $category->posts_count }})</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div><!-- end link-widget -->
    </div><!-- end widget -->
</div><!-- end sidebar -->
