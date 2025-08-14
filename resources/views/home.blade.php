@php use App\Models\Evacsite; @endphp

@extends('layouts.app')

@section('content')
{{-- =========================================================================================================================== --}}
@can('superadmin')

    <div class="container">
        <div id="flashAlert" class="alert alert-success text-center" role="alert">
            {{ __('Welcome, Super Admin! You have full access to the system.') }}
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#flashAlert').delay(3000).fadeOut('slow');
        });
    </script>

    <div class="container">
        <div class="row justify-content-center align-item center">  
            <div class="col-md-9 mb-3">
                <div class="map">
                    <div id="map" style="height: 650px; width: 100%;"></div>
                </div>
            </div>
            
            <div class="col-md-3 mb-4">
                <div class="container mb-3">
                    <div class="row text-center">
                        <div class="col-12">
                            <div id="current-time" class="display-6 mb-1" style="font-weight: 600;"></div>
                            <div id="current-date" class="h6 text-muted"></div>
                        </div>
                    </div>
                </div>
                <script>
                    // Function to update date and time
                    function updateDateTime() {
                        const now = new Date();
                        
                        // Format date (e.g., "July 23, 2023")
                        const options = { year: 'numeric', month: 'long', day: 'numeric' };
                        document.getElementById('current-date').textContent = now.toLocaleDateString(undefined, options);
                        
                        // Format time (e.g., "11:45:23 AM")
                        document.getElementById('current-time').textContent = now.toLocaleTimeString();
                    }

                    // Update immediately and then every second
                    updateDateTime();
                    setInterval(updateDateTime, 1000);
                </script>
                <div class="card shadow-sm border-0 h-auto">
                    <div class="card-body">
                        <h5 class="card-title text-primary fw-bold d-flex align-items-center mb-3">
                            <i class="fas fa-tachometer-alt me-2"></i> {{ __('Overview') }}
                        </h5>
                        <hr class="my-2">
                        <ul class="list-unstyled">
                            <li class="d-flex justify-content-between align-items-start py-2">
                                <div class="d-flex flex-column">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                        {{ __('Evacuation Sites') }}
                                    </div>
                                    @php
                                        $operationalCount = Evacsite::where('status', 'operational')->count();
                                        $notOperationalCount = Evacsite::where('status', 'closed')->count();
                                        $underMaintenanceCount = Evacsite::where('status', 'under_maintenance')->count();
                                    @endphp
                                    <small class="ms-4 text-muted">
                                        <i class="fas fa-circle text-success me-1"></i> Operational: {{ $operationalCount }} <br>
                                        <i class="fas fa-circle text-danger me-1"></i> Not Operational: {{ $notOperationalCount }} <br>
                                        <i class="fas fa-circle text-warning me-1"></i> Under Maintenance: {{ $underMaintenanceCount }}
                                    </small>
                                </div>
                                <span class="badge bg-primary rounded-pill mt-1">
                                    {{ \App\Models\Evacsite::count() }}
                                </span>
                            </li>

                            <hr class="my-1">

                            <li class="d-flex justify-content-between align-items-center py-2">
                                <div class="d-flex flex-column">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-users text-info me-2"></i>
                                        {{ __('Evacuees') }}
                                    </div>

                                    <small class="ms-4 text-muted">
                                        @foreach ($evacsites as $item)
                                            <i class="fas fa-circle text-secondary me-1"></i> 
                                        @php
                                            $words = explode(' ', $item->sitename);
                                            $acronym = '';
                                            foreach($words as $word) {
                                                if (ctype_upper(substr($word, 0, 1))) {  // Check if first letter is uppercase
                                                    $acronym .= strtoupper(substr($word, 0, 1));
                                                }
                                            }
                                            echo $acronym;
                                        @endphp
                                        <br>
                                        @endforeach
                                    </small>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr>

    <div class="container">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">7-Day Weather Forecast</h5>
                        <button class="btn btn-sm btn-light" onclick="refreshWeather()">
                            <i class="fas fa-sync-alt"></i> Refresh
                        </button>
                    </div>
                </div>
                <div class="card-body" id="weather-container">
                    @if(empty($weatherForecast))
                        <div class="alert alert-danger">
                            <div class="d-flex align-items-center">
                                <i class="fas fa-exclamation-circle fa-2x me-3"></i>
                                <div>
                                    <h5>Weather Data Unavailable</h5>
                                    <p class="mb-0">We couldn't fetch weather data. Please:</p>
                                    <ul class="mb-0">
                                        <li>Check your internet connection</li>
                                        <li>Verify the API key is set in .env</li>
                                        <li>Try again later</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="row text-center">
                            @foreach($weatherForecast as $forecast)
                            <div class="col-md-2 col-4 mb-3">
                                <div class="bg-light p-2 rounded h-100">
                                    <h6 class="font-weight-bold">{{ \Carbon\Carbon::createFromTimestamp($forecast['dt'])->isoFormat('ddd') }}</h6>
                                    <small>{{ \Carbon\Carbon::createFromTimestamp($forecast['dt'])->isoFormat('MMM D') }}</small>
                                    <img src="https://openweathermap.org/img/wn/{{ $forecast['weather'][0]['icon'] }}@2x.png" 
                                        alt="{{ $forecast['weather'][0]['description'] }}"
                                        class="img-fluid my-1"
                                        width="60"
                                        height="60">
                                    <div class="mt-1">
                                        <span class="font-weight-bold">{{ round($forecast['temp']['day']) }}°C</span>
                                        <small class="d-block text-muted">
                                            H: {{ round($forecast['temp']['max']) }}° L: {{ round($forecast['temp']['min']) }}°
                                        </small>
                                    </div>
                                    <small class="text-muted d-block">{{ ucfirst($forecast['weather'][0]['description']) }}</small>
                                    <small class="text-info">
                                        <i class="fas fa-tint"></i> {{ $forecast['humidity'] }}%
                                    </small>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
        var map = L.map('map').setView([18.343612100434054, 121.63245382436055], 13);

        var layers = {
            "OpenStreetMap": L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: 'Municipal Government of Aparri © Elaurza 2025'
            }),
            "Esri World Imagery": L.tileLayer('https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}', {
                maxZoom: 19,
                attribution: 'Municipal Government of Aparri © Elaurza 2025'
            }),
            "OpenTopoMap": L.tileLayer('https://{s}.tile.opentopomap.org/{z}/{x}/{y}.png', {
                maxZoom: 17,
                attribution: 'Municipal Government of Aparri © Elaurza 2025'
            })
        };

        layers["OpenStreetMap"].addTo(map);
        L.control.layers(layers).addTo(map);

        // Fetch data from Laravel (make sure $evacsites includes `status`)
        var schools = @json($evacsites);

        var circles = [];

        schools.forEach(function (school) {
            let color = '#0d6efd';
            let blinkSpeed = 1000; // default blink interval
            let rippleStart = 100;
            let rippleMax = 200;

            // Assign color & blink speed based on status
            if (school.status === 'operational') {
                color = '#198754'; // green
            } 
            else if (school.status === 'under_maintenance') {
                color = '#ffc107'; // yellow
            } 
            else if (school.status === 'closed') {
                color = '#dc3545'; // red
                blinkSpeed = 400; // rapid flash
                rippleStart = 250;
                rippleMax = 600;
            }

            let baseCircle = L.circle([school.lat, school.lang], {
                color: '#ffffff',
                weight: 2,
                fillColor: color,
                fillOpacity: 0.8,
                radius: 100,
                className: 'circle-shadow'
            }).addTo(map).bindPopup(school.sitename);

            let ripple = L.circle([school.lat, school.lang], {
                color: '#ffffff',
                weight: 1,
                fillColor: color,
                fillOpacity: 0.2,
                radius: rippleStart,
                interactive: false,
                className: 'circle-shadow'
            }).addTo(map);

            circles.push({
                base: baseCircle,
                ripple: ripple,
                rippleStart: rippleStart,
                rippleMax: rippleMax,
                blinkSpeed: blinkSpeed
            });
        });

        function animateCircle(c) {
            let currentOpacity = c.base.options.fillOpacity;
            c.base.setStyle({ fillOpacity: currentOpacity === 0.8 ? 0.2 : 0.8 });

            let steps = 20;
            let step = 0;
            let radius = c.rippleStart;

            let rippleInterval = setInterval(function () {
                radius += (c.rippleMax - c.rippleStart) / steps;
                let newOpacity = 0.2 * (1 - step / steps);
                c.ripple.setStyle({
                    radius: radius,
                    fillOpacity: newOpacity,
                    opacity: newOpacity
                });
                step++;

                if (step >= steps) {
                    c.ripple.setStyle({ radius: c.rippleStart, fillOpacity: 0.2, opacity: 0.2 });
                    clearInterval(rippleInterval);
                }
            }, 30);
        }

        circles.forEach(function (c) {
            setInterval(function () {
                animateCircle(c);
            }, c.blinkSpeed);
        });

        window.setTerrain = function (type) {
            if (layers[type]) {
                map.eachLayer(function (layer) {
                    if (layer instanceof L.TileLayer) {
                        map.removeLayer(layer);
                    }
                });
                layers[type].addTo(map);
            }
        };
    });
    </script>



@endcan

{{-- =========================================================================================================================== --}}
@can('admin')
    <div class="container">
        <div class="alert alert-warning text-center" role="alert">
            {{ __('Welcome, Admin! You have administrative privileges.') }}
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card border-0 rounded-3 h-100">
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-success bg-opacity-10 p-3 rounded-circle me-3">
                                <i class="fas fa-house-tsunami fa-lg text-success"></i>
                            </div>
                            <h5 class="card-title mb-0 fw-bold">{{ __('Evacuation Sites') }}</h5>
                        </div>
                        
                        <p class="card-text text-muted flex-grow-1">
                            {{ __('Monitor and manage all evacuation centers and their capacities.') }}
                        </p>
                        
                        <div class="mt-auto">
                            <a href="" class="btn btn-outline-success">
                                <i class="fas fa-map-location-dot me-2"></i>{{ __('View Sites') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card border-0 rounded-3 h-100">
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex align-items-center mb-3">
                            <div class="bg-info bg-opacity-10 p-3 rounded-circle me-3">
                                <i class="fas fa-people-group fa-lg text-info"></i>
                            </div>
                            <h5 class="card-title mb-0 fw-bold">{{ __('Evacuees Data') }}</h5>
                        </div>
                        
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Total Evacuees:</span>
                                <span class="fw-bold">1,242</span>
                            </div>
                            <div class="d-flex justify-content-between mb-2">
                                <span class="text-muted">Families:</span>
                                <span class="fw-bold">328</span>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span class="text-muted">Last Updated:</span>
                                <span class="fw-bold">2 hours ago</span>
                            </div>
                        </div>
                        
                        <div class="mt-auto d-flex gap-2">
                            <a href="" class="btn btn-outline-info">
                                <i class="fas fa-list me-2"></i>{{ __('View All') }}
                            </a>
                            <a href="" class="btn btn-info">
                                <i class="fas fa-plus"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endcan
{{-- =========================================================================================================================== --}}
@can('staff')
    <div class="alert alert-success" role="alert">
        {{ __('Welcome, User! You can access your dashboard and manage your profile.') }}
    </div>
@endcan
{{-- =========================================================================================================================== --}}
@can('user')
    <div class="alert alert-secondary" role="alert">
        {{ __('Welcome, Guest! Here are your details.') }}
    </div>
@endcan
{{-- =========================================================================================================================== --}}
@endsection
