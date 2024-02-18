@extends('layouts.user-layout')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h2>Your profile</h2>

    <img src="{{ auth()->user()->getImage() }}" class="img-thumbnail mb-3" style="max-width: 200px" alt="">

    <h5>Your name: {{ auth()->user()->name }}</h5>
    <h5>Your email: {{ auth()->user()->email }}</h5>
    <h5>Registration date: {{ auth()->user()->created_at }}</h5>

    <h5>Role: {{ auth()->user()->getRoleName() }}</h5>
@endsection
