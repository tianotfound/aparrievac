@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <!-- Page Header -->
    <div class="container mb-3">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-gray-800">
                    <i class="fas fa-house-circle-exclamation me-2"></i>Evacuation Sites
                </h5>
                <div class="d-flex ms-auto gap-2">
                    @can('manage evacuation site')
                    <a href="{{ route('manageevac.index') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-cogs me-2"></i> Manage Sites
                    </a>
                    @endcan
                </div>
            </div>
        </div>
    </div>


    <!-- Flash Success -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show mx-3" role="alert">
        <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="container mb-3">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-4 mb-3">
                <div class="card bg-success text-white">
                    <div class="card-body">
                        <h6><i class="fas fa-check-circle"></i> Operational
                            <span class="float-end">{{ $evacsites->where('status', 'operational')->count() }}</span>
                        </h6>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card bg-warning text-black">
                    <div class="card-body">
                        <h6><i class="fas fa-tools"></i> Under Maintenance
                            <span class="float-end">{{ $evacsites->where('status', 'under_maintenance')->count() }}</span>
                        </h6>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card bg-danger text-white">
                    <div class="card-body">
                        <h6><i class="fas fa-ban"></i> Closed
                            <span class="float-end">{{ $evacsites->where('status', 'closed')->count() }}</span>
                        </h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row justify-content-center align-items-center">
            @foreach ($evacsites as $item)
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="mb-1">
                                <i class="fas fa-map-marker-alt text-danger"></i> {{ $item->sitename }} 
                                <span class="float-end">
                                    @php
                                        $statusClass = [
                                            'operational' => 'success',
                                            'under_maintenance' => 'warning',
                                            'closed' => 'danger'
                                        ][$item->status] ?? 'secondary';
                                    @endphp
                                    <span class="badge bg-{{ $statusClass }}">
                                        {{ Str::title(str_replace('_', ' ', $item->status)) }}
                                    </span>
                                </span>
                            </h6>
                            <small class="text-muted ">{{ $item->address }}</small> |
                            <small class="text-muted ">{{ $item->type }}</small>
                            <hr>
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <small>Head: <strong>{{ $item->head }}</strong></small>
                                </div>
                                <div class="col-md-6">
                                    <small>Contact: <strong>{{ $item->contact }}</strong></small>
                                </div>
                            </div>
                            <hr>
                            <div class="container">
                                <div class="row justify-content-between align-items-center text-center">
                                    <div class="col-md-3">
                                        <small class="text-muted">Capacity</small>
                                        <h4><strong>{{ ($item->capacity) }}</strong></h4>
                                    </div>
                                    <div class="col-md-3">
                                        <small class="text-muted">No. of Rooms</small>
                                        <h4><strong>{{ ($item->room) }}</strong></h4>
                                    </div>
                                    <div class="col-md-3">
                                        <small class="text-muted">Power Status</small>
                                        <h5>
                                            <span class="badge bg-{{ $item->powerstatus === 'available' ? 'success' : 'danger' }}">
                                                <i class="fas fa-bolt me-1"></i>{{ $item->powerstatus }}
                                            </span>
                                        </h5>
                                    </div> 
                                    <div class="col-md-3">
                                        <small class="text-muted">Water Status</small>
                                        <h5>
                                            <span class="badge bg-{{ $item->waterstatus === 'available' ? 'success' : 'danger' }}">
                                                <i class="fas fa-tint me-1"></i>{{ $item->waterstatus }}
                                            </span>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="container mt-3">
                                <div class="row text-center">
                                    <div class="col-md-3">
                                        <small class="text-muted">
                                            <i class="fas fa-briefcase-medical text-danger me-1"></i> Medicine
                                        </small>
                                        <h5>
                                            <span class="badge {{ $item->medicine_qty < 10 ? 'bg-danger' : 'bg-primary' }}">
                                                {{ $item->medicine_qty }}
                                            </span>
                                        </h5>
                                    </div>
                                    <div class="col-md-3">
                                        <small class="text-muted">
                                            <i class="fas fa-soap text-primary me-1"></i> Toiletries
                                        </small>
                                        <h5>
                                            <span class="badge {{ $item->toiletries_qty < 10 ? 'bg-danger' : 'bg-primary' }}">
                                                {{ $item->toiletries_qty }}
                                            </span>
                                        </h5>
                                    </div>
                                    <div class="col-md-3">
                                        <small class="text-muted">
                                            <i class="fas fa-box-open text-warning me-1"></i> Relief Goods
                                        </small>
                                        <h5>
                                            <span class="badge {{ $item->relief_goods_qty < 10 ? 'bg-danger' : 'bg-primary' }}">
                                                {{ $item->relief_goods_qty }}
                                            </span>
                                        </h5>
                                    </div>
                                    <div class="col-md-3">
                                        <small class="text-muted">
                                            <i class="fas fa-bed text-success me-1"></i> Beddings
                                        </small>
                                        <h5>
                                            <span class="badge {{ $item->beddings_qty < 10 ? 'bg-danger' : 'bg-primary' }}">
                                                {{ $item->beddings_qty }}
                                            </span>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            @php
                                $capacity = $item->capacity ?? 1; // prevent division by zero
                                $occupants = $item->occupants ?? 0;
                                $occupancy = min(100, round(($occupants / $capacity) * 100)); // capped at 100%
                                
                                $barColor = 'bg-success';
                                if ($occupancy >= 80) $barColor = 'bg-danger';
                                elseif ($occupancy >= 50) $barColor = 'bg-warning';
                            @endphp
                            <div class="text-center">
                                <small class="text-muted d-block mb-1">Occupancy: {{ $occupants }} / {{ $capacity }}</small>
                                
                                <div class="progress" style="height: 15px;">
                                    <div class="progress-bar {{ $barColor }}" role="progressbar"
                                        style="width: {{ $occupancy }}%;" aria-valuenow="{{ $occupancy }}" aria-valuemin="0" aria-valuemax="100">
                                        {{ $occupancy }}%
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container mb-2">
                            <a href="{{ route('evacsites.show', $item->id) }}" class="btn btn-primary btn-sm text-white d-flex text-decoration-none justify-content-center align-items-center">
                                <i class="fas fa-info-circle me-1"></i> Details
                            </a>
                        </div>  
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
