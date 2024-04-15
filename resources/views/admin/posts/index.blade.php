@extends('admin.layouts.layout')

@section('content-header', 'Posts')

@section('content')

<div class="card-header">
    <h3 class="card-title">List of posts</h3>
</div>

<div class="card-body">
    @if (count($categories))
        <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">Add post</a>
    @else
        <p>To create a post there must be at least one category</p>
    @endif

    @if (count($posts))
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-nowrap">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Tags</th>
                        <th>Date</th>
                        <th style="width: 100px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td>{{ $post->id }}</td>
                            <td>{{ $post->title }}</td>
                            <td>{{ $post->category->title }}</td>
                            <td>{{ $post->tags->pluck('title')->join(', ') }}</td>
                            <td>{{ $post->created_at }}</td>
                            <td>
                                <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn btn-info btn-sm float-left mr-1">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>

                                <form action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="post" class="float-left">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Confirm deletion')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p>No posts yet</p>
    @endif
</div>
<!-- /.card-body -->

<div class="card-footer clearfix">
    {{ $posts->links() }}
</div>

@endsection
