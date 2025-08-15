@extends('layouts.welcome')

@section('content')

<!-- Emergency Alert Banner -->
<div class="alert alert-danger alert-dismissible fade show mb-0 text-center" role="alert">
    <strong><i class="fa-solid fa-triangle-exclamation me-2"></i>EMERGENCY ALERT:</strong> Flood warning in effect for the area. Follow evacuation orders immediately.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

<!-- Main Header -->
<header class="py-5 bg-primary text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="display-5 fw-bold"><i class="fa-solid fa-house-crack me-3"></i>Emergency Evacuation Sites</h1>
                <p class="lead">Find safe locations and resources during emergencies</p>
            </div>
            <div class="col-md-4 text-md-end">
                <a href="tel:911" class="btn btn-light btn-lg me-2"><i class="fa-solid fa-phone me-2"></i>911</a>
                <a href="#" class="btn btn-outline-light btn-lg"><i class="fa-solid fa-circle-info me-2"></i>Help</a>
            </div>
        </div>
    </div>
</header>

<!-- Main Content -->
<main class="py-5">
    <div class="container">
        
        <!-- Search and Filter Section -->
        <div class="row mb-4">
            <div class="col-md-6 mb-3 mb-md-0">
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-magnifying-glass"></i></span>
                    <input type="text" class="form-control form-control-lg" placeholder="Search by location or shelter name">
                    <button class="btn btn-danger">Search</button>
                </div>
            </div>
            <div class="col-md-6 d-flex flex-wrap gap-2">
                <select class="form-select flex-grow-1">
                    <option selected>Filter by Shelter Type</option>
                    <option>School</option>
                    <option>Gymnasium</option>
                    <option>Community Center</option>
                    <option>Other</option>
                </select>
                <select class="form-select flex-grow-1">
                    <option selected>Filter by Status</option>
                    <option>Operational</option>
                    <option>Under Maintenance</option>
                    <option>Closed</option>
                </select>
            </div>
        </div>

        <div class="row">
            <!-- Shelter List Section -->
            <div class="col-lg-8 mb-4">
                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="fa-solid fa-list me-2"></i>Nearby Shelters</h5>
                    </div>
                    <div class="list-group list-group-flush">
                        @foreach($evacsites as $site)
                            @php
                                $statusClass = [
                                    'operational' => 'success',
                                    'under_maintenance' => 'warning',
                                    'closed' => 'danger'
                                ][$site->status] ?? 'secondary';

                                $occupants = $site->occupants ?? 0;
                                $capacity = $site->capacity ?? 1;
                            @endphp
                            <a href="{{ route('evacsites.show', $site->id) }}" class="list-group-item list-group-item-action py-3">
                                <div class="d-flex justify-content-between">
                                    <h6 class="mb-1 fw-bold"><i class="fa-solid fa-location-dot me-2 text-danger"></i>{{ $site->sitename }}</h6>
                                    <span class="badge bg-{{ $statusClass }}">{{ ucfirst(str_replace('_',' ',$site->status)) }}</span>
                                </div>
                                <p class="mb-1 text-muted small"><i class="fa-solid fa-map me-1"></i>{{ $site->address }}</p>
                                <div class="d-flex align-items-center justify-content-between">
                                    <small class="text-muted"><i class="fa-solid fa-users me-1"></i>Capacity: {{ $occupants }}/{{ $capacity }}</small>
                                    <small class="text-muted"><i class="fa-solid fa-building me-1"></i>{{ ucfirst(str_replace('_',' ',$site->type)) }}</small>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Emergency Contacts -->
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h5><i class="fa-solid fa-phone-volume me-2"></i>Emergency Contacts</h5>
                        <ul class="list-unstyled small mb-0">
                            <li><strong><i class="fa-solid fa-ambulance text-danger me-2"></i>Medical:</strong> 911</li>
                            <li><strong><i class="fa-solid fa-fire-extinguisher text-danger me-2"></i>Fire:</strong> 911</li>
                            <li><strong><i class="fa-solid fa-shield-halved text-primary me-2"></i>Police:</strong> (555) 123-4567</li>
                            <li><strong><i class="fa-solid fa-road text-warning me-2"></i>Roads:</strong> 511</li>
                            <li><strong><i class="fa-solid fa-bolt text-danger me-2"></i>Power:</strong> (555) 987-6543</li>
                            <li><strong><i class="fa-solid fa-house-flood-water text-info me-2"></i>Flood:</strong> (555) 456-7890</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
