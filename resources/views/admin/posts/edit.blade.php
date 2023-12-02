@extends('admin.layouts.layout')

@section('content-header', 'Editing a post')

@section('content')

    <div class="card-header">
        <h3 class="card-title">Post "{{ $post->title }}"</h3>
    </div>
    <!-- /.card-header -->

    <form role="form" method="post" action="{{ route('posts.update', ['post' => $post->id]) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title"
                       class="form-control @error('title') is-invalid @enderror" id="title"
                       placeholder="Title" value="{{ old('title', $post->title) }}">
                @error('title')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control summernote @error('description') is-invalid @enderror" name="description" id="description" placeholder="Description">{{ old('description', $post->description) }}</textarea>
                @error('description')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="content">Content</label>
                <textarea class="form-control summernote @error('content') is-invalid @enderror" name="content" id="content" placeholder="Content">{{ old('content', $post->content) }}</textarea>
                @error('content')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="category_id">Category</label>
                <select class="form-control select2 @error('category_id') is-invalid @enderror" name="category_id" id="category_id">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id', $post->category_id) == $category->id)>
                            {{ $category->title }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="tags">Tags</label>
                <select class="select2" multiple="multiple" name="tags[]" id="tags" data-placeholder="Tag selection" style="width: 100%;">
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}" @selected(in_array($tag->id, $post->tags->pluck('id')->all()))>
                            {{ $tag->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="thumbnail">Image</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input type="file" name="thumbnail" id="thumbnail" class="custom-file-input">
                        <label class="custom-file-label" for="thumbnail">Choose file</label>
                    </div>
                </div>
                @error('thumbnail')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div><img src="{{ $post->getImage() }}" class="img-thumbnail" style="max-width: 400px" alt=""></div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>

@endsection
