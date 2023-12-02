@extends('admin.layouts.layout')

@section('content-header', 'Tags')

@section('content')

<div class="card-header">
    <h3 class="card-title">List of tags</h3>
</div>

<div class="card-body">
    @can('create', \App\Models\Tag::class)
        <a href="{{ route('tags.create') }}" class="btn btn-primary mb-3">Add tag</a>
    @endcan

    @if (count($tags))
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-nowrap">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Title</th>
                    <th>Slug</th>

                    @can(['update', 'delete'], \App\Models\Tag::class)
                        <th style="width: 100px">Actions</th>
                    @endcan
                </tr>
                </thead>
                <tbody>
                @foreach ($tags as $tag)
                    <tr>
                        <td>{{ $tag->id }}</td>
                        <td>{{ $tag->title }}</td>
                        <td>{{ $tag->slug }}</td>

                        @can(['update', 'delete'], \App\Models\Tag::class)
                            <td>
                                <a href="{{ route('tags.edit', ['tag' => $tag->id]) }}" class="btn btn-info btn-sm float-left mr-1">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>

                                <form action="{{ route('tags.destroy', ['tag' => $tag->id]) }}" method="post" class="float-left">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Confirm deletion')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        @endcan
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @else
        <p>No tags yet</p>
    @endif
</div>
<!-- /.card-body -->

<div class="card-footer clearfix">
    {{ $tags->links() }}
</div>

@endsection
