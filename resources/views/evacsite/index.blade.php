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
                @can('add evacuation site')
                <a href="{{ route('evacsites.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus me-2"></i>Add New Site
                </a>
                @endcan
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

    <!-- Summary Panels -->
    <div class="row px-3">
        <div class="col-md-4 mb-3">
            <div class="card bg-success text-white">
                <div class="card-body text-center">
                    <i class="fas fa-check-circle fa-2x mb-2"></i>
                    <h6>Operational</h6>
                    <h4>{{ $evacsites->where('status', 'operational')->count() }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card bg-warning text-dark">
                <div class="card-body text-center">
                    <i class="fas fa-tools fa-2x mb-2"></i>
                    <h6>Maintenance</h6>
                    <h4>{{ $evacsites->where('status', 'under_maintenance')->count() }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card bg-danger text-white">
                <div class="card-body text-center">
                    <i class="fas fa-ban fa-2x mb-2"></i>
                    <h6>Closed</h6>
                    <h4>{{ $evacsites->where('status', 'closed')->count() }}</h4>
                </div>
            </div>
        </div>
    </div>

    <!-- Panels: Weather, Needs, Occupancy -->
    <div class="row px-3">
        <div class="col-md-4 mb-3">
            <div class="card text-bg-danger h-100">
                <div class="card-body">
                    <h6 class="card-title"><i class="fas fa-cloud-bolt me-2"></i>Weather Alert</h6>
                    <p class="mb-0">⚠️ Tropical storm warning in Aparri, Cagayan. Monitor updates from PAGASA.</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card text-bg-warning h-100">
                <div class="card-body">
                    <h6 class="card-title"><i class="fas fa-triangle-exclamation me-2"></i>Urgent Needs</h6>
                    <ul class="list-unstyled">
                        @foreach($evacsites as $site)
                            @if($site->needs)
                            <li class="mb-2">
                                <strong>{{ $site->sitename }}:</strong> {{ $site->needs }}
                            </li>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card text-bg-info h-100">
                <div class="card-body">
                    <h6 class="card-title"><i class="fas fa-users me-2"></i>Occupancy</h6>
                    @foreach($evacsites as $site)
                        @if($site->capacity > 0)
                        <div class="mb-2">
                            <small><strong>{{ $site->sitename }}</strong></small>
                            <div class="progress" style="height: 20px;">
                                <div class="progress-bar bg-{{ ($site->occupants / $site->capacity) > 0.8 ? 'danger' : 'success' }}"
                                     style="width: {{ ($site->occupants / $site->capacity) * 100 }}%;">
                                    {{ $site->occupants ?? 0 }} / {{ $site->capacity }}
                                </div>
                            </div>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Main Tables -->
    <div class="row px-3">
        <div class="col-md-5 mb-3">
            <table id="myTable" class="table table-bordered table-sm">
                <thead class="table-light">
                    <tr>
                        <th>Evacuation Sites</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($evacsites as $site)
                    <tr>
                        <td>{{ $site->sitename }}</td>
                        <td>
                            <div class="gap-1">
                                <a href="{{ route('evacsites.show', $site->id) }}" class="btn btn-sm btn-info" title="View">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('evacsites.edit', $site->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('evacsites.destroy', $site->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure?')">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="col-md-7">
            <div class="table-responsive">
                <table class="table table-hover table-sm">
                    <thead class="table-light">
                        <tr>
                            <th>Site Name</th>
                            <th>Type</th>
                            <th>Capacity</th>
                            <th>Location</th>
                            <th>Utilities</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($evacsites as $site)
                        <tr>
                            <td>
                                <strong>{{ $site->sitename }}</strong><br>
                                <small class="text-muted">Head: {{ $site->head }}</small><br>
                                <small class="text-muted">Contact: {{ $site->contact }}</small><br>
                                @php
                                    $statusClass = [
                                        'operational' => 'success',
                                        'under_maintenance' => 'warning',
                                        'closed' => 'danger'
                                    ][$site->status] ?? 'secondary';
                                @endphp
                                <span class="badge bg-{{ $statusClass }}">
                                    {{ Str::title(str_replace('_', ' ', $site->status)) }}
                                </span>
                            </td>
                            <td>{{ $site->type }}
                                @if($site->room)
                                <br><small>No. of Rooms: {{ $site->room }}</small>
                                @endif
                            </td>
                            <td>{{ number_format($site->capacity) }}</td>
                            <td>
                                <i class="fas fa-map-marker-alt text-danger me-1"></i>
                                <small>{{ Str::limit($site->address, 40) }}</small>
                            </td>
                            <td>
                                <span class="badge bg-{{ $site->powerstatus === 'available' ? 'success' : 'danger' }}">
                                    <i class="fas fa-bolt me-1"></i>{{ $site->powerstatus }}
                                </span><br>
                                <span class="badge bg-{{ $site->waterstatus === 'available' ? 'success' : 'danger' }}">
                                    <i class="fas fa-tint me-1"></i>{{ $site->waterstatus }}
                                </span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Location Modal -->
<div class="modal fade" id="locationModal" tabindex="-1" aria-labelledby="locationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Site Location</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div id="map" style="height: 400px; width: 100%;"></div>
            </div>
        </div>
    </div>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.2.1/js/dataTables.bootstrap5.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.bootstrap5.css" />

<script>
    $(document).ready(function () {
        $('#myTable').DataTable();
    });
</script>
