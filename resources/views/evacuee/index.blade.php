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
                <button onclick="openSignatoriesModal()" class="btn btn-secondary btn-sm">
                    <i class="fas fa-print me-1"></i> Print
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal for signatories -->
<div class="modal fade" id="signatoriesModal" tabindex="-1" aria-labelledby="signatoriesLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="signatoriesLabel"><i class="fas fa-user-pen me-2"></i> Signatories</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
          <label for="preparedBy" class="form-label">Prepared By</label>
          <input type="text" id="preparedBy" class="form-control" placeholder="Enter name">
        </div>
        <div class="mb-3">
          <label for="notedBy" class="form-label">Noted By</label>
          <input type="text" id="notedBy" class="form-control" placeholder="Enter name">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="printTable()" data-bs-dismiss="modal">
          <i class="fas fa-print me-1"></i> Print
        </button>
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
                <table id="myTable" class="table table-hover table-striped table-sm">
                    <thead class="table-light">
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>Contact</th>
                            <th>Evacuation Site</th>
                            <th>Family Members</th>
                            <th>Barangay</th>
                            <th class="no-print">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($evacuees as $evacuee)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $evacuee->last_name }}, {{ $evacuee->first_name }}
                                @if($evacuee->middle_name)
                                    {{ substr($evacuee->middle_name, 0, 1) }}.
                                @endif
                            </td>
                            <td>{{ $evacuee->age }}</td>
                            <td>{{ $evacuee->gender }}</td>
                            <td>{{ $evacuee->contact_number }}</td>
                            <td>{{ $evacuee->evacsites->sitename ?? 'N/A' }}</td>
                            <td>{{ $evacuee->family_count }}</td>
                            <td>{{ $evacuee->barangay }}</td>
                            <td class="no-print">
                                <div class="d-flex gap-2">
                                    <a href="{{ route('evacuee.show', $evacuee->id) }}" class="btn btn-sm btn-primary" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('evacuee.edit', $evacuee->id) }}" class="btn btn-sm btn-success" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('evacuee.destroy', $evacuee->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this evacuee?')">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center text-muted py-4">No evacuees found</td>
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

    function openSignatoriesModal() {
        let modal = new bootstrap.Modal(document.getElementById('signatoriesModal'));
        modal.show();
    }

    function printTable() {
        let preparedBy = document.getElementById("preparedBy").value || "__________________";
        let notedBy = document.getElementById("notedBy").value || "__________________";

        // Group evacuees by evacuation site (Laravel collection grouped already)
        let grouped = @json($evacuees->groupBy(fn($e) => $e->evacsites->sitename ?? 'N/A'));

        let logoPath = "{{ url('logo/aparri.png') }}"; // absolute path for printing
        let header = `
            <div style="text-align:center; margin-bottom:20px;">
                <img src="${logoPath}" alt="Logo" style="height:60px; display:block; margin:0 auto;">
                <h3 style="margin:0;">{{ config('app.name') }}</h3>
                <p style="margin:0;">Evacuees Report</p>
                <p style="margin:0;">Generated on: ${new Date().toLocaleDateString()}</p>
                <hr>
            </div>
        `;

        let content = "";

        Object.keys(grouped).forEach(site => {
            let evacuees = grouped[site];
            content += `
                <h4 style="margin-top:30px;">Evacuation Site: ${site}</h4>
                <table style="width:100%; border-collapse:collapse; table-layout:auto; font-size:12px; margin-bottom:30px;">
                    <thead>
                        <tr>
                            <th style="border:1px solid #000; padding:5px;">No.</th>
                            <th style="border:1px solid #000; padding:5px;">Name</th>
                            <th style="border:1px solid #000; padding:5px;">Age</th>
                            <th style="border:1px solid #000; padding:5px;">Gender</th>
                            <th style="border:1px solid #000; padding:5px;">Contact</th>
                            <th style="border:1px solid #000; padding:5px;">Family Members</th>
                            <th style="border:1px solid #000; padding:5px;">Barangay</th>
                        </tr>
                    </thead>
                    <tbody>
            `;
            evacuees.forEach((evacuee, index) => {
                content += `
                    <tr>
                        <td style="border:1px solid #000; padding:5px;">${index + 1}</td>
                        <td style="border:1px solid #000; padding:5px;">${evacuee.last_name}, ${evacuee.first_name} ${evacuee.middle_name ? evacuee.middle_name.charAt(0)+'.' : ''}</td>
                        <td style="border:1px solid #000; padding:5px;">${evacuee.age}</td>
                        <td style="border:1px solid #000; padding:5px;">${evacuee.gender}</td>
                        <td style="border:1px solid #000; padding:5px;">${evacuee.contact_number ?? ''}</td>
                        <td style="border:1px solid #000; padding:5px; text-align:center;">${evacuee.family_count}</td>
                        <td style="border:1px solid #000; padding:5px;">${evacuee.barangay ?? ''}</td>
                    </tr>
                `;
            });
            content += `</tbody></table>`;
        });

        let signatories = `
            <br><br><br>
            <table style="width:100%; border:none; margin-top:50px; font-size:12px;">
                <tr>
                    <td style="text-align:center; border:none;">
                        Prepared by:<br><br>
                        ______________________________<br>
                        ${preparedBy}
                    </td>
                    <td style="text-align:center; border:none;">
                        Noted by:<br><br>
                        ______________________________<br>
                        ${notedBy}
                    </td>
                </tr>
            </table>
        `;

        let printWindow = window.open("", "_blank");
        printWindow.document.write(`
            <html>
            <head>
                <title>Print Evacuees</title>
                <style>
                    body { font-family: Arial, sans-serif; font-size: 12px; margin: 10mm; }
                    table { width: 100%; border-collapse: collapse; table-layout: auto; font-size: 12px; }
                    th, td { border: 1px solid #000; padding: 5px; text-align: left; font-size: 12px; }
                    th { background: #f8f8f8; }
                    thead { display: table-header-group; }
                    tr { page-break-inside: avoid; }
                </style>
            </head>
            <body>
                ${header}
                ${content}
                ${signatories}
            </body>
            </html>
        `);
        printWindow.document.close();

        printWindow.onload = function () {
            printWindow.focus();
            printWindow.print();
        };
    }
</script>

@endsection
