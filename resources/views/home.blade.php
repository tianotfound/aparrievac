@extends('layouts.app')

@section('content')
{{-- =========================================================================================================================== --}}
@can('superadmin')
    <div class="container">
        <div id="flashAlert" class="alert alert-success text-center" role="alert">
            {{ __('Welcome, Super Admin! You have full access to the system.') }}
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#flashAlert').delay(3000).fadeOut('slow');
        });
    </script>

    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card border-0 rounded-3 h-100">
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-primary bg-opacity-10 p-3 rounded-circle me-3">
                                <i class="fas fa-users-cog fa-lg text-primary"></i>
                            </div>
                            <h5 class="card-title mb-0 fw-bold">{{ __('User Management') }}</h5>
                        </div>
                        
                        <p class="card-text text-muted flex-grow-1">
                            {{ __('Manage users, roles, and permissions with advanced controls.') }}
                        </p>
                        
                        <div class="mt-auto">
                            <a href="{{ route('users.index') }}" class="btn btn-outline-primary">
                                <i class="fas fa-sliders-h me-2"></i>{{ __('Manage Users') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card border-0 rounded-3 h-100">
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-success bg-opacity-10 p-3 rounded-circle me-3">
                                <i class="fas fa-house-tsunami fa-lg text-success"></i>
                            </div>
                            <h5 class="card-title mb-0 fw-bold">{{ __('Evacuation Sites') }}</h5>
                        </div>
                        
                        <p class="card-text text-muted flex-grow-1">
                            {{ __('Monitor and manage all evacuation centers and their capacities.') }}
                        </p>
                        
                        <div class="mt-auto">
                            <a href="{{ route('evacsites.index') }}" class="btn btn-outline-success">
                                <i class="fas fa-map-location-dot me-2"></i>{{ __('View Sites') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card border-0 rounded-3 h-100">
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-info bg-opacity-10 p-3 rounded-circle me-3">
                                <i class="fas fa-people-group fa-lg text-info"></i>
                            </div>
                            <h5 class="card-title mb-0 fw-bold">{{ __('Evacuees Data') }}</h5>
                        </div>
                        
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Total Evacuees:</span>
                                <span class="fw-bold">1,242</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Families:</span>
                                <span class="fw-bold">328</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Last Updated:</span>
                                <span class="fw-bold">2 hours ago</span>
                            </div>
                        </div>
                        
                        <div class="mt-auto d-flex gap-2">
                            <a href="" class="btn btn-outline-info">
                                <i class="fas fa-list me-2"></i>{{ __('View All') }}
                            </a>
                            <a href="" class="btn btn-info">
                                <i class="fas fa-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endcan

<div class="container-fluid">
    <div class="row">
        <div class="col-md-2">
            <ul class="nav flex-column bg-light p-3">
                <li class="nav-item">test 1</li>
                <li class="nav-item">test 1</li>
                <li class="nav-item">test 1</li>
                <li class="nav-item">test 1</li>
                <li class="nav-item">test 1</li>
                <li class="nav-item">test 1</li>
                <li class="nav-item">test 1</li>
            </ul>
        </div>
        <div class="col-md-6">
            <div id="map" style="height: 500px; width: 100%;"></div>
        </div>
        <div class="col-md-4">
            <div class="card"></div>
        </div>
    </div>
</div>

{{-- =========================================================================================================================== --}}
@can('admin')
    <div class="container">
        <div class="alert alert-warning text-center" role="alert">
            {{ __('Welcome, Admin! You have administrative privileges.') }}
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card border-0 rounded-3 h-100">
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-success bg-opacity-10 p-3 rounded-circle me-3">
                                <i class="fas fa-house-tsunami fa-lg text-success"></i>
                            </div>
                            <h5 class="card-title mb-0 fw-bold">{{ __('Evacuation Sites') }}</h5>
                        </div>
                        
                        <p class="card-text text-muted flex-grow-1">
                            {{ __('Monitor and manage all evacuation centers and their capacities.') }}
                        </p>
                        
                        <div class="mt-auto">
                            <a href="" class="btn btn-outline-success">
                                <i class="fas fa-map-location-dot me-2"></i>{{ __('View Sites') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card border-0 rounded-3 h-100">
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-info bg-opacity-10 p-3 rounded-circle me-3">
                                <i class="fas fa-people-group fa-lg text-info"></i>
                            </div>
                            <h5 class="card-title mb-0 fw-bold">{{ __('Evacuees Data') }}</h5>
                        </div>
                        
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Total Evacuees:</span>
                                <span class="fw-bold">1,242</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Families:</span>
                                <span class="fw-bold">328</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Last Updated:</span>
                                <span class="fw-bold">2 hours ago</span>
                            </div>
                        </div>
                        
                        <div class="mt-auto d-flex gap-2">
                            <a href="" class="btn btn-outline-info">
                                <i class="fas fa-list me-2"></i>{{ __('View All') }}
                            </a>
                            <a href="" class="btn btn-info">
                                <i class="fas fa-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endcan
{{-- =========================================================================================================================== --}}
@can('staff')
    <div class="alert alert-success" role="alert">
        {{ __('Welcome, User! You can access your dashboard and manage your profile.') }}
    </div>
@endcan
{{-- =========================================================================================================================== --}}
@can('user')
    <div class="alert alert-secondary" role="alert">
        {{ __('Welcome, Guest! Here are your details.') }}
    </div>
@endcan
{{-- =========================================================================================================================== --}}
@endsection
