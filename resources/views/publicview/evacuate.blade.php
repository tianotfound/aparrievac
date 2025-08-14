@extends('layouts.welcome')

@section('content')

<!-- Emergency Alert Banner -->
    <div class="alert alert-danger alert-dismissible fade show mb-0 text-center" role="alert">
        <strong><i class="fas fa-triangle-exclamation me-2"></i>EMERGENCY ALERT:</strong> Flood warning in effect for the area. Follow evacuation orders immediately.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <!-- Main Header -->
    <header class="emergency-header py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="display-4 fw-bold"><i class="fas fa-house-crack me-3"></i>Emergency Evacuation Sites</h1>
                    <p class="lead">Find safe locations and resources during emergencies</p>
                </div>
                <div class="col-md-4 text-md-end">
                    <button class="btn btn-light btn-lg me-2"><i class="fas fa-phone-alt me-2"></i>911</button>
                    <button class="btn btn-outline-light btn-lg"><i class="fas fa-info-circle me-2"></i>Help</button>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="py-5">
        <div class="container">
            <!-- Search and Filter Section -->
            <div class="row mb-5">
                <div class="col-md-6 mb-3 mb-md-0">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control form-control-lg" placeholder="Search by location or shelter name">
                        <button class="btn btn-danger">Search</button>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="d-flex flex-wrap gap-2">
                        <select class="form-select flex-grow-1">
                            <option selected>Filter by Shelter Type</option>
                            <option>General Population</option>
                            <option>Medical Needs</option>
                            <option>Pet-Friendly</option>
                            <option>ADA Accessible</option>
                        </select>
                        <select class="form-select flex-grow-1">
                            <option selected>Filter by Distance</option>
                            <option>Within 1 mile</option>
                            <option>Within 5 miles</option>
                            <option>Within 10 miles</option>
                            <option>Show all</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- Map Section -->
                <div class="col-lg-8 mb-4 mb-lg-0">
                    <div class="map-container p-3 mb-4">
                        <!-- In a real implementation, this would be a Google Maps or similar embed -->
                        <div class="d-flex align-items-center justify-content-center h-100 bg-light">
                            <div class="text-center">
                                <i class="fas fa-map-marked-alt fa-4x text-muted mb-3"></i>
                                <h3>Interactive Evacuation Map</h3>
                                <p class="text-muted">Shelter locations would appear here</p>
                                <button class="btn btn-danger"><i class="fas fa-location-arrow me-2"></i>Use My Location</button>
                            </div>
                        </div>
                    </div>

                    <!-- Emergency Info Cards -->
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="card info-card h-100">
                                <div class="card-header bg-danger text-white">
                                    <h5 class="mb-0"><i class="fas fa-bullhorn me-2"></i>Evacuation Routes</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item"><i class="fas fa-route text-danger me-2"></i><strong>North Zone:</strong> Highway 101 North</li>
                                        <li class="list-group-item"><i class="fas fa-route text-danger me-2"></i><strong>South Zone:</strong> I-5 South</li>
                                        <li class="list-group-item"><i class="fas fa-route text-danger me-2"></i><strong>East Zone:</strong> Route 66 East</li>
                                        <li class="list-group-item"><i class="fas fa-route text-danger me-2"></i><strong>West Zone:</strong> Coastal Highway</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card info-card h-100">
                                <div class="card-header bg-warning text-dark">
                                    <h5 class="mb-0"><i class="fas fa-kit-medical me-2"></i>Emergency Supplies</h5>
                                </div>
                                <div class="card-body">
                                    <p>Bring these essential items to the shelter:</p>
                                    <div class="row">
                                        <div class="col-6">
                                            <ul>
                                                <li><i class="fas fa-check text-success me-2"></i>Medications</li>
                                                <li><i class="fas fa-check text-success me-2"></i>ID Documents</li>
                                                <li><i class="fas fa-check text-success me-2"></i>Flashlight</li>
                                            </ul>
                                        </div>
                                        <div class="col-6">
                                            <ul>
                                                <li><i class="fas fa-check text-success me-2"></i>Bottled Water</li>
                                                <li><i class="fas fa-check text-success me-2"></i>Non-perishable Food</li>
                                                <li><i class="fas fa-check text-success me-2"></i>Blankets</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="alert alert-info mt-3">
                                        <i class="fas fa-paw me-2"></i>Pet owners: Bring leash, carrier, and pet food
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Shelter List Section -->
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0"><i class="fas fa-list me-2"></i>Nearby Shelters</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="list-group list-group-flush">
                                <!-- Shelter Item 1 -->
                                <a href="#" class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1">Central High School</h6>
                                        <small class="text-success">2.1 mi</small>
                                    </div>
                                    <p class="mb-1 small">123 Education Blvd, Your City</p>
                                    <div class="shelter-features">
                                        <small class="text-muted"><i class="fas fa-wheelchair"></i> ADA Accessible</small>
                                        <small class="text-muted ms-2"><i class="fas fa-briefcase-medical"></i> Medical</small>
                                        <small class="text-muted ms-2"><i class="fas fa-dog"></i> Pets</small>
                                    </div>
                                    <div class="mt-2">
                                        <span class="badge bg-success">Open</span>
                                        <small class="text-muted ms-2"><i class="fas fa-user-friends"></i> Capacity: 320/500</small>
                                    </div>
                                </a>
                                
                                <!-- Shelter Item 2 -->
                                <a href="#" class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1">Community Center</h6>
                                        <small class="text-success">1.5 mi</small>
                                    </div>
                                    <p class="mb-1 small">456 Main Street, Your City</p>
                                    <div class="shelter-features">
                                        <small class="text-muted"><i class="fas fa-wheelchair"></i> ADA Accessible</small>
                                        <small class="text-muted ms-2"><i class="fas fa-utensils"></i> Meals Provided</small>
                                    </div>
                                    <div class="mt-2">
                                        <span class="badge bg-success">Open</span>
                                        <small class="text-muted ms-2"><i class="fas fa-user-friends"></i> Capacity: 150/200</small>
                                    </div>
                                </a>
                                
                                <!-- Shelter Item 3 -->
                                <a href="#" class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1">First Methodist Church</h6>
                                        <small class="text-success">3.2 mi</small>
                                    </div>
                                    <p class="mb-1 small">789 Faith Avenue, Your City</p>
                                    <div class="shelter-features">
                                        <small class="text-muted"><i class="fas fa-child"></i> Family Area</small>
                                        <small class="text-muted ms-2"><i class="fas fa-wifi"></i> WiFi Available</small>
                                    </div>
                                    <div class="mt-2">
                                        <span class="badge bg-warning text-dark">Limited Space</span>
                                        <small class="text-muted ms-2"><i class="fas fa-user-friends"></i> Capacity: 95/100</small>
                                    </div>
                                </a>
                                
                                <!-- Shelter Item 4 -->
                                <a href="#" class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1">Red Cross Shelter</h6>
                                        <small class="text-success">4.0 mi</small>
                                    </div>
                                    <p class="mb-1 small">101 Aid Lane, Your City</p>
                                    <div class="shelter-features">
                                        <small class="text-muted"><i class="fas fa-wheelchair"></i> ADA Accessible</small>
                                        <small class="text-muted ms-2"><i class="fas fa-briefcase-medical"></i> Medical</small>
                                        <small class="text-muted ms-2"><i class="fas fa-dog"></i> Pets</small>
                                        <small class="text-muted ms-2"><i class="fas fa-utensils"></i> Meals</small>
                                    </div>
                                    <div class="mt-2">
                                        <span class="badge bg-success">Open</span>
                                        <small class="text-muted ms-2"><i class="fas fa-user-friends"></i> Capacity: 420/600</small>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Emergency Contacts -->
                    <div class="card emergency-contacts mb-4">
                        <div class="card-body">
                            <h5><i class="fas fa-phone-emergency me-2"></i>Emergency Contacts</h5>
                            <ul class="list-unstyled">
                                <li class="mb-2"><strong><i class="fas fa-ambulance me-2 text-danger"></i>Medical Emergency:</strong> 911</li>
                                <li class="mb-2"><strong><i class="fas fa-fire-extinguisher me-2 text-danger"></i>Fire Department:</strong> 911</li>
                                <li class="mb-2"><strong><i class="fas fa-shield-alt me-2 text-primary"></i>Police Non-Emergency:</strong> (555) 123-4567</li>
                                <li class="mb-2"><strong><i class="fas fa-road me-2 text-warning"></i>Road Conditions:</strong> 511</li>
                                <li class="mb-2"><strong><i class="fas fa-bolt me-2 text-danger"></i>Power Outage:</strong> (555) 987-6543</li>
                                <li><strong><i class="fas fa-house-flood-water me-2 text-info"></i>Flood Hotline:</strong> (555) 456-7890</li>
                            </ul>
                        </div>
                    </div>

                    <!-- Weather Alert -->
                    <div class="card border-danger mb-4">
                        <div class="card-header bg-danger text-white">
                            <h5 class="mb-0"><i class="fas fa-cloud-showers-heavy me-2"></i>Weather Alert</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-cloud-rain fa-3x me-3 text-primary"></i>
                                <div>
                                    <h6 class="mb-0">Flash Flood Warning</h6>
                                    <small>Until 10:00 PM tonight</small>
                                </div>
                            </div>
                            <p>Heavy rainfall may cause dangerous flooding. Move to higher ground immediately if advised.</p>
                            <button class="btn btn-sm btn-outline-danger w-100"><i class="fas fa-bell me-2"></i>Get Alerts</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

@endsection