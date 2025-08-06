@php use App\Models\Evacsite; @endphp

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
        <div class="row justify-content-center align-item center">
            <div class="col-md-9 mb-3">
                <div class="map">
                    <div id="map" style="height: 650px; width: 100%;"></div>
                </div>
            </div>
            
            <div class="col-md-3 mb-4">
                <div class="container mb-3">
                    <div class="row text-center">
                        <div class="col-md-6">
                            <span id="current-date"></span>
                        </div>
                        <div class="col-md-6">
                            <span id="current-time"></span>
                        </div>
                    </div>
                </div>
                <script>
                    // Function to update date and time
                    function updateDateTime() {
                        const now = new Date();
                        
                        // Format date (e.g., "July 23, 2023")
                        const options = { year: 'numeric', month: 'long', day: 'numeric' };
                        document.getElementById('current-date').textContent = now.toLocaleDateString(undefined, options);
                        
                        // Format time (e.g., "11:45:23 AM")
                        document.getElementById('current-time').textContent = now.toLocaleTimeString();
                    }

                    // Update immediately and then every second
                    updateDateTime();
                    setInterval(updateDateTime, 1000);
                </script>
                <div class="card shadow-sm border-0 h-auto">
                    <div class="card-body">
                        <h5 class="card-title text-primary fw-bold d-flex align-items-center mb-3">
                            <i class="fas fa-tachometer-alt me-2"></i> {{ __('Overview') }}
                        </h5>
                        <hr class="my-2">
                        <ul class="list-unstyled">
                            <li class="d-flex justify-content-between align-items-start py-2">
                                <div class="d-flex flex-column">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                        {{ __('Evacuation Sites') }}
                                    </div>
                                    @php
                                        $operationalCount = Evacsite::where('status', 'operational')->count();
                                        $notOperationalCount = Evacsite::where('status', 'closed')->count();
                                        $underMaintenanceCount = Evacsite::where('status', 'under_maintenance')->count();
                                    @endphp
                                    <small class="ms-4 text-muted">
                                        <i class="fas fa-circle text-success me-1"></i> Operational: {{ $operationalCount }} <br>
                                        <i class="fas fa-circle text-danger me-1"></i> Not Operational: {{ $notOperationalCount }} <br>
                                        <i class="fas fa-circle text-warning me-1"></i> Under Maintenance: {{ $underMaintenanceCount }}
                                    </small>
                                </div>
                                <span class="badge bg-primary rounded-pill mt-1">
                                    {{ \App\Models\Evacsite::count() }}
                                </span>
                            </li>
                            <hr class="my-1">
                            <li class="d-flex justify-content-between align-items-center py-2">
                                <div class="d-flex align-items-center">
                                    <i class="fas fa-users text-info me-2"></i>
                                    {{ __('Evacuees') }}
                                </div>
                                <span class="badge bg-success rounded-pill">
                                    {{ \App\Models\Evacsite::count() }} {{-- Replace with correct model --}}
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <div class="container">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">Evacuees Summary</h5>
                </div>
                <div class="card-body">
                    @if($evacsites->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-sm">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Age</th>
                                        <th>Gender</th>
                                        <th>Evacuation Site</th>
                                        <th>Date Registered</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($evacsites as $index => $evacuee)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $evacuee->name }}</td>
                                            <td>{{ $evacuee->age }}</td>
                                            <td>{{ $evacuee->gender }}</td>
                                            <td>{{ $evacuee->evacuation_site }}</td>
                                            <td>{{ \Carbon\Carbon::parse($evacuee->created_at)->format('M d, Y') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center text-muted">
                            No evacuees data available.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endcan

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
