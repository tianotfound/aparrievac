<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link rel="icon" type="image/png" href="{{ asset('logo/aparri.png') }}">
        <title>{{ config('app.name') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

        <!-- Bootstrap 5 JS and CSS CDN -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

        <!-- Leaflet CSS & JS -->
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
        <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
        <script src="{{ asset('JS/leaflet.js') }}"></script>

        <!-- Font Awesome CDN -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

        <!-- Style -->
        <style>
            body{
                font-family: 'Inter', sans-serif;
                background-color: #f0f0f0;
                color: #333;
            }
        </style>

    </head>
    <body>
        
        <marquee class="bg-danger text-white" scrollamount="10" direction="left"><span class="text-warning">iBakwit</span> Municipal Government of Aparri © CAE</marquee>

        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
            <div class="container">
                <a class="navbar-brand fw-bold" href="#"><span class="text-danger">i</span>Bakwit</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Evacuation Centers</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Contact</a>
                        </li>
                    </ul>
                    <div class="d-flex gap-2">
                        <a href="{{ route('login') }}" class="btn btn-primary btn-sm px-4"><i class="fas fa-user"></i> Login</a>
                    </div>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            <div id="map" style="height: 300px; width: 100%;"></div>
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
                            <button class="btn btn-primary btn-lg px-4">Evacuate</button>
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


        <footer class="bg-danger text-white pt-5 pb-4">

            <div class="container py-4">
                <div class="row justify-content-center">
                    <div class="col-12">
                            <div class="text-center mb-3">
                                <span class="text-mwhite small">In partnership with:</span>
                            </div>

                            <div class="d-flex justify-content-center align-items-center gap-5 flex-wrap mb-5">
                                <div class="bg-white shadow-sm rounded-circle p-3 d-flex align-items-center justify-content-center" style="height:80px; width:80px;">
                                    <img src="{{ asset('logo/cagayan.png') }}" alt="Cagayan Logo" style="height:50px;">
                                </div>
                                <div class="bg-white shadow-sm rounded-circle p-3 d-flex align-items-center justify-content-center" style="height:80px; width:80px;">
                                    <img src="{{ asset('logo/aparri.png') }}" alt="Aparri Logo" style="height:50px;">
                                </div>
                                <div class="bg-white shadow-sm rounded-circle p-3 d-flex align-items-center justify-content-center" style="height:80px; width:80px;">
                                    <img src="{{ asset('logo/aenhs.png') }}" alt="CSU Logo" style="height:50px;">
                                </div>
                            </div>
                        <hr>
                    </div>
                </div>
            </div>

            <div class="container text-md-left">

                <div class="row text-md-left">

                    <!-- Contact & Support -->
                    <div class="col-md-4 col-lg-4 col-xl-4 mx-auto mt-3">
                        <h5 class="text-uppercase mb-4 fw-bold text-warning">Contact & Support</h5>
                        <p>For inquiries, support, or feedback, contact the iEvacuate team at:</p>
                        <p>
                            <i class="fas fa-envelope me-2"></i>
                            <a href="mailto:support@ievacuate.com" class="text-white">support@ievacuate.com</a>
                        </p>
                        <p>
                            <i class="fas fa-circle-question me-2"></i>
                            <a href="#" class="text-white">Visit our Help Center</a>
                        </p>
                    </div>

                    <!-- Quick Links -->
                    <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                        <h5 class="text-uppercase mb-4 fw-bold text-warning">Quick Links</h5>
                        <p>
                            <a href="#" class="text-white text-decoration-none">
                                <i class="fas fa-home me-2"></i>Home
                            </a>
                        </p>
                        <p>
                            <a href="#" class="text-white text-decoration-none">
                                <i class="fas fa-info-circle me-2"></i>About Us
                            </a>
                        </p>
                        <p>
                            <a href="#" class="text-white text-decoration-none">
                                <i class="fas fa-star me-2"></i>Features
                            </a>
                        </p>
                        <p>
                            <a href="#" class="text-white text-decoration-none">
                                <i class="fas fa-envelope me-2"></i>Contact
                            </a>
                        </p>
                    </div>

                    <!-- Follow Us -->
                    <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mt-3">
                        <h5 class="text-uppercase mb-4 fw-bold text-warning">Follow Us</h5>
                        <a href="#" class="text-white me-4"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#" class="text-white me-4"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#" class="text-white me-4"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#" class="text-white me-4"><i class="fa-brands fa-linkedin-in"></i></a>
                    </div>

                </div>
                <hr class="my-3"/>
                <!-- Copyright -->
                <div class="row align-items-center">
                    <div class="col-md-7 col-lg-8">
                        <p class="text-white mb-0">© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
                    </div>
                    <div class="col-md-5 col-lg-4 text-md-end">
                        <p class="mb-0">Powered by <span class="text-warning fw-semibold">APARRIMDRRMO</span></p>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>
