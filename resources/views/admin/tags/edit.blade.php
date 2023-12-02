@extends('admin.layouts.layout')

@section('content-header', 'Editing a tag')

@section('content')

    <div class="card-header">
        <h3 class="card-title">Tag "{{ $tag->title }}"</h3>
    </div>
    <!-- /.card-header -->

    <form role="form" method="post" action="{{ route('tags.update', ['tag' => $tag->id]) }}">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title"
                       class="form-control @error('title') is-invalid @enderror" id="title"
                       value="{{ old('title', $tag->title) }}">
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
