@extends('admin.layouts.layout')

@section('content-header', 'Dashboard')

@section('dashboard')

    @can('viewAny', \App\Models\User::class)
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $usersCount }}</h3>
                    <p>User Registrations</p>
                </div>
                <div class="icon">
                    <i class="nav-icon fas fa-users"></i>
                </div>
                <a href="{{ route('users.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    @endcan

    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $categoriesCount }}</h3>
                <p>Categories</p>
            </div>
            <div class="icon">
                <i class="nav-icon fas fa-archive"></i>
            </div>
            <a href="{{ route('categories.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $tagsCount }}</h3>
                <p>Tags</p>
            </div>
            <div class="icon">
                <i class="nav-icon fas fa-tags"></i>
            </div>
            <a href="{{ route('tags.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->

    <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $postsCount }}</h3>
                <p>Posts</p>
            </div>
            <div class="icon">
                <i class="nav-icon fas fa-edit"></i>
            </div>
            <a href="{{ route('posts.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->

@endsection
