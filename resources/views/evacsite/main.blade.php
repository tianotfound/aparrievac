@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-body">
            <table id="myTable" class="table table-sm table-striped">
                <thead>
                    <tr>
                        <th>Site Name</th>
                        <th>Status</th>
                        <th>Capacity</th>
                        <th>Facility Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($evacsites as $site)
                    <tr>
                        <td class="align-middle">
                            <div class="fw-bold text-dark mb-1">{{ $site->sitename }}</div>
                            <span class="badge bg-primary text-uppercase small px-2 py-1">{{ $site->type }}</span>
                            
                            <div class="mt-2 text-muted small">
                                <i class="fas fa-map-marker-alt me-1"></i>{{ $site->address }}
                            </div>
                            
                            <hr class="my-2">
                            
                            <div class="small">
                                <i class="fas fa-user-tie me-1 text-secondary"></i><span class="fw-semibold">Head:</span> {{ $site->head }}
                            </div>
                            <div class="small">
                                <i class="fas fa-phone-alt me-1 text-secondary"></i><span class="fw-semibold">Contact:</span> {{ $site->contact }}
                            </div>
                        </td>
                        <<td>
                            @php
                                $statusClasses = [
                                    'operational' => 'success',
                                    'under_maintenance' => 'warning',
                                    'closed' => 'danger',
                                ];
                            @endphp

                            <span class="badge bg-{{ $statusClasses[strtolower($site->status)] ?? 'secondary' }} text-capitalize px-3 py-2">
                                {{ str_replace('_', ' ', $site->status) }}
                            </span>
                        </td>
                        <td class="align-middle">
                            <div class="fw-bold text-primary" style="font-size: 1.4rem;">
                                {{ $site->capacity }}
                            </div>
                            <small class="text-muted d-block">Capacity</small>

                            <div class="fw-bold text-success mt-2" style="font-size: 1.2rem;">
                                {{ $site->room }}
                            </div>
                            <small class="text-muted d-block">Rooms</small>
                        </td>
                        <td class="text-capitalize">
                            <span class="badge 
                                @if($site->waterstatus == 'available') bg-warning
                                @elseif($site->waterstatus == 'unavailable') bg-danger
                                @else bg-warning
                                @endif mb-1 mt-1">
                                <i class="fas fa-tint me-1"></i> {{ $site->waterstatus }}
                            </span><br>
                            <span class="badge 
                                @if($site->powerstatus == 'available') bg-warning
                                @elseif($site->powerstatus == 'unavailable') bg-danger
                                @else bg-warning
                                @endif mb-1 mt-1">
                                <i class="fas fa-bolt me-1"></i> {{ $site->powerstatus }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('evacsites.show', $site->id) }}" class="btn btn-primary btn-sm text-white mr-2 text-decoration-none">
                                <i class="fas fa-eye"></i> View
                            </a>
                            <a href="{{ route('manageevac.edit', $site->id) }}" class="btn btn-success btn-sm text-white mr-2">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('evacsites.destroy', $site->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm text-white" onclick="return confirm('Are you sure you want to delete this site?')">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.2.1/js/dataTables.bootstrap5.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.bootstrap5.css">
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>