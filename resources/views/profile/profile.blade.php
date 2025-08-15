@extends('layouts.app')

@section('content')
<div class="container py-3">
    <div class="row justify-content-center">
        <div class="col-lg-8 col-xl-7">

            {{-- Success Message --}}
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show d-flex align-items-center mb-4" role="alert">
                    <i class="fas fa-check-circle fa-lg me-3"></i>
                    <div>{{ session('success') }}</div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-header bg-white py-3 border-bottom">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-user-edit me-2 text-primary"></i>Edit Profile
                    </h5>
                </div>
                
                <div class="card-body p-4">
                    <form method="POST" action="{{ route('user.profile.store') }}" enctype="multipart/form-data">
                        @csrf

                        {{-- Profile Picture --}}
                        <div class="text-center mb-4">
                            <div class="position-relative d-inline-block">
                                <img src="/avatars/{{ auth()->user()->avatar }}" 
                                    class="rounded-circle border border-3 border-primary" 
                                    style="width: 150px; height: 150px; object-fit: cover;"
                                    alt="Profile Picture">
                                <label for="avatar" class="position-absolute bottom-0 end-0 bg-primary text-white rounded-circle p-2" style="width: 40px; height: 40px; cursor: pointer;">
                                    <i class="fas fa-camera"></i>
                                    <input id="avatar" type="file" name="avatar" class="d-none @error('avatar') is-invalid @enderror">
                                </label>
                            </div>
                            @error('avatar')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Name & Email --}}
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                        id="name" name="name" value="{{ auth()->user()->name }}" 
                                        placeholder="Full Name">
                                    <label for="name">
                                        <i class="fas fa-user me-1 text-muted"></i> Full Name
                                    </label>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                        id="email" name="email" value="{{ auth()->user()->email }}" 
                                        placeholder="Email Address">
                                    <label for="email">
                                        <i class="fas fa-envelope me-1 text-muted"></i> Email Address
                                    </label>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Password & Confirm --}}
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                        id="password" name="password" placeholder="Password">
                                    <label for="password">
                                        <i class="fas fa-lock me-1 text-muted"></i> New Password
                                    </label>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-text">Leave blank to keep current password</div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="password" class="form-control @error('confirm_password') is-invalid @enderror" 
                                        id="confirm_password" name="confirm_password" placeholder="Confirm Password">
                                    <label for="confirm_password">
                                        <i class="fas fa-lock me-1 text-muted"></i> Confirm Password
                                    </label>
                                    @error('confirm_password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Phone & City --}}
                        <div class="row g-3 mb-4">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                        id="phone" name="phone" value="{{ auth()->user()->phone }}" 
                                        placeholder="Phone Number">
                                    <label for="phone">
                                        <i class="fas fa-phone me-1 text-muted"></i> Phone Number
                                    </label>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="text" class="form-control @error('city') is-invalid @enderror" 
                                        id="city" name="city" value="{{ auth()->user()->city }}" 
                                        placeholder="City">
                                    <label for="city">
                                        <i class="fas fa-city me-1 text-muted"></i> City
                                    </label>
                                    @error('city')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Submit Button --}}
                        <div class="d-grid pt-3">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fas fa-save me-2"></i> Update Profile
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection