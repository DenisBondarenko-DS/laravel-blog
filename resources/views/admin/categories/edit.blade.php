@extends('admin.layouts.layout')

@section('content-header', 'Editing a category')

@section('content')

    <div class="card-header">
        <h3 class="card-title">Category "{{ $category->title }}"</h3>
    </div>
    <!-- /.card-header -->

    <form role="form" method="post" action="{{ route('categories.update', ['category' => $category->id]) }}">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title"
                       class="form-control @error('title') is-invalid @enderror" id="title"
                       value="{{ old('title', $category->title) }}">
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>

@endsection
