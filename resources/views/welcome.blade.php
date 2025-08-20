@extends('layouts.welcome')

@section('content')

        <div class="container-fluid">
            <div id="emergencyCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('carousel/1.jpg') }}" class="d-block w-100" alt="Rescue team in action" style="height: 300px; object-fit: cover;">
                        <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded">
                            <h5>Rescue Operations</h5>
                            <p>Emergency response teams rescuing flood victims.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="https://images.unsplash.com/photo-1604275688748-8a0732de69a5" class="d-block w-100" alt="Medical team" style="height: 300px; object-fit: cover;">
                        <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded">
                            <h5>Medical Assistance</h5>
                            <p>Paramedics providing first aid to disaster survivors.</p>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="https://images.unsplash.com/photo-1610057095041-6b90f6f63d34" class="d-block w-100" alt="Firefighters" style="height: 300px; object-fit: cover;">
                        <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded">
                            <h5>Fire and Safety</h5>
                            <p>Firefighters controlling fire during a calamity.</p>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#emergencyCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#emergencyCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </div>


        <header class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 mb-3 d-flex justify-content-center align-items-center flex-column">
                        <h1 class="display-2 fw-bold mb-3 text-center" style="letter-spacing: 1px;">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('logo/aparri.png') }}" alt="Logo" width="80" height="80" class="me-2">
                                <span class="">
                                    <span class="text-danger">i</span>Bakwit
                                </span>
                            </div>
                            <a href="{{ route('evacuate.index') }}"><button class="btn btn-primary btn-md px-4">Evacuate</button></a>
                        </h1>
                    </div>
                    <div class="col-md-12 mb-3 d-flex align-items-center">
                        <p class="lead text-muted mb-0">
                            <span class="fw-semibold text-primary">iBakwit</span> is a next-generation web platform empowering local government units and disaster response teams to monitor, manage, and coordinate evacuation sites with ease. Featuring real-time data visualization, instant site status updates, and smart resource tracking, it streamlines emergency response for safer, more resilient communities.
                        </p>
                    </div>
                </div>
            </div>
        </header>
        <hr>
        <div class="container py-4">
                <div class="row">
                    <div class="col-12 mb-3">
                        <h2 class="text-center fw-bold mb-5" style="letter-spacing: 2px;">
                            <span class="text-gradient" style="background: linear-gradient(90deg,#ff416c,#ff4b2b); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Key Features</span>
                        </h2>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card h-100">
                            <div class="card-body text-center py-4">
                                <div class="mb-3">
                                    <span class="bg-primary bg-opacity-10 rounded-circle p-3 d-inline-block">
                                        <i class="fa-solid fa-map-location-dot fa-2x text-primary"></i>
                                    </span>
                                </div>
                                <h5 class="card-title fw-bold mb-2">Real-Time Map</h5>
                                <p class="card-text text-muted mb-0">Visualize all evacuation sites on an interactive map with live status and capacity info.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card h-100">
                            <div class="card-body text-center py-4">
                                <div class="mb-3">
                                    <span class="bg-success bg-opacity-10 rounded-circle p-3 d-inline-block">
                                        <i class="fa-solid fa-boxes-packing fa-2x text-success"></i>
                                    </span>
                                </div>
                                <h5 class="card-title fw-bold mb-2">Resource Management</h5>
                                <p class="card-text text-muted mb-0">Track food, water, medical supplies, and personnel at each site in real time.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div class="card h-100">
                            <div class="card-body text-center py-4">
                                <div class="mb-3">
                                    <span class="bg-danger bg-opacity-10 rounded-circle p-3 d-inline-block">
                                        <i class="fa-solid fa-users fa-2x text-danger"></i>
                                    </span>
                                </div>
                                <h5 class="card-title fw-bold mb-2">Evacuee Registration</h5>
                                <p class="card-text text-muted mb-0">Register and manage evacuee info securely for better coordination and support.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <hr>
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-8 mx-auto">
                    <h2 class="text-center mb-4"><i class="fas fa-phone-volume me-2"></i> Emergency Hotlines</h2>
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <!-- National Emergency -->
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="fas fa-building-shield text-danger me-3"></i>
                                        <strong>National Emergency</strong>
                                    </div>
                                    <span class="badge bg-danger rounded-pill">911</span>
                                </li>
                                
                                <!-- Police -->
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="fas fa-shield-halved text-primary me-3"></i>
                                        <strong>Police Department</strong>
                                    </div>
                                    <span class="badge bg-primary rounded-pill">911 or (02) 8722-0650</span>
                                </li>
                                
                                <!-- Medical Emergency -->
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="fas fa-truck-medical text-danger me-3"></i>
                                        <strong>Medical Emergency</strong>
                                    </div>
                                    <span class="badge bg-danger rounded-pill">911 or (02) 8790-6300</span>
                                </li>
                                
                                <!-- Fire Department -->
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="fas fa-fire-extinguisher text-danger me-3"></i>
                                        <strong>Fire Department</strong>
                                    </div>
                                    <span class="badge bg-danger rounded-pill">911 or (02) 8426-0219</span>
                                </li>
                                
                                <!-- Poison Control -->
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="fas fa-biohazard text-warning me-3"></i>
                                        <strong>Poison Control</strong>
                                    </div>
                                    <span class="badge bg-warning text-dark rounded-pill">(02) 8524-1078</span>
                                </li>
                                
                                <!-- Mental Health -->
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="fas fa-brain text-info me-3"></i>
                                        <strong>Mental Health Crisis</strong>
                                    </div>
                                    <span class="badge bg-info rounded-pill">0917-899-USAP (8727)</span>
                                </li>
                                
                                <!-- Disaster Hotline -->
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="fas fa-house-tsunami text-success me-3"></i>
                                        <strong>Disaster Hotline</strong>
                                    </div>
                                    <span class="badge bg-success rounded-pill">(02) 8911-1406</span>
                                </li>
                            </ul>
                            
                            <div class="mt-4 p-3 bg-light rounded">
                                <p class="mb-1"><i class="fas fa-info-circle text-primary me-2"></i> <strong>Note:</strong> All emergency numbers are available 24/7</p>
                                <p class="mb-0"><i class="fas fa-globe text-primary me-2"></i> For international calls, dial +63 (area code) before the number</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <!-- Data & Statistics Section (Modern Layout) -->
        <section class="py-4">
            <div class="container">
            <div class="row align-items-center">
                <div class="col-md-5 mb-4 mb-md-0">
                <h2 class="fw-semibold mb-3">Latest Data & Statistics</h2>
                <p class="text-muted">
                    Stay updated with real-time statistics on evacuation sites, registered evacuees, occupancy rates, and monitoring status. Our dashboard ensures transparency and quick decision-making for disaster response teams.
                </p>
                </div>
                <div class="col-md-7">
                <div class="row g-3">
                    <div class="col-6">
                    <div class="card border-0 shadow-sm h-100 text-center">
                        <div class="card-body">
                        <span class="bg-danger bg-opacity-10 rounded-circle p-3 mb-2 d-inline-block">
                            <i class="fa-solid fa-location-dot fa-2x text-danger"></i>
                        </span>
                        <h3 class="fw-bold mb-0">12</h3>
                        <small class="text-muted">Evacuation Sites</small>
                        </div>
                    </div>
                    </div>
                    <div class="col-6">
                    <div class="card border-0 shadow-sm h-100 text-center">
                        <div class="card-body">
                        <span class="bg-primary bg-opacity-10 rounded-circle p-3 mb-2 d-inline-block">
                            <i class="fa-solid fa-users fa-2x text-primary"></i>
                        </span>
                        <h3 class="fw-bold mb-0">1,250</h3>
                        <small class="text-muted">Evacuees Registered</small>
                        </div>
                    </div>
                    </div>
                    <div class="col-6">
                    <div class="card border-0 shadow-sm h-100 text-center">
                        <div class="card-body">
                        <span class="bg-success bg-opacity-10 rounded-circle p-3 mb-2 d-inline-block">
                            <i class="fa-solid fa-chart-line fa-2x text-success"></i>
                        </span>
                        <h3 class="fw-bold mb-0">98%</h3>
                        <small class="text-muted">Site Occupancy</small>
                        </div>
                    </div>
                    </div>
                    <div class="col-6">
                    <div class="card border-0 shadow-sm h-100 text-center">
                        <div class="card-body">
                        <span class="bg-warning bg-opacity-10 rounded-circle p-3 mb-2 d-inline-block">
                            <i class="fa-solid fa-clock fa-2x text-warning"></i>
                        </span>
                        <h3 class="fw-bold mb-0">24/7</h3>
                        <small class="text-muted">Monitoring</small>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </section>
        <hr>

        <section class="py-5 bg-light">
            <div class="container">
                <h2 class="fw-bold text-primary mb-2">Realtime Monitoring of Evacuation Centers</h2>
                <div class="d-flex align-items-center gap-3 mb-4 text-muted">
                    <div>
                        <i class="fas fa-calendar-day me-2"></i>
                        <span id="current-date"></span>
                    </div>
                    <div>
                        <i class="fas fa-clock me-2"></i>
                        <span id="current-time"></span> (Open 24/7)
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
                <div class="row g-4">

                    <!-- Card 1 -->
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title text-dark">
                                    <i class="bi bi-mortarboard-fill text-primary me-1"></i>Aparri East Central School
                                </h5>
                                <p class="mb-1"><i class="bi bi-123 me-1 text-muted"></i><strong>Type:</strong> Public Elementary</p>
                                <p class="mb-1"><i class="bi bi-geo-alt me-1 text-muted"></i>Brgy. Centro, Aparri</p>
                                <p class="mb-1"><i class="bi bi-people-fill me-1 text-muted"></i><strong>Capacity:</strong> 1,200</p>
                                <p class="mb-2"><i class="bi bi-clock me-1 text-muted"></i><strong>Hours:</strong> Mon–Fri, 8 AM–4 PM</p>
                                <span class="badge bg-success w-50 mb-3">Status: Safe</span>
                                <a href="#" class="btn btn-sm btn-outline-primary mt-auto">
                                    <i class="bi bi-info-circle me-1"></i>View Details
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Card 2 -->
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title text-dark">
                                    <i class="bi bi-hospital-fill text-danger me-1"></i>Aparri West National High School
                                </h5>
                                <p class="mb-1"><i class="bi bi-123 me-1 text-muted"></i><strong>Type:</strong> Public High School</p>
                                <p class="mb-1"><i class="bi bi-geo-alt me-1 text-muted"></i>Brgy. Maura, Aparri</p>
                                <p class="mb-1"><i class="bi bi-people-fill me-1 text-muted"></i><strong>Capacity:</strong> 950</p>
                                <p class="mb-2"><i class="bi bi-clock me-1 text-muted"></i><strong>Hours:</strong> Mon–Sat, 7 AM–5 PM</p>
                                <span class="badge bg-warning w-50 mb-3">Status: Near Capacity</span>
                                <a href="#" class="btn btn-sm btn-outline-primary mt-auto">
                                    <i class="bi bi-info-circle me-1"></i>View Details
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Card 3 -->
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title text-dark">
                                    <i class="bi bi-house-heart-fill text-success me-1"></i>Barangay Hall of San Antonio
                                </h5>
                                <p class="mb-1"><i class="bi bi-123 me-1 text-muted"></i><strong>Type:</strong> Government Facility</p>
                                <p class="mb-1"><i class="bi bi-geo-alt me-1 text-muted"></i>Brgy. San Antonio, Aparri</p>
                                <p class="mb-1"><i class="bi bi-people-fill me-1 text-muted"></i><strong>Capacity:</strong> 300</p>
                                <p class="mb-2"><i class="bi bi-clock me-1 text-muted"></i><strong>Hours:</strong> 24/7</p>
                                <span class="badge bg-danger w-50 mb-3">Status: Full</span>
                                <a href="#" class="btn btn-sm btn-outline-primary mt-auto">
                                    <i class="bi bi-info-circle me-1"></i>View Details
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

@endsection