@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    @can('is-admin')
        <p>Welcome to the Afrik Daily Admin Dashboard.</p>
    @else
        <p>Welcome to the Afrik Daily Investor Dashboard.</p>
    @endcan
    @can('is-admin')
    <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ \App\Models\User::withoutRole('admin')->count() }}</h3>

                    <p>Users</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="{{ route('admin.users.list') }}" class="small-box-footer">View all <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>$12,000</h3>

                    <p>Total Investments</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>$153,90</h3>

                    <p>Portfolio value</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>$4566,40</h3>

                    <p>Total Return</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>4</h3>

                    <p>Properties</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    @endcan

    @can('is-investor')
        @php
            $kycStatus = auth()->user()->kycDetail->kyc_status ?? 'draft';
            $rejectionReason = auth()->user()->kycDetail->rejection_reason ?? null;
        @endphp

        @if($kycStatus === 'rejected' && $rejectionReason)
            <div class="alert alert-danger">
                <h5><i class="icon fas fa-ban"></i> KYC Rejected!</h5>
                Your KYC application was rejected for the following reason:<br>
                <strong>{{ $rejectionReason }}</strong><br><br>
                <!-- Update this link to point to the actual KYC edit page once created -->
                <a href="{{ route('investor.kyc.index') }}" class="btn btn-sm btn-outline-light">Update KYC Details</a>
            </div>
        @elseif($kycStatus === 'approved')
            <div class="alert alert-success">
                <h5><i class="icon fas fa-check"></i> KYC Approved!</h5>
                Your account is fully verified. You can now start investing.
            </div>
        @elseif($kycStatus === 'pending')
            <div class="alert alert-warning">
                <h5><i class="icon fas fa-exclamation-triangle"></i> KYC Pending Review</h5>
                Your KYC application is currently being reviewed by an admin.
            </div>
        @else
            <div class="alert alert-info">
                <h5><i class="icon fas fa-info"></i> Complete your KYC</h5>
                Please complete your KYC to unlock all features.
            </div>
        @endif

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
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script>
        console.log("Hi, I'm using the Laravel-AdminLTE package!");
    </script>
@stop
