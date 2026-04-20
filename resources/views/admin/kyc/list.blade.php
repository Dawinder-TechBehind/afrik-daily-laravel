@extends('adminlte::page')

@section('title', 'KYC Submissions')

@section('content_header')
    <h1>KYC Submissions</h1>
@stop

@section('content')
<div class="card card-primary card-outline">
    <div class="card-header">
        <h3 class="card-title">Users requiring KYC Review</h3>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Submitted Date</th>
                    <th>KYC Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->kycDetail->updated_at ? $user->kycDetail->updated_at->format('M d, Y') : 'N/A' }}</td>
                        <td>
                            @php
                                $status = $user->kycDetail->kyc_status ?? 'pending';
                                $badgeClass = match($status) {
                                    'approved' => 'bg-success',
                                    'rejected' => 'bg-danger',
                                    'pending' => 'bg-warning',
                                    default => 'bg-info'
                                };
                            @endphp
                            <span class="badge {{ $badgeClass }}">{{ ucfirst($status) }}</span>
                        </td>
                        <td>
                            <a href="{{ route('admin.kyc.review', $user->id) }}" class="btn btn-sm btn-primary">
                                <i class="fas fa-eye"></i> Review Details
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">No KYC submissions found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    @if($users->hasPages())
        <div class="card-footer clearfix">
            {{ $users->links() }}
        </div>
    @endif
</div>
@stop
