@extends('layouts.app')

@section('content')
<div class="container py-4">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-4">
        <div>
            <h3 class="mb-1 fw-bold">
                <i class="fa-solid fa-location-dot text-danger me-2"></i>{{ $evacsites->sitename }}
            </h3>
            <div class="text-muted small">
                <i class="fa-solid fa-map me-1"></i>{{ $evacsites->address }} |
                <i class="fa-solid fa-building me-1"></i>{{ Str::title(str_replace('_', ' ', $evacsites->type)) }}
            </div>
        </div>
        @php
            $statusClass = [
                'operational' => 'success',
                'under_maintenance' => 'warning',
                'closed' => 'danger'
            ][$evacsites->status] ?? 'secondary';
        @endphp
        <span class="badge bg-{{ $statusClass }} px-3 py-2 fs-6">
            {{ Str::title(str_replace('_', ' ', $evacsites->status)) }}
        </span>
    </div>

    <div class="row g-4">
        {{-- LEFT COLUMN --}}
        <div class="col-lg-6">

            {{-- Site Management --}}
            <section>
                <h6 class="text-primary fw-bold mb-3">
                    <i class="fa-solid fa-user-tie me-2"></i>Site Management
                </h6>
                <div class="row g-3">
                    <div class="col-6">
                        <small class="text-muted d-block"><i class="fa-solid fa-user me-1"></i>Head</small>
                        <span class="fw-semibold">{{ $evacsites->head }}</span>
                    </div>
                    <div class="col-6">
                        <small class="text-muted d-block"><i class="fa-solid fa-phone me-1"></i>Contact</small>
                        <span class="fw-semibold">{{ $evacsites->contact }}</span>
                    </div>
                </div>
            </section>

            <hr>

            {{-- Facilities --}}
            <section>
                <h6 class="text-primary fw-bold mb-3">
                    <i class="fa-solid fa-building-user me-2"></i>Facilities
                </h6>
                <div class="row text-center">
                    <div class="col-3">
                        <small class="text-muted d-block"><i class="fa-solid fa-users me-1"></i>Capacity</small>
                        <h5 class="fw-bold">{{ $evacsites->capacity }}</h5>
                    </div>
                    <div class="col-3">
                        <small class="text-muted d-block"><i class="fa-solid fa-door-open me-1"></i>Rooms</small>
                        <h5 class="fw-bold">{{ $evacsites->room }}</h5>
                    </div>
                    <div class="col-3">
                        <small class="text-muted d-block"><i class="fa-solid fa-bolt me-1 text-warning"></i>Power</small>
                        <span class="badge bg-{{ $evacsites->powerstatus === 'available' ? 'success' : 'danger' }}">
                            {{ $evacsites->powerstatus }}
                        </span>
                    </div>
                    <div class="col-3">
                        <small class="text-muted d-block"><i class="fa-solid fa-droplet me-1 text-info"></i>Water</small>
                        <span class="badge bg-{{ $evacsites->waterstatus === 'available' ? 'success' : 'danger' }}">
                            {{ $evacsites->waterstatus }}
                        </span>
                    </div>
                </div>
            </section>

            <hr>

            {{-- Occupancy --}}
            @php
                $capacity = $evacsites->capacity ?? 1;
                $occupants = $evacsites->occupants ?? 0;
                $occupancy = min(100, round(($occupants / $capacity) * 100));
                $barColor = 'bg-success';
                if ($occupancy >= 80) $barColor = 'bg-danger';
                elseif ($occupancy >= 50) $barColor = 'bg-warning';
            @endphp
            <section>
                <h6 class="text-primary fw-bold mb-3">
                    <i class="fa-solid fa-person-shelter me-2"></i>Occupancy
                </h6>
                <small class="text-muted">Current: {{ $occupants }} / {{ $capacity }}</small>
                <div class="progress mt-2" style="height: 18px;">
                    <div class="progress-bar {{ $barColor }}" style="width: {{ $occupancy }}%;">
                        {{ $occupancy }}%
                    </div>
                </div>
            </section>

            <hr>

            {{-- Resources --}}
            <section>
                <h6 class="text-primary fw-bold mb-3">
                    <i class="fa-solid fa-boxes-stacked me-2"></i>Resources
                </h6>
                <div class="row text-center gy-3">
                    <div class="col-3">
                        <i class="fa-solid fa-briefcase-medical fa-2x text-danger"></i>
                        <div class="fw-bold">{{ $evacsites->medicine_qty }}</div>
                        <small class="text-muted">Medicine</small>
                    </div>
                    <div class="col-3">
                        <i class="fa-solid fa-pump-soap fa-2x text-primary"></i>
                        <div class="fw-bold">{{ $evacsites->toiletries_qty }}</div>
                        <small class="text-muted">Toiletries</small>
                    </div>
                    <div class="col-3">
                        <i class="fa-solid fa-box-open fa-2x text-warning"></i>
                        <div class="fw-bold">{{ $evacsites->relief_goods_qty }}</div>
                        <small class="text-muted">Relief Goods</small>
                    </div>
                    <div class="col-3">
                        <i class="fa-solid fa-bed fa-2x text-success"></i>
                        <div class="fw-bold">{{ $evacsites->beddings_qty }}</div>
                        <small class="text-muted">Beddings</small>
                    </div>
                </div>
            </section>
        </div>

        {{-- RIGHT COLUMN --}}
        <div class="col-lg-6">
            <div id="evacMap" style="height: 500px; border-radius: 10px; border: 1px solid #dee2e6;"></div>
        </div>
    </div>
</div>

{{-- MAP SCRIPT --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    const lat = {{ $evacsites->lat }};
    const lng = {{ $evacsites->lang }};
    const status = "{{ $evacsites->status }}";
    const sitename = "{{ $evacsites->sitename }}";
    
    let color;
    switch(status) {
        case 'operational': color = '#28a745'; break;
        case 'under_maintenance': color = '#ffc107'; break;
        case 'closed': color = '#dc3545'; break;
        default: color = '#6c757d';
    }
    
    const map = L.map('evacMap').setView([lat, lng], 15);
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; OpenStreetMap contributors'
    }).addTo(map);
    
    const circle = L.circle([lat, lng], {
        color: 'white',
        weight: 2,
        fillColor: color,
        fillOpacity: 0.7,
        radius: 100
    }).addTo(map).bindPopup(`<b>${sitename}</b><br>Status: ${status.replace('_', ' ')}`);
    
    let isVisible = true;
    setInterval(() => {
        isVisible = !isVisible;
        circle.setStyle({
            fillOpacity: isVisible ? 0.7 : 0.2,
            opacity: isVisible ? 1 : 0.5
        });
    }, 1000);
});
</script>
@endsection
