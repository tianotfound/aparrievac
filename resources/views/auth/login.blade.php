@extends('layouts.auth')

@section('content')
<div class="container d-flex justify-content-center align-items-center vh-100 overflow-hidden">
<div class="col-md-4">
    <div class="card shadow-sm">
        <!-- Logo Header -->
        <div class="card-header text-center bg-white border-0 pb-0 mt-3">
            <img src="{{ asset('logo/aparri.png') }}" alt="iBakwit Logo" width="50" height="50" class="mb-2">
            <h5 class="fw-bold mb-0"><span class="text-danger">i</span>Bakwit</h5>
        </div>

        <!-- Card Body -->
        <div class="card-body px-4 py-3">
            <h6 class="text-center fw-bold mb-3">Login to your account</h6>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="fas fa-envelope text-muted"></i></span>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                               class="form-control @error('email') is-invalid @enderror"
                               placeholder="Email" required autofocus>
                    </div>
                    @error('email')
                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-3">
                    <div class="input-group">
                        <span class="input-group-text bg-light"><i class="fas fa-lock text-muted"></i></span>
                        <input type="password" id="password" name="password"
                               class="form-control @error('password') is-invalid @enderror"
                               placeholder="Password" required>
                        <button type="button" class="btn btn-outline-secondary toggle-password">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <small class="text-danger d-block mt-1">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Remember Me and Forgot -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="form-check">
                        <input type="checkbox" name="remember" id="remember" class="form-check-input"
                               {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label small" for="remember">Remember Me</label>
                    </div>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="small text-decoration-none">Forgot?</a>
                    @endif
                </div>

                <!-- Login Button -->
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary fw-semibold">
                        <i class="fas fa-sign-in-alt me-1"></i> Login
                    </button>
                </div>
            </form>
        </div>

        <!-- Footer -->
        <div class="card-footer text-center bg-white py-2 small text-muted">
            Authorized personnel only.
        </div>
    </div>
</div>
</div>

<!-- Toggle Password Script -->
<script>
    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', function () {
            const input = this.closest('.input-group').querySelector('input');
            const icon = this.querySelector('i');
            input.type = input.type === 'password' ? 'text' : 'password';
            icon.classList.toggle('fa-eye');
            icon.classList.toggle('fa-eye-slash');
        });
    });
</script>
@endsection
