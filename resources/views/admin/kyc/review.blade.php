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
    <div class="col-12 mb-3">
        <div class="card bg-light border-0 shadow-sm">
            <div class="card-body py-2 px-4 d-flex justify-content-between align-items-center">
                <div>
                    <h5 class="mb-1"><i class="fas fa-user-circle text-primary"></i> {{ $user->kycDetail->full_name ?? $user->name }}</h5>
                    <span class="text-muted"><i class="fas fa-envelope"></i> {{ $user->email }} | <i class="fas fa-globe"></i> {{ optional($user->kycDetail->country)->name ?? 'N/A' }}</span>
                </div>
                <div class="text-right">
                    <small class="text-muted d-block">Submitted At</small>
                    <strong><i class="fas fa-calendar-alt"></i>
                     {{ $user?->kycDetail?->submitted_at ? $user?->kycDetail?->submitted_at->format('d M Y, h:i A') : ($user?->kycDetail?->updated_at ? $user?->kycDetail?->updated_at?->format('d M Y, h:i A') : 'N/A') }}</strong>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-info-circle"></i> KYC Details</h3>
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
                                            'pending' => 'bg-warning',
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
                                <th>ID Type</th>
                                <td>{{ \Illuminate\Support\Str::title(str_replace('_', ' ', $user->kycDetail->id_type ?? 'N/A')) }}</td>
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

        <div class="card card-secondary card-outline">
            <div class="card-header">
                <h3 class="card-title"><i class="fas fa-file-alt"></i> Identity & Address Documents</h3>
            </div>
            <div class="card-body">
                @if($user->kycFiles && $user->kycFiles->count() > 0)
                    @php
                        $identityFiles = $user->kycFiles->filter(function($f) {
                            return in_array($f->file_name, ['id_front', 'id_back']);
                        });
                        $selfieFiles = $user->kycFiles->filter(function($f) {
                            return in_array($f->file_name, ['selfie']);
                        });
                        $addressFiles = $user->kycFiles->filter(function($f) {
                            return in_array($f->file_name, ['proof_of_address']);
                        });
                        $otherFiles = $user->kycFiles->filter(function($f) {
                            return !in_array($f->file_name, ['id_front', 'id_back', 'selfie', 'proof_of_address']);
                        });
                    @endphp

                    @if($identityFiles->count() > 0)
                        <h5 class="mt-2 mb-3 border-bottom pb-2">
                            <i class="fas fa-id-card text-primary"></i> Identity Document 
                            @if($user->kycDetail && $user->kycDetail->id_type)
                                <span class="badge badge-info ml-2 text-sm">{{ \Illuminate\Support\Str::title(str_replace('_', ' ', $user->kycDetail->id_type)) }}</span>
                            @endif
                        </h5>
                        <div class="row mb-4">
                            @foreach($identityFiles as $kycFile)
                                <div class="col-md-6 mb-3">
                                    <div class="border p-2 text-center h-100 d-flex flex-column justify-content-between shadow-sm bg-light rounded">
                                        <p class="text-sm"><strong>{{ \Illuminate\Support\Str::title(str_replace('_', ' ', $kycFile->file_name ?? 'Document')) }}</strong></p>
                                        <div class="mt-auto">
                                            @if(in_array(strtolower(pathinfo($kycFile->file->file_path ?? '', PATHINFO_EXTENSION)), ['jpg','jpeg','png']))
                                                <a href="javascript:void(0)" class="lightbox-trigger" data-image="{{ $kycFile->file->url() }}">
                                                    <img src="{{ $kycFile->file->url() }}" alt="Document" class="img-fluid rounded border" style="max-height: 200px; object-fit: cover;">
                                                </a>
                                            @else
                                                <a href="{{ $kycFile->file->url() }}" target="_blank" class="btn btn-sm btn-info mt-2"><i class="fas fa-file-pdf"></i> View File</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    @if($selfieFiles->count() > 0)
                        <h5 class="mt-2 mb-3 border-bottom pb-2">
                            <i class="fas fa-camera text-primary"></i> Facial Verification (Selfie)
                        </h5>
                        <div class="row mb-4">
                            @foreach($selfieFiles as $kycFile)
                                <div class="col-md-6 mb-3">
                                    <div class="border p-2 text-center h-100 d-flex flex-column justify-content-between shadow-sm bg-light rounded">
                                        <p class="text-sm"><strong>{{ \Illuminate\Support\Str::title(str_replace('_', ' ', $kycFile->file_name ?? 'Document')) }}</strong></p>
                                        <div class="mt-auto">
                                            @if(in_array(strtolower(pathinfo($kycFile->file->file_path ?? '', PATHINFO_EXTENSION)), ['jpg','jpeg','png']))
                                                <a href="javascript:void(0)" class="lightbox-trigger" data-image="{{ $kycFile->file->url() }}">
                                                    <img src="{{ $kycFile->file->url() }}" alt="Document" class="img-fluid rounded border" style="max-height: 200px; object-fit: cover;">
                                                </a>
                                            @else
                                                <a href="{{ $kycFile->file->url() }}" target="_blank" class="btn btn-sm btn-info mt-2"><i class="fas fa-file-pdf"></i> View File</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    @if($addressFiles->count() > 0)
                        <h5 class="mt-4 mb-3 border-bottom pb-2"><i class="fas fa-map-marked-alt text-primary"></i> Address Verification</h5>
                        <div class="row">
                            @foreach($addressFiles as $kycFile)
                                <div class="col-md-4 mb-3">
                                    <div class="border p-2 text-center h-100 d-flex flex-column justify-content-between shadow-sm bg-light rounded">
                                        <p class="text-sm"><strong>{{ \Illuminate\Support\Str::title(str_replace('_', ' ', $kycFile->file_name ?? 'Document')) }}</strong></p>
                                        <div class="mt-auto">
                                            @if(in_array(strtolower(pathinfo($kycFile->file->file_path ?? '', PATHINFO_EXTENSION)), ['jpg','jpeg','png']))
                                                <a href="javascript:void(0)" class="lightbox-trigger" data-image="{{ $kycFile->file->url() }}">
                                                    <img src="{{ $kycFile->file->url() }}" alt="Document" class="img-fluid rounded border" style="max-height: 120px; object-fit: cover;">
                                                </a>
                                            @else
                                                <a href="{{ $kycFile->file->url() }}" target="_blank" class="btn btn-sm btn-info mt-2"><i class="fas fa-file-pdf"></i> View File</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    @if($otherFiles->count() > 0)
                        <h5 class="mt-4 mb-3 border-bottom pb-2"><i class="fas fa-folder-open text-primary"></i> Other Documents</h5>
                        <div class="row">
                            @foreach($otherFiles as $kycFile)
                                <div class="col-md-4 mb-3">
                                    <div class="border p-2 text-center h-100 d-flex flex-column justify-content-between shadow-sm bg-light rounded">
                                        <p class="text-sm"><strong>{{ \Illuminate\Support\Str::title(str_replace('_', ' ', $kycFile->file_name ?? 'Document')) }}</strong></p>
                                        <div class="mt-auto">
                                            @if(in_array(strtolower(pathinfo($kycFile->file->file_path ?? '', PATHINFO_EXTENSION)), ['jpg','jpeg','png']))
                                                <a href="javascript:void(0)" class="lightbox-trigger" data-image="{{ $kycFile->file->url() }}">
                                                    <img src="{{ $kycFile->file->url() }}" alt="Document" class="img-fluid rounded border" style="max-height: 120px; object-fit: cover;">
                                                </a>
                                            @else
                                                <a href="{{ $kycFile->file->url() }}" target="_blank" class="btn btn-sm btn-info mt-2"><i class="fas fa-file-pdf"></i> View File</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif

                @else
                    <div class="alert alert-warning"><i class="fas fa-exclamation-triangle"></i> No documents uploaded.</div>
                @endif
            </div>
        </div>
        
        <!-- Timeline Section -->
        <div class="card card-default">
            <div class="card-header">
                <h3 class="card-title">KYC Audit Trail</h3>
            </div>
            <div class="card-body">
                @if($user->kycDetail && \App\Models\KycHistory::where('kyc_detail_id', $user->kycDetail->id)->count() > 0)
                    <div class="timeline">
                        @foreach(\App\Models\KycHistory::where('kyc_detail_id', $user->kycDetail->id)->latest()->get() as $history)
                            <div>
                                @if(str_contains(strtolower($history->description), 'approved'))
                                    <i class="fas fa-check bg-success"></i>
                                @elseif(str_contains(strtolower($history->description), 'rejected'))
                                    <i class="fas fa-times bg-danger"></i>
                                @elseif(str_contains(strtolower($history->description), 'started'))
                                    <i class="fas fa-play bg-info"></i>
                                @elseif(str_contains(strtolower($history->description), 'submitted'))
                                    <i class="fas fa-upload bg-primary"></i>
                                @else
                                    <i class="fas fa-dot-circle bg-secondary"></i>
                                @endif
                                <div class="timeline-item">
                                    <span class="time"><i class="fas fa-clock"></i> {{ $history->created_at->format('d M Y, h:i A') }}</span>
                                    <h3 class="timeline-header">{{ $history->description }}</h3>
                                    @if($history->note)
                                        <div class="timeline-body text-danger">
                                            <strong>Reason:</strong> {{ $history->note }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        <div>
                            <i class="fas fa-clock bg-gray"></i>
                        </div>
                    </div>
                @else
                    <p>No audit trail found.</p>
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
                <label for="rejection_type">Reason for Rejection (Visible to User)</label>
                <select name="rejection_type" id="rejection_type" class="form-control" required>
                    <option value="">Select a reason</option>
                    <option value="Blurry ID document">Blurry ID document</option>
                    <option value="Mismatch in selfie">Mismatch in selfie</option>
                    <option value="Invalid document type">Invalid document type</option>
                    <option value="Address proof not valid">Address proof not valid</option>
                    <option value="Other">Other (Custom Reason)</option>
                </select>
            </div>
            <div class="form-group" id="custom_reason_group" style="display: none;">
                <label for="rejection_reason">Optional Comment / Custom Reason</label>
                <textarea name="rejection_reason" id="rejection_reason" class="form-control" rows="3" placeholder="Enter custom reason or additional details..."></textarea>
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
<!-- Lightbox Modal -->
<div class="modal fade" id="lightboxModal" tabindex="-1" role="dialog" aria-hidden="true" style="background-color: rgba(0,0,0,0.85);">
  <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
    <div class="modal-content bg-transparent border-0 shadow-none">
      <div class="modal-header border-0 p-3" style="position: absolute; right: 0; top: 0; z-index: 1055;">
        <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close" style="opacity: 1; font-size: 2.5rem; text-shadow: 0 1px 3px rgba(0,0,0,0.5);">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center p-0" style="overflow: auto; max-height: 100vh;">
        <img id="lightboxImage" src="" alt="Document Preview" class="img-fluid" style="max-height: 90vh; cursor: zoom-in; object-fit: contain;">
      </div>
    </div>
  </div>
</div>

@stop

@section('js')
    <script>
        $(document).ready(function() {
            // Lightbox
            $('.lightbox-trigger').click(function() {
                var imgSrc = $(this).data('image');
                $('#lightboxImage').attr('src', imgSrc);
                $('#lightboxModal').modal('show');
            });

            // Basic zoom functionality for lightbox
            let zoomed = false;
            $('#lightboxImage').click(function() {
                if(!zoomed) {
                    $(this).css({
                        'max-height': 'none',
                        'width': '100%',
                        'cursor': 'zoom-out'
                    });
                    zoomed = true;
                } else {
                    $(this).css({
                        'max-height': '90vh',
                        'width': 'auto',
                        'cursor': 'zoom-in'
                    });
                    zoomed = false;
                }
            });

            // Reset zoom on modal close
            $('#lightboxModal').on('hidden.bs.modal', function () {
                $('#lightboxImage').css({
                    'max-height': '90vh',
                    'width': 'auto',
                    'cursor': 'zoom-in'
                });
                zoomed = false;
            });

            // Rejection reason dropdown toggle
            $('#rejection_type').change(function() {
                if($(this).val() === 'Other') {
                    $('#custom_reason_group').show();
                    $('#rejection_reason').attr('required', true);
                } else {
                    $('#custom_reason_group').show();
                    $('#rejection_reason').removeAttr('required');
                }
            });
        });
    </script>
@stop
