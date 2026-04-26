@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content')
    @can('is-admin')
        @php
            $totalUsers = \App\Models\User::withoutRole('admin')->count();
            $pendingKyc = \App\Models\KycDetail::where('kyc_status', 'pending')->count();
            $approvedKyc = \App\Models\KycDetail::where('kyc_status', 'approved')->count();
            $rejectedKyc = \App\Models\KycDetail::where('kyc_status', 'rejected')->count();
            $recentKyc = \App\Models\KycDetail::with('user')->whereIn('kyc_status', ['pending', 'approved', 'rejected'])->orderBy('updated_at', 'desc')->take(5)->get();
        @endphp

        <div class="row " style="margin-top: 1rem;"  >
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info shadow-sm">
                    <div class="inner">
                        <h3>{{ $totalUsers }}</h3>
                        <p>Total Investors</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users text-white-50"></i>
                    </div>
                    <a href="{{ route('admin.users.list') }}" class="small-box-footer">View all <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning shadow-sm">
                    <div class="inner">
                        <h3>{{ $pendingKyc }}</h3>
                        <p>Pending KYC Reviews</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-clock text-white-50"></i>
                    </div>
                    <a href="{{ route('admin.kyc.index') }}" class="small-box-footer">Review Now <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success shadow-sm">
                    <div class="inner">
                        <h3>{{ $approvedKyc }}</h3>
                        <p>Approved Profiles</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-check-circle text-white-50"></i>
                    </div>
                    <a href="{{ route('admin.kyc.index') }}" class="small-box-footer">View all <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger shadow-sm">
                    <div class="inner">
                        <h3>{{ $rejectedKyc }}</h3>
                        <p>Rejected Profiles</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-times-circle text-white-50"></i>
                    </div>
                    <a href="{{ route('admin.kyc.index') }}" class="small-box-footer">View all <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>

        <div class="row" >
            <div class="col-12">
                <div class="card card-outline card-primary shadow-sm border-top-3">
                    <div class="card-header bg-white">
                        <h3 class="card-title"><i class="fas fa-list text-primary"></i> Recent KYC Submissions</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.kyc.index') }}" class="btn btn-sm btn-outline-primary">View All KYC Pipeline</a>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover table-striped mb-0">
                                <thead class="bg-light">
                                    <tr>
                                        <th class="border-top-0">Investor</th>
                                        <th class="border-top-0">Email</th>
                                        <th class="border-top-0">Current Status</th>
                                        <th class="border-top-0">Last Updated</th>
                                        <th class="border-top-0 text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($recentKyc as $kyc)
                                        <tr>
                                            <td class="align-middle">
                                                <div class="d-flex align-items-center">
                                                    <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mr-3 shadow-sm" style="width: 40px; height: 40px; font-size: 1.2rem;">
                                                        {{ strtoupper(substr($kyc->full_name ?? $kyc->user->name, 0, 1)) }}
                                                    </div>
                                                    <div>
                                                        <strong>{{ $kyc->full_name ?? $kyc->user->name }}</strong>
                                                        <br>
                                                        <small class="text-muted"><i class="fas fa-globe"></i> {{ optional($kyc->country)->name ?? 'Unknown Country' }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="align-middle text-muted">{{ $kyc->email ?? $kyc->user->email }}</td>
                                            <td class="align-middle">
                                                @if($kyc->kyc_status === 'approved')
                                                    <span class="badge badge-success px-2 py-1"><i class="fas fa-check"></i> Approved</span>
                                                @elseif($kyc->kyc_status === 'rejected')
                                                    <span class="badge badge-danger px-2 py-1"><i class="fas fa-times"></i> Rejected</span>
                                                @else
                                                    <span class="badge badge-warning px-2 py-1"><i class="fas fa-clock"></i> Pending Review</span>
                                                @endif
                                            </td>
                                            <td class="align-middle text-muted"><i class="far fa-clock"></i> {{ $kyc->updated_at ? $kyc->updated_at->diffForHumans() : 'N/A' }}</td>
                                            <td class="align-middle text-center">
                                                <a href="{{ route('admin.kyc.review', $kyc->user_id) }}" class="btn btn-sm btn-primary">
                                                    Review Details <i class="fas fa-arrow-right ml-1"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center py-5 text-muted">
                                                <i class="fas fa-folder-open mb-3 text-light" style="font-size: 48px;"></i><br>
                                                <h5>No Recent KYC Submissions</h5>
                                                <p>When investors submit their KYC, they will appear here.</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endcan

    @can('is-investor')
        @php
            $kycStatus = auth()->user()->kycDetail->kyc_status ?? 'draft';
            $rejectionType = auth()->user()->kycDetail->rejection_type ?? null;
            $rejectionReason = auth()->user()->kycDetail->rejection_reason ?? null;

            $stepClasses = [
                'draft' => ['bg-secondary', 'bg-secondary', 'bg-secondary'],
                'pending' => ['bg-success', 'bg-primary progress-bar-striped progress-bar-animated', 'bg-secondary'],
                'approved' => ['bg-success', 'bg-success', 'bg-success'],
                'rejected' => ['bg-success', 'bg-danger', 'bg-secondary']
            ];

            $currentSteps = $stepClasses[$kycStatus] ?? $stepClasses['draft'];
        @endphp

        <div class="card card-outline card-primary shadow-sm mb-4 mt-3">
            <div class="card-header border-bottom-0">
                <h3 class="card-title"><i class="fas fa-shield-alt text-primary"></i> KYC Verification Status</h3>
            </div>
            <div class="card-body">
                <!-- Visual Tracker -->
                <div class="row text-center mb-4">
                    <div class="col-4">
                        <div class="badge {{ $currentSteps[0] }} p-3 rounded-circle mb-2" style="width: 50px; height: 50px; line-height: 20px; font-size: 1.2rem;">
                            <i class="fas fa-file-upload"></i>
                        </div>
                        <p class="font-weight-bold mb-0">1. Submitted</p>
                    </div>
                    <div class="col-4">
                        <div class="badge {{ $currentSteps[1] }} p-3 rounded-circle mb-2" style="width: 50px; height: 50px; line-height: 20px; font-size: 1.2rem;">
                            @if($kycStatus === 'rejected')
                                <i class="fas fa-times"></i>
                            @else
                                <i class="fas fa-search"></i>
                            @endif
                        </div>
                        <p class="font-weight-bold mb-0">2. Under Review</p>
                    </div>
                    <div class="col-4">
                        <div class="badge {{ $currentSteps[2] }} p-3 rounded-circle mb-2" style="width: 50px; height: 50px; line-height: 20px; font-size: 1.2rem;">
                            <i class="fas fa-check-double"></i>
                        </div>
                        <p class="font-weight-bold mb-0">3. Approved</p>
                    </div>
                </div>
                
                <div class="progress mb-4" style="height: 4px;">
                    @php
                        $progressWidth = match($kycStatus) {
                            'draft' => '10%',
                            'pending' => '50%',
                            'rejected' => '50%',
                            'approved' => '100%',
                            default => '0%'
                        };
                        $progressColor = $kycStatus === 'rejected' ? 'bg-danger' : 'bg-primary';
                    @endphp
                    <div class="progress-bar {{ $progressColor }}" role="progressbar" style="width: {{ $progressWidth }}"></div>
                </div>

                <!-- Status Context -->
                @if($kycStatus === 'rejected')
                    <div class="alert alert-danger shadow-sm">
                        <h5><i class="icon fas fa-ban"></i> Action Required: KYC Rejected</h5>
                        <p>Your KYC application was not approved. Please review the reason below and update your details.</p>
                        <hr>
                        <strong>Reason:</strong> {{ $rejectionType ?? 'Verification Failed' }}<br>
                        @if($rejectionReason)
                            <span class="text-sm d-block mt-1"><i class="fas fa-info-circle"></i> {{ $rejectionReason }}</span>
                        @endif
                        <br>
                        <a href="{{ route('investor.kyc.index') }}" class="btn btn-sm btn-light mt-2 text-danger font-weight-bold">Update KYC Documents</a>
                    </div>
                @elseif($kycStatus === 'approved')
                    <div class="alert alert-success shadow-sm">
                        <h5><i class="icon fas fa-check-circle"></i> Verification Complete!</h5>
                        Your identity has been fully verified. Your account is unrestricted and you are ready to start investing.
                    </div>
                @elseif($kycStatus === 'pending')
                    <div class="alert alert-warning shadow-sm">
                        <h5><i class="icon fas fa-clock"></i> Review in Progress</h5>
                        Your KYC application has been received and is currently in our review queue. No further action is required from you at this moment. We will notify you once the review is complete.
                    </div>
                @else
                    <div class="alert alert-info shadow-sm">
                        <h5><i class="icon fas fa-info-circle"></i> Welcome! Let's get started.</h5>
                        To comply with financial regulations and unlock all features including investing, you must first complete your identity verification.
                        <br><br>
                        <a href="{{ route('investor.kyc.index') }}" class="btn btn-sm btn-light text-info font-weight-bold">Start KYC Verification</a>
                    </div>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3>$0.00</h3>
                        <p>My Portfolio</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-wallet"></i>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-6">
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3>0</h3>
                        <p>Active Investments</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                </div>
            </div>
        </div>
    @endcan
@stop

@section('css')
@stop

@section('js')
    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>
@stop
