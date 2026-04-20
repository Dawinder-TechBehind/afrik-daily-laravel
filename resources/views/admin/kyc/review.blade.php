@extends('adminlte::page')

@section('title', 'Review KYC')

@section('content_header')
    <h1>Review KYC for {{ $user->name }}</h1>
@stop

@section('content')

@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<div class="row">
    <div class="col-md-8">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">KYC Details</h3>
            </div>
            <div class="card-body">
                @if($user->kycDetail)
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <th style="width: 200px;">Status</th>
                                <td>
                                    @php
                                        $status = $user->kycDetail->kyc_status ?? 'pending';
                                        $badgeClass = match($status) {
                                            'approved' => 'bg-success',
                                            'rejected' => 'bg-danger',
                                            'draft' => 'bg-warning',
                                            default => 'bg-info'
                                        };
                                    @endphp
                                    <span class="badge {{ $badgeClass }}">{{ ucfirst($status) }}</span>
                                </td>
                            </tr>
                            <tr>
                                <th>Full Name</th>
                                <td>{{ $user->kycDetail->full_name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td>{{ $user->kycDetail->email ?? $user->email }}</td>
                            </tr>
                            <tr>
                                <th>Phone Number</th>
                                <td>{{ $user->kycDetail->phone ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Date of Birth</th>
                                <td>{{ $user->kycDetail->dob ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Gender</th>
                                <td>{{ ucfirst($user->kycDetail->gender ?? 'N/A') }}</td>
                            </tr>
                            <tr>
                                <th>Occupation</th>
                                <td>{{ $user->kycDetail->occupation ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Address</th>
                                <td>{{ $user->kycDetail->address ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>City</th>
                                <td>{{ optional($user->kycDetail->city)->name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>State</th>
                                <td>{{ optional($user->kycDetail->state)->name ?? 'N/A' }}</td>
                            </tr>
                            <tr>
                                <th>Country</th>
                                <td>{{ optional($user->kycDetail->country)->name ?? 'N/A' }}</td>
                            </tr>
                            @if($status === 'rejected' && $user->kycDetail->rejection_reason)
                                <tr>
                                    <th>Rejection Reason</th>
                                    <td class="text-danger">{{ $user->kycDetail->rejection_reason }}</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                @else
                    <p>No KYC details submitted.</p>
                @endif
            </div>
        </div>

        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Uploaded Documents</h3>
            </div>
            <div class="card-body">
                @if($user->kycFiles && $user->kycFiles->count() > 0)
                    <div class="row">
                        @foreach($user->kycFiles as $kycFile)
                            <div class="col-md-4 mb-3">
                                <div class="border p-2 text-center h-100 d-flex flex-column justify-content-between">
                                    <p><strong>{{ ucfirst(str_replace('_', ' ', $kycFile->file_name ?? 'Document')) }}</strong></p>
                                    <div class="mt-auto">
                                        @if(in_array(strtolower(pathinfo($kycFile->file->file_path ?? '', PATHINFO_EXTENSION)), ['jpg','jpeg','png']))
                                            <a href="{{ $kycFile->file->url() }}" target="_blank">
                                                <img src="{{ $kycFile->file->url() }}" alt="Document" class="img-fluid rounded" style="max-height: 150px; object-fit: cover;">
                                            </a>
                                        @else
                                            <a href="{{ $kycFile->file->url() }}" target="_blank" class="btn btn-sm btn-info mt-2">View File</a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p>No documents uploaded.</p>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-info">
            <div class="card-header">
                <h3 class="card-title">Actions</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.kyc.approve', $user->id) }}" method="POST" class="mb-3">
                    @csrf
                    <button type="submit" class="btn btn-success btn-block" onclick="return confirm('Are you sure you want to approve this KYC?')">
                        <i class="fas fa-check"></i> Approve KYC
                    </button>
                </form>

                <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#rejectModal">
                    <i class="fas fa-times"></i> Reject KYC
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Reject Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="{{ route('admin.kyc.reject', $user->id) }}" method="POST">
        @csrf
        <div class="modal-header bg-danger">
          <h5 class="modal-title" id="rejectModalLabel">Reject KYC</h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label for="rejection_reason">Reason for Rejection (Visible to User)</label>
                <textarea name="rejection_reason" id="rejection_reason" class="form-control" rows="4" required placeholder="E.g. Document is blurry, Please re-upload ID..."></textarea>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger">Confirm Rejection</button>
        </div>
      </form>
    </div>
  </div>
</div>
@stop

@section('js')
    <script>
        // Ensure modal works with AdminLTE/Bootstrap 4
    </script>
@stop
