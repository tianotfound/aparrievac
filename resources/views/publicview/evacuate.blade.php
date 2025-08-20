@extends('layouts.welcome')

@section('content')
<div class="container my-4">
    <h4 class="mb-4">
        <i class="fa-solid fa-people-roof me-2 text-primary"></i>
        Evacuation Sites
    </h4>

    <div class="row g-4">
        <!-- Left Column: Cards (col-md-8) -->
        <div class="col-md-8">
            <!-- 🔍 Search Bar -->
            <form action="{{ route('public.evacsites') }}" method="GET" class="mb-4">
                <div class="input-group">
                    <input type="text" name="search" class="form-control" 
                        placeholder="Search by site name, address, or head..."
                        value="{{ request('search') }}">
                    <button type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-search me-1"></i> Search
                    </button>
                </div>
            </form>

            <div class="row g-3 justify-content-center align-items-center">
                @forelse($evacsites as $item)
                    <div class="col-md-12">
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
                                                    <small><i class="fas fa-bolt me-1"></i>{{ $item->powerstatus }}</small>
                                                </span>
                                            </h5>
                                        </div> 
                                        <div class="col-md-3">
                                            <small class="text-muted">Water Status</small>
                                            <h5>
                                                <span class="badge bg-{{ $item->waterstatus === 'available' ? 'success' : 'danger' }}">
                                                    <small><i class="fas fa-tint me-1"></i>{{ $item->waterstatus }}</small>
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
                                                <span class="badge 
                                                    {{ $item->medicine_qty < 10 ? 'bg-danger' : ($item->medicine_qty <= 15 ? 'bg-warning' : 'bg-primary') }}">
                                                    {{ $item->medicine_qty }}
                                                </span>
                                            </h5>
                                        </div>

                                        <div class="col-md-3">
                                            <small class="text-muted">
                                                <i class="fas fa-soap text-primary me-1"></i> Toiletries
                                            </small>
                                            <h5>
                                                <span class="badge 
                                                    {{ $item->toiletries_qty < 10 ? 'bg-danger' : ($item->toiletries_qty <= 15 ? 'bg-warning' : 'bg-primary') }}">
                                                    {{ $item->toiletries_qty }}
                                                </span>
                                            </h5>
                                        </div>

                                        <div class="col-md-3">
                                            <small class="text-muted">
                                                <i class="fas fa-box-open text-warning me-1"></i> Relief Goods
                                            </small>
                                            <h5>
                                                <span class="badge 
                                                    {{ $item->relief_goods_qty < 10 ? 'bg-danger' : ($item->relief_goods_qty <= 15 ? 'bg-warning' : 'bg-primary') }}">
                                                    {{ $item->relief_goods_qty }}
                                                </span>
                                            </h5>
                                        </div>

                                        <div class="col-md-3">
                                            <small class="text-muted">
                                                <i class="fas fa-bed text-success me-1"></i> Beddings
                                            </small>
                                            <h5>
                                                <span class="badge 
                                                    {{ $item->beddings_qty < 10 ? 'bg-danger' : ($item->beddings_qty <= 15 ? 'bg-warning' : 'bg-primary') }}">
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
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-warning text-center">
                            <i class="fa-solid fa-triangle-exclamation me-2"></i>
                            No evacuation sites found.
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Right Column: Office Heads Directory (col-md-4) -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <i class="fa-solid fa-users me-2"></i> Office Heads Directory
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover mb-0 align-middle table-sm">
                            <thead class="table-light">
                                <tr>
                                    <th><i class="fa-solid fa-building me-1 text-primary"></i> Site</th>
                                    <th><i class="fa-solid fa-user-tie me-1 text-dark"></i> Head</th>
                                    <th><i class="fa-solid fa-phone me-1 text-success"></i> Contact</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($evacsites as $site)
                                    <tr>
                                        <td>{{ $site->sitename }}</td>
                                        <td>{{ $site->head }}</td>
                                        <td>
                                            <a href="tel:{{ $site->contact }}" class="text-decoration-none text-success">
                                                {{ $site->contact }}
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center text-muted">
                                            <i class="fa-solid fa-triangle-exclamation me-2 text-warning"></i>
                                            No office heads available.
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
</div>
@endsection
