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

        <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
            <div class="container">
                <a class="navbar-brand fw-bold" href="#"><span class="text-danger italize">i</span>Bakwit</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ url('/') }}">Home</a>
                        </li>
                       <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="evacuationDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Evacuation Centers
                            </a>
                            <ul class="dropdown-menu bg-danger" aria-labelledby="evacuationDropdown">
                                <li><a class="dropdown-item text-white" href="{{ route('evacuate.index') }}">All Centers</a></li>
                                <li><hr class="dropdown-divider text-white"></li>
                                <li><a class="dropdown-item text-white  " href="#">Reports</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('contact.index') }}">Contact</a>
                        </li>
                    </ul>
                    <div class="d-flex gap-2">
                        <a href="{{ route('login') }}" class="btn btn-primary btn-sm px-4"><i class="fas fa-user"></i> Login</a>
                    </div>
                </div>
            </div>
        </nav>
        <marquee class="bg-danger text-white" scrollamount="10" direction="left"><span class="text-warning">iBakwit</span> Municipal Government of Aparri © CAE</marquee>

        <div class="">
            @yield('content')
        </div>

        <!-- Footer -->
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
                        <p class="mb-0">Powered by <span class="text-warning fw-semibold">AparriMDRRMO</span></p>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>