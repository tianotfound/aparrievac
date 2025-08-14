@extends('layouts.welcome')

@section('content')

<style>
    /* Hero Section */
    .hero-section {
        background: linear-gradient(135deg, #ff4d4d, #ff944d);
        padding: 60px 20px;
        border-radius: 20px;
    }
    .hero-section h1 {
        font-size: 2.8rem;
        font-weight: 800;
    }

    /* Card Hover Effects */
    .hotline-card {
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }
    .hotline-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0,0,0,0.15);
    }

    /* Icon Animation */
    .hotline-icon {
        animation: pulse 2s infinite;
    }
    @keyframes pulse {
        0% { transform: scale(1); }
        50% { transform: scale(1.1); }
        100% { transform: scale(1); }
    }

    /* Phone Number */
    .phone-number {
        font-size: 1.5rem;
        font-weight: bold;
    }
</style>

<div class="container py-5">
    <!-- Header -->
    <div class="hero-section text-center text-white mb-5">
        <h1>
            <i class="fas fa-phone-alt me-3"></i> Emergency Hotlines
        </h1>
        <p class="lead mb-0">Quick access to emergency services and government agencies</p>
    </div>

    <!-- Hotline Cards -->
    <div class="row g-4 mb-5">
        @php
            $hotlines = [
                ['icon' => 'fa-shield-halved', 'color' => 'primary', 'agency' => 'PNP', 'desc' => 'Philippine National Police', 'phone' => '0917 203 2003', 'btn' => 'primary'],
                ['icon' => 'fa-fire-flame-curved', 'color' => 'warning', 'agency' => 'BFP', 'desc' => 'Bureau of Fire Protection', 'phone' => '0916 491 0946', 'btn' => 'warning'],
                ['icon' => 'fa-house-flood-water', 'color' => 'info', 'agency' => 'MDRRMO', 'desc' => 'Municipal Disaster Risk Reduction & Management Office', 'phone' => '0956 654 2894', 'btn' => 'info'],
                ['icon' => 'fa-anchor', 'color' => 'secondary', 'agency' => 'COAST GUARD', 'desc' => 'Philippine Coast Guard', 'phone' => '0954 368 3245', 'btn' => 'secondary'],
                ['icon' => 'fa-ship', 'color' => 'success', 'agency' => 'MARITIME', 'desc' => 'Maritime Industry Authority', 'phone' => '0967 001 7335', 'btn' => 'success']
            ];
        @endphp

        @foreach($hotlines as $h)
        <div class="col-lg-6 col-xl-4">
            <div class="card hotline-card h-100 shadow-lg border-0 position-relative">
                <span class="badge bg-danger position-absolute top-0 end-0 m-3 rounded-pill">EMERGENCY</span>
                <div class="card-body text-center p-4">
                    <div class="text-{{ $h['color'] }} mb-3">
                        <i class="fas {{ $h['icon'] }} hotline-icon" style="font-size: 3rem;"></i>
                    </div>
                    <h3 class="card-title fw-bold text-dark mb-2">{{ $h['agency'] }}</h3>
                    <p class="text-muted small mb-3">{{ $h['desc'] }}</p>
                    <div class="mb-3">
                        <h4 class="text-danger fw-bold font-monospace phone-number">
                            <i class="fas fa-phone me-2"></i>{{ $h['phone'] }}
                        </h4>
                    </div>
                    <a href="tel:{{ preg_replace('/\s+/', '', $h['phone']) }}" 
                       class="btn btn-{{ $h['btn'] }} btn-lg rounded-pill px-4 text-white">
                        <i class="fas fa-phone me-2"></i>Call Now
                    </a>
                </div>
            </div>
        </div>
        @endforeach

        <!-- Emergency Tips -->
        <div class="col-lg-6 col-xl-4">
            <div class="card h-100 shadow-lg border-0 bg-dark text-white hotline-card">
                <div class="card-body text-center p-4 d-flex flex-column justify-content-center">
                    <div class="text-warning mb-3">
                        <i class="fas fa-exclamation-triangle" style="font-size: 3rem;"></i>
                    </div>
                    <h3 class="card-title fw-bold mb-4">Emergency Tips</h3>
                    <ul class="list-unstyled text-start">
                        <li class="mb-3"><i class="fas fa-check-circle text-success me-3"></i>Stay calm and speak clearly</li>
                        <li class="mb-3"><i class="fas fa-check-circle text-success me-3"></i>Provide exact location</li>
                        <li class="mb-3"><i class="fas fa-check-circle text-success me-3"></i>Describe the emergency</li>
                        <li><i class="fas fa-check-circle text-success me-3"></i>Follow operator instructions</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Important Notice -->
    <div class="alert alert-light shadow border-0 rounded-3" role="alert">
        <div class="d-flex align-items-center">
            <i class="fas fa-info-circle text-primary me-3 fs-4"></i>
            <div>
                <h5 class="alert-heading mb-1">Important Notice</h5>
                <p class="mb-0">These hotlines are for emergency situations only. Please use them responsibly and only when immediate assistance is required.</p>
            </div>
        </div>
    </div>
</div>

@endsection
