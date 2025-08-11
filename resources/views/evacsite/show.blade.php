@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center align-items-center">
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <h6 class="mb-1">
                        <i class="fas fa-map-marker-alt text-danger"></i> {{ $evacsites->sitename }} 
                        <span class="float-end">
                            @php
                                $statusClass = [
                                    'operational' => 'success',
                                    'under_maintenance' => 'warning',
                                    'closed' => 'danger'
                                ][$evacsites->status] ?? 'secondary';
                            @endphp
                            <span class="badge bg-{{ $statusClass }}">
                                {{ Str::title(str_replace('_', ' ', $evacsites->status)) }}
                            </span>
                        </span>
                    </h6>
                    <small class="text-muted ">{{ $evacsites->address }}</small> |
                    <small class="text-muted ">{{ $evacsites->type }}</small>
                    <hr>
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <small>Head: <strong>{{ $evacsites->head }}</strong></small>
                        </div>
                        <div class="col-md-6">
                            <small>Contact: <strong>{{ $evacsites->contact }}</strong></small>
                        </div>
                    </div>
                    <hr>
                    <div class="container">
                        <div class="row justify-content-between align-items-center text-center">
                            <div class="col-md-3">
                                <small class="text-muted">Capacity</small>
                                <h4><strong>{{ ($evacsites->capacity) }}</strong></h4>
                            </div>
                            <div class="col-md-3">
                                <small class="text-muted">No. of Rooms</small>
                                <h4><strong>{{ ($evacsites->room) }}</strong></h4>
                            </div>
                            <div class="col-md-3">
                                <small class="text-muted">Power Status</small>
                                <h5>
                                    <span class="badge bg-{{ $evacsites->powerstatus === 'available' ? 'success' : 'danger' }}">
                                        <i class="fas fa-bolt me-1"></i>{{ $evacsites->powerstatus }}
                                    </span>
                                </h5>
                            </div> 
                            <div class="col-md-3">
                                <small class="text-muted">Water Status</small>
                                <h5>
                                    <span class="badge bg-{{ $evacsites->waterstatus === 'available' ? 'success' : 'danger' }}">
                                        <i class="fas fa-tint me-1"></i>{{ $evacsites->waterstatus }}
                                    </span>
                                </h5>
                            </div>
                        </div>
                    </div>
                    <hr>
                    @php
                        $capacity = $evacsites->capacity ?? 1; // prevent division by zero
                        $occupants = $evacsites->occupants ?? 0;
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
                    <a href="{{ route('evacsites.show', $evacsites->sitename) }}" class="btn btn-primary btn-sm text-white d-flex text-decoration-none justify-content-center align-items-center">
                        <i class="fas fa-info-circle me-1"></i> Details
                    </a>
                </div>  
            </div>
        </div>
        <div class="col-md-6">
            <div id="evacMap" style="height: 400px; border-radius: 5px;"></div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Get the coordinates from your model
                const lat = {{ $evacsites->lat }};
                const lng = {{ $evacsites->lang }};
                const status = "{{ $evacsites->status }}";
                const sitename = "{{ $evacsites->sitename }}";
                
                // Determine color based on status
                let color;
                switch(status) {
                    case 'operational':
                        color = '#28a745'; // green
                        break;
                    case 'under_maintenance':
                        color = '#ffc107'; // yellow
                        break;
                    case 'closed':
                        color = '#dc3545'; // red
                        break;
                    default:
                        color = '#6c757d'; // gray
                }
                
                // Initialize the map
                const map = L.map('evacMap').setView([lat, lng], 15);
                
                // Add tile layer (OpenStreetMap)
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                }).addTo(map);
                
                // Create the circle with white stroke
                const circle = L.circle([lat, lng], {
                    color: 'white', // stroke color
                    weight: 2,      // stroke width
                    fillColor: color,
                    fillOpacity: 0.7,
                    radius: 100    // 100 meters radius - adjust as needed
                }).addTo(map).bindPopup(`<b>${sitename}</b><br>Status: ${status.replace('_', ' ')}`);
                
                // Add blinking effect
                let isVisible = true;
                setInterval(() => {
                    isVisible = !isVisible;
                    if (isVisible) {
                        circle.setStyle({
                            fillOpacity: 0.7,
                            opacity: 1
                        });
                    } else {
                        circle.setStyle({
                            fillOpacity: 0.2,
                            opacity: 0.5
                        });
                    }
                }, 1000); // Blink every 1 second
            });
        </script>
    </div>
</div>

@endsection