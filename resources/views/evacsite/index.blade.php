@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-3">
            <div class="card shadow-sm mb-3 border-start">
                <div class="card-header bg-light">
                    <h6 class="card-title mb-0 d-flex align-items-center gap-2">
                        <i class="text-danger fa-solid fa-location-dot fs-5"></i>
                        Cagayan State University
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="badge bg-primary bg-opacity-10 text-primary">Evacuation Site</span>
                        <span class="text-success fw-semibold">50 Available</span>
                    </div>
                    
                    <div class="progress mb-3" style="height: 8px;">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 50%;" 
                            aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    
                    <div class="d-flex justify-content-between text-muted small">
                        <span>Capacity: 100</span>
                        <span>50% occupied</span>
                    </div>
                </div>
            </div>
            <div class="card shadow-sm mb-3 border-start">
                <div class="card-header bg-light">
                    <h6 class="card-title mb-0 d-flex align-items-center gap-2">
                        <i class="text-danger fa-solid fa-location-dot fs-5"></i>
                        Aparri East National High School
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <span class="badge bg-primary bg-opacity-10 text-primary">Evacuation Site</span>
                        <span class="text-success fw-semibold">50 Available</span>
                    </div>
                    
                    <div class="progress mb-3" style="height: 8px;">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 50%;" 
                            aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    
                    <div class="d-flex justify-content-between text-muted small">
                        <span>Capacity: 100</span>
                        <span>50% occupied</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection