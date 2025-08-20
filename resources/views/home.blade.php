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

    <!-- Page Header -->
    <div class="container mb-3">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="mb-0 text-gray-800">
                    <i class="fa-solid fa-gauge me-2"></i><b>Dashboard</b>
                </h5>
            </div>
        </div>
    </div>

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
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                        {{ __('Evacuation Sites') }}
                                    </div>
                                    @php
                                        $operationalCount = Evacsite::where('status', 'operational')->count();
                                        $closedCount = Evacsite::where('status', 'closed')->count();
                                        $underMaintenanceCount = Evacsite::where('status', 'under_maintenance')->count();
                                    @endphp
                                    <small class="ms-4 text-muted">
                                        <i class="fas fa-circle text-success me-1"></i> Operational: {{ $operationalCount }} <br>
                                        <i class="fas fa-circle text-danger me-1"></i> Closed: {{ $closedCount }} <br>
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
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-users text-info me-2"></i>
                                        {{ __('Evacuees') }}
                                    </div>
                                    <small class="text-muted mb-2" style="font-size: 9px;"><i>Clickable for easy access</i></small>
                                    <small class="ms-4 text-muted">
                                        @foreach ($evacsites as $item)
                                            <a href="javascript:void(0)" 
                                            class="zoom-to-site text-decoration-none text-muted"
                                            data-lat="{{ $item->lat }}" 
                                            data-lng="{{ $item->lang }}" 
                                            title="{{ $item->sitename }}">
                                                <i class="fas fa-circle text-primary me-1"></i> 
                                                @php
                                                    $words = explode(' ', $item->sitename);
                                                    $acronym = '';
                                                    foreach($words as $word) {
                                                        if (ctype_upper(substr($word, 0, 1))) {
                                                            $acronym .= strtoupper(substr($word, 0, 1));
                                                        }
                                                    }
                                                    echo $acronym;
                                                @endphp
                                            </a>
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

        // Zoom when clicking on site name in list
        $(document).on('click', '.zoom-to-site', function () {
            let lat = $(this).data('lat');
            let lng = $(this).data('lng');

            if (!isNaN(lat) && !isNaN(lng)) {
                map.setView([lat, lng], 16, { animate: true });
            }
        });

    });
    </script>
@endcan

{{-- =========================================================================================================================== --}}
@can('admin')
    <div class="container">
        <div id="flashAlert2" class="alert alert-warning text-center" role="alert">
            {{ __('Welcome, Admin! You have administrative privileges.') }}
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#flashAlert2').delay(3000).fadeOut('slow');
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
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                        {{ __('Evacuation Sites') }}
                                    </div>
                                    @php
                                        $operationalCount = Evacsite::where('status', 'operational')->count();
                                        $closedCount = Evacsite::where('status', 'closed')->count();
                                        $underMaintenanceCount = Evacsite::where('status', 'under_maintenance')->count();
                                    @endphp
                                    <small class="ms-4 text-muted">
                                        <i class="fas fa-circle text-success me-1"></i> Operational: {{ $operationalCount }} <br>
                                        <i class="fas fa-circle text-danger me-1"></i> Closed: {{ $closedCount }} <br>
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
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-users text-info me-2"></i>
                                        {{ __('Evacuees') }}
                                    </div>
                                    <small class="text-muted mb-2" style="font-size: 9px;"><i>Clickable for easy access</i></small>
                                    <small class="ms-4 text-muted">
                                        @foreach ($evacsites as $item)
                                            <a href="javascript:void(0)" 
                                            class="zoom-to-site text-decoration-none text-muted"
                                            data-lat="{{ $item->lat }}" 
                                            data-lng="{{ $item->lang }}" 
                                            title="{{ $item->sitename }} ({{ $item->evacuee_count }} evacuees)">
                                                <i class="fas fa-circle text-primary me-1"></i> 
                                                @php
                                                    $words = explode(' ', $item->sitename);
                                                    $acronym = '';
                                                    foreach($words as $word) {
                                                        if (ctype_upper(substr($word, 0, 1))) {
                                                            $acronym .= strtoupper(substr($word, 0, 1));
                                                        }
                                                    }
                                                    echo $acronym;
                                                @endphp
                                                <span class="badge bg-secondary ms-1">{{ $item->evacuee_count }}</span>
                                            </a>
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

        // Zoom when clicking on site name in list
        $(document).on('click', '.zoom-to-site', function () {
            let lat = $(this).data('lat');
            let lng = $(this).data('lng');

            if (!isNaN(lat) && !isNaN(lng)) {
                map.setView([lat, lng], 16, { animate: true });
            }
        });

    });
    </script>
@endcan
{{-- =========================================================================================================================== --}}
@can('staff')
    <div class="alert alert-success" role="alert">
        {{ __('Welcome, User! You can access your dashboard and manage your profile.') }}
    </div>

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
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-map-marker-alt text-primary me-2"></i>
                                        {{ __('Evacuation Sites') }}
                                    </div>
                                    @php
                                        $operationalCount = Evacsite::where('status', 'operational')->count();
                                        $closedCount = Evacsite::where('status', 'closed')->count();
                                        $underMaintenanceCount = Evacsite::where('status', 'under_maintenance')->count();
                                    @endphp
                                    <small class="ms-4 text-muted">
                                        <i class="fas fa-circle text-success me-1"></i> Operational: {{ $operationalCount }} <br>
                                        <i class="fas fa-circle text-danger me-1"></i> Closed: {{ $closedCount }} <br>
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
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="fas fa-users text-info me-2"></i>
                                        {{ __('Evacuees') }}
                                    </div>
                                    <small class="text-muted mb-2" style="font-size: 9px;"><i>Clickable for easy access</i></small>
                                    <small class="ms-4 text-muted">
                                        @foreach ($evacsites as $item)
                                            <a href="javascript:void(0)" 
                                            class="zoom-to-site text-decoration-none text-muted"
                                            data-lat="{{ $item->lat }}" 
                                            data-lng="{{ $item->lang }}" 
                                            title="{{ $item->sitename }}">
                                                <i class="fas fa-circle text-primary me-1"></i> 
                                                @php
                                                    $words = explode(' ', $item->sitename);
                                                    $acronym = '';
                                                    foreach($words as $word) {
                                                        if (ctype_upper(substr($word, 0, 1))) {
                                                            $acronym .= strtoupper(substr($word, 0, 1));
                                                        }
                                                    }
                                                    echo $acronym;
                                                @endphp
                                            </a>
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

        // Zoom when clicking on site name in list
        $(document).on('click', '.zoom-to-site', function () {
            let lat = $(this).data('lat');
            let lng = $(this).data('lng');

            if (!isNaN(lat) && !isNaN(lng)) {
                map.setView([lat, lng], 16, { animate: true });
            }
        });

    });
    </script>

@endcan
{{-- =========================================================================================================================== --}}
@can('user')
    <div class="alert alert-secondary" role="alert">
        {{ __('Welcome, Guest! Here are your details.') }}
    </div>
@endcan
{{-- =========================================================================================================================== --}}
@endsection
