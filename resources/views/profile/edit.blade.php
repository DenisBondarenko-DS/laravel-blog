@extends('layouts.user_layout')

@section('content')

    @if (session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('profile.update') }}" method="POST" class="form-wrapper" enctype="multipart/form-data">
        @csrf

        <h4>Settings</h4>

        <label for="name">Name</label>
        <input type="text" id="name" name="name" class="form-control mb-0" value="{{ old('name', auth()->user()->name) }}" placeholder="Your name">
        @error('name')
            <div class="text-danger">{{ $message }}</div>
        @enderror

        <label for="email" class="mt-3">Email</label>
        <input type="text" id="email" name="email" class="form-control mb-0" value="{{ old('email', auth()->user()->email) }}" placeholder="Email address">
        @error('email')
            <div class="text-danger">{{ $message }}</div>
        @enderror

        <label for="password" class="mt-3">New password</label>
        <input type="password" class="form-control mb-0" id="password" name="password">
        @error('password')
            <div class="text-danger">{{ $message }}</div>
        @enderror

        <label for="password_confirmation" class="mt-3">Retype password</label>
        <input type="password" class="form-control mb-0" id="password_confirmation" name="password_confirmation">

        <label for="avatar" class="mt-3">Avatar</label>
        <img src="{{ auth()->user()->getImage() }}" class="img-thumbnail mb-3" style="max-width: 100px" alt="">
        <input type="file" name="avatar" class="mb-2">
        @error('avatar')
            <div class="text-danger">{{ $message }}</div>
        @enderror

        <button type="submit" class="btn btn-primary mt-5">Update <i class="fa fa-envelope-open-o"></i></button>
    </form>

    <style>
        .form-wrapper label {
            display: block;
            font-weight: bold;
        }

        .form-wrapper button,
        .form-wrapper input {
            display: block;
        }
    </style>

@endsection
