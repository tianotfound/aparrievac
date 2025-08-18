@extends('layouts.app')

@section('content')
<div class="container py-3">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-3">
        <div>
            <h5 class="mb-1 fw-bold">
                <i class="fa-solid fa-location-dot text-danger me-2"></i>{{ $evacsites->sitename }}
            </h5>
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
        <span class="badge bg-{{ $statusClass }} px-3 py-2">
            {{ Str::title(str_replace('_', ' ', $evacsites->status)) }}
        </span>
    </div>

    <div class="row g-3">
        {{-- LEFT COLUMN --}}
        <div class="col-lg-6 d-flex flex-column gap-3">

            {{-- Site Management --}}
            <section>
                <h6 class="text-primary fw-bold mb-2">
                    <i class="fa-solid fa-user-tie me-2"></i>Management
                </h6>
                <div class="row small">
                    <div class="col-6">
                        <span class="text-muted"><i class="fa-solid fa-user me-1"></i>Head:</span>
                        <span class="fw-semibold">{{ $evacsites->head }}</span>
                    </div>
                    <div class="col-6">
                        <span class="text-muted"><i class="fa-solid fa-phone me-1"></i>Contact:</span>
                        <span class="fw-semibold">{{ $evacsites->contact }}</span>
                    </div>
                </div>
            </section>

            {{-- Facilities --}}
            <section>
                <h6 class="text-primary fw-bold mb-2">
                    <i class="fa-solid fa-building-user me-2"></i>Facilities
                </h6>
                <div class="row text-center small">
                    <div class="col-3">
                        <div class="fw-bold fs-6">{{ $evacsites->capacity }}</div>
                        <span class="text-muted">Capacity</span>
                    </div>
                    <div class="col-3">
                        <div class="fw-bold fs-6">{{ $evacsites->room }}</div>
                        <span class="text-muted">Rooms</span>
                    </div>
                    <div class="col-3">
                        <span class="badge bg-{{ $evacsites->powerstatus === 'available' ? 'success' : 'danger' }}">
                            {{ $evacsites->powerstatus }}
                        </span>
                        <div class="text-muted">Power</div>
                    </div>
                    <div class="col-3">
                        <span class="badge bg-{{ $evacsites->waterstatus === 'available' ? 'success' : 'danger' }}">
                            {{ $evacsites->waterstatus }}
                        </span>
                        <div class="text-muted">Water</div>
                    </div>
                </div>
            </section>

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
                <h6 class="text-primary fw-bold mb-2">
                    <i class="fa-solid fa-person-shelter me-2"></i>Occupancy
                </h6>
                <div class="d-flex justify-content-between small text-muted">
                    <span>Current</span>
                    <span>{{ $occupants }} / {{ $capacity }}</span>
                </div>
                <div class="progress mt-1" style="height: 16px;">
                    <div class="progress-bar {{ $barColor }}" style="width: {{ $occupancy }}%;">
                        {{ $occupancy }}%
                    </div>
                </div>
            </section>

            {{-- Resources --}}
            <section>
                <h6 class="text-primary fw-bold mb-2">
                    <i class="fa-solid fa-boxes-stacked me-2"></i>Resources
                </h6>
                <div class="row text-center g-2">
                    <div class="col-3">
                        <i class="fa-solid fa-briefcase-medical text-danger"></i>
                        <div class="fw-bold">{{ $evacsites->medicine_qty }}</div>
                        <small class="text-muted">Medicine</small>
                    </div>
                    <div class="col-3">
                        <i class="fa-solid fa-pump-soap text-primary"></i>
                        <div class="fw-bold">{{ $evacsites->toiletries_qty }}</div>
                        <small class="text-muted">Toiletries</small>
                    </div>
                    <div class="col-3">
                        <i class="fa-solid fa-box-open text-warning"></i>
                        <div class="fw-bold">{{ $evacsites->relief_goods_qty }}</div>
                        <small class="text-muted">Relief Goods</small>
                    </div>
                    <div class="col-3">
                        <i class="fa-solid fa-bed text-success"></i>
                        <div class="fw-bold">{{ $evacsites->beddings_qty }}</div>
                        <small class="text-muted">Beddings</small>
                    </div>
                </div>
            </section>
        </div>

        {{-- RIGHT COLUMN --}}
        <div class="col-lg-6">
            <div id="evacMap" class="w-100 h-100" style="min-height: 450px; border-radius: 8px; border: 1px solid #dee2e6;"></div>
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
