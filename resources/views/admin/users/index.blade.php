@extends('adminlte::page')

@section('title', 'Users')

@section('content_header')
    <h1>Manage Users</h1>
@stop

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">All Platform Users</h3>
        <div class="card-tools">
            <form action="{{ route('admin.users.list') }}" method="GET">
                <div class="input-group input-group-sm" style="width: 250px;">
                    <input type="text" name="search" class="form-control float-right" placeholder="Search by name or email" value="{{ request('search') }}">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-default">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover table-striped text-nowrap">
            <thead class="thead-light">
                <tr>
                    <th>ID</th>
                    <th>User Details</th>
                    <th>Role(s)</th>
                    <th>KYC Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td class="align-middle">{{ $user->id }}</td>
                        <td class="align-middle">
                            <strong>{{ $user->name }}</strong><br>
                            <small class="text-muted">{{ $user->email }}</small><br>
                            @if($user->kycDetail && $user->kycDetail->phone)
                                <small class="text-muted"><i class="fas fa-phone fa-xs"></i> {{ $user->kycDetail->phone }}</small>
                            @endif
                        </td>
                        <td class="align-middle">
                            @foreach($user->roles as $role)
                                <span class="badge badge-secondary">{{ ucfirst($role->name) }}</span>
                            @endforeach
                        </td>
                        <td class="align-middle">
                            @php
                                $status = $user->kycDetail->kyc_status ?? 'pending';
                                $badgeClass = match($status) {
                                    'approved' => 'badge-success',
                                    'rejected' => 'badge-danger',
                                    'draft' => 'badge-warning',
                                    default => 'badge-info'
                                };
                            @endphp
                            <span class="badge {{ $badgeClass }}">{{ ucfirst($status) }}</span>
                            @if($user->kycDetail && $user->kycDetail->kyc_status != 'draft')
                                <br><small class="text-muted">Updated: {{ $user->kycDetail->updated_at->format('M d, Y') }}</small>
                            @endif
                        </td>
                        <td class="align-middle">
                            <a href="{{ route('admin.kyc.review', $user->id) }}" class="btn btn-sm btn-outline-primary">
                                <i class="fas fa-search"></i> Review KYC
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer clearfix">
        {{ $users->links() }}
    </div>
</div>
@stop
