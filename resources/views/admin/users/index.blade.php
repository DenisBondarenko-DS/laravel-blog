@extends('admin.layouts.layout')

@section('content-header', 'Users')

@section('content')

    <div class="card-header">
        <h3 class="card-title">List of users</h3>
    </div>

    <div class="card-body">
        <form action="{{ route('users.index') }}" method="GET">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="search" class="form-control" name="name" placeholder="Name" value="{{ request()->get('name') }}">
                            </div>
                        </div>

                        <div class="col-4">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="search" class="form-control" name="email" placeholder="Email" value="{{ request()->get('email') }}">
                            </div>
                        </div>

                        <div class="col-2">
                            <div class="form-group">
                                <label>Role</label>
                                <select class="form-control" name="role" style="width: 100%;">
                                    <option value="all">All roles</option>
                                    <option value="1" @selected(request()->get('role') == '1')>User</option>
                                    <option value="2" @selected(request()->get('role') == '2')>Admin</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-2">
                            <div class="form-group">
                                <label style="opacity: 0;">Find</label>
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default" style="width: 100%;">
                                        <i class="fa fa-search mr-1"></i>
                                        Find
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        @if (count($users))
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-nowrap">
                    <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th style="width: 100px">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->getRoleName() }}</td>
                            <td>
                                <a href="{{ route('users.edit', ['user' => $user->id]) }}" class="btn btn-info btn-sm float-left mr-1">
                                    <i class="fas fa-pencil-alt"></i>
                                </a>

                                <form action="{{ route('users.destroy', ['user' => $user->id]) }}" method="post" class="float-left">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Confirm deletion')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p>No users yet</p>
        @endif
    </div>
    <!-- /.card-body -->

    <div class="card-footer clearfix">
        {{ $users->withQueryString()->links() }}
    </div>

@endsection
