@extends('layouts.app')

@section('content')

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <table id="myTable" class="table table-sm table-striped">
                <thead>
                    <tr>
                        <th>Site Name</th>
                        <th>Address</th>
                        <th>Type</th>
                        <th>Status</th>
                        <th>Capacity</th>
                        <th>No. of Rooms</th>
                        <th>Facility Status</th>
                        <th>Actions</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($evacsites as $site)
                    <tr>
                        <td>
                            <b>{{ $site->sitename }}</b> <br>
                            <span class="badge bg-secondary mb-1 mt-1">Head: {{ $site->head }}</span> <br>
                            <span class="badge bg-secondary">Contact No: {{ $site->contact }}</span>
                        </td>
                        <td>{{ $site->address }}</td>
                        <td>{{ $site->type }}</td>
                        <td class="text-capitalize">{{ $site->status }}</td>
                        <td class="text-center" style="font-weight: 500; font-size: 25px;">{{ $site->capacity }}</td>
                        <td class="text-center" style="font-weight: 500; font-size: 25px;">{{ $site->room }}</td>
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
                            <a href="{{ route('evacsites.edit', $site->id) }}" class="btn btn-success btn-sm text-white mr-2">
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