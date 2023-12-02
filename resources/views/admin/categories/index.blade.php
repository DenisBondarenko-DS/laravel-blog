@extends('admin.layouts.layout')

@section('content-header', 'Categories')

@section('content')

<div class="card-header">
    <h3 class="card-title">List of categories</h3>
</div>

<div class="card-body">
    @can('create', \App\Models\Category::class)
        <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Add category</a>
    @endcan

    @if (count($categories))
        <div class="table-responsive">
            <table class="table table-bordered table-hover text-nowrap">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Title</th>
                    <th>Slug</th>

                    @can(['update', 'delete'], \App\Models\Category::class)
                        <th style="width: 100px">Actions</th>
                    @endcan
                </tr>
                </thead>
                <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->title }}</td>
                        <td>{{ $category->slug }}</td>

                        @can(['update', 'delete'], \App\Models\Category::class)
                            <td>
                                <a href="{{ route('categories.edit', ['category' => $category->id]) }}" class="btn btn-info btn-sm float-left mr-1">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>

                                <form action="{{ route('categories.destroy', ['category' => $category->id]) }}" method="post" class="float-left">
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
        <p>No categories yet</p>
    @endif
</div>
<!-- /.card-body -->

<div class="card-footer clearfix">
    {{ $categories->links() }}
</div>

@endsection
