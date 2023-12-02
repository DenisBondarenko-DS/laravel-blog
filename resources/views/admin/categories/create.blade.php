@extends('admin.layouts.layout')

@section('content-header', 'Categories')

@section('content')

    <div class="card-header">
        <h3 class="card-title">Create a category</h3>
    </div>
    <!-- /.card-header -->

    <form role="form" method="post" action="{{ route('categories.store') }}">
        @csrf
        <div class="card-body">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title"
                       class="form-control @error('title') is-invalid @enderror" id="title"
                       placeholder="Title" value="{{ old('title') }}">
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
