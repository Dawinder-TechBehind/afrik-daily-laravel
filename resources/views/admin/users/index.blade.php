@extends('adminlte::page')

@section('title', 'Users')

@section('content_header')
    <h1>Users</h1>
@stop

@section('content')

<div class="card">
    <div class="card-body p-0">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th width="60">ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th width="150">Created</th>
                </tr>
            </thead>

            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->format('d M Y') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">No users found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="card-footer">
        {{ $users->links() }}
    </div>
</div>

@stop
