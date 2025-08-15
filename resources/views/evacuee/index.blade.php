@extends('layouts.app')

@section('content')

<div class="container mb-3">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0 text-gray-800">
                <i class="fas fa-users me-2"></i>Evacuees Management
            </h5>
            <div class="d-flex ms-auto gap-2">
                <a href="{{ route('evacuee.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus me-1"></i> Add Evacuee
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <div class="row">
                <div class="col-md-6">
                    <h5 class="mb-0">Evacuees List</h5>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="myTable" class="table table-hover table-striped">
                    <thead class="table-light">
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Age/Gender</th>
                            <th>Contact</th>
                            <th>Evacuation Site</th>
                            <th>Family Members</th>
                            <th>Barangay</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($evacuees as $evacuee)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                {{ $evacuee->last_name }}, {{ $evacuee->first_name }}
                                @if($evacuee->middle_name)
                                    {{ substr($evacuee->middle_name, 0, 1) }}.
                                @endif
                            </td>
                            <td>
                                <span class="badge bg-primary">{{ $evacuee->age }}</span>
                                <span class="badge bg-secondary">{{ $evacuee->gender }}</span>
                            </td>
                            <td>{{ $evacuee->contact_number }}</td>
                            <td>{{ $evacuee->evacsites->sitename ?? 'N/A' }}</td>
                            <td class="text-center">
                                <span class="badge bg-info text-dark">{{ $evacuee->family_count }}</span>
                            </td>
                            <td>{{ $evacuee->barangay }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('evacuee.show', $evacuee->id) }}" class="btn btn-sm btn-outline-info" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('evacuee.edit', $evacuee->id) }}" class="btn btn-sm btn-outline-primary" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('evacuee.destroy', $evacuee->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this evacuee?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-4">No evacuees found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.2.1/js/dataTables.bootstrap5.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.bootstrap5.css">
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
</script>

@endsection