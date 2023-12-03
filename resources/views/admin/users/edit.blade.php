@extends('admin.layouts.layout')

@section('content-header', 'Editing a user')

@section('content')

    <div class="card-header">
        <h3 class="card-title">User "{{ $user->name }}"</h3>
    </div>
    <!-- /.card-header -->

    <form role="form" method="post" action="{{ route('users.update', ['user' => $user->id]) }}">
        @csrf
        @method('PUT')
        <div class="card-body">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" name="name"
                       class="form-control @error('name') is-invalid @enderror" id="name"
                       value="{{ old('name', $user->name) }}">
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email"
                       class="form-control @error('email') is-invalid @enderror" id="email"
                       value="{{ old('email', $user->email) }}">
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="role">Role</label>
                <select class="form-control @error('role') is-invalid @enderror" name="role" id="role">
                    <option value="1" @selected(old('role', $user->role) == 1)>User</option>
                    <option value="2" @selected(old('role', $user->role) == 2)>Admin</option>
                </select>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>

@endsection
