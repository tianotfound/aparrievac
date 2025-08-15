@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="fas fa-user-plus me-2"></i>Add New Evacuee
                        </h4>
                        <a href="{{ route('evacuee.index') }}" class="btn btn-light btn-sm">
                            <i class="fas fa-arrow-left me-1"></i> Back
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <form action="{{ route('evacuee.store') }}" method="POST">
                        @csrf

                        <div class="row mb-4">
                            <div class="col-md-4 mb-3">
                                <label for="evacsites_id" class="form-label">
                                    <i class="fas fa-map-marker-alt text-danger me-1"></i> Evacuation Site
                                </label>
                                <select class="form-select @error('evacsites_id') is-invalid @enderror" id="evacsites_id" name="evacsites_id" required>
                                    <option value="" selected disabled>Select Site</option>
                                    @foreach($evacsites as $site)
                                        <option value="{{ $site->id }}" {{ old('evacsites_id') == $site->id ? 'selected' : '' }}>
                                            {{ $site->sitename }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('evacsites_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="family_count" class="form-label">
                                    <i class="fas fa-users me-1"></i> Family Members
                                </label>
                                <input type="number" class="form-control @error('family_count') is-invalid @enderror" 
                                       id="family_count" name="family_count" value="{{ old('family_count', 1) }}" min="1" required>
                                @error('family_count')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <h5 class="mb-3 text-primary">
                            <i class="fas fa-user-circle me-1"></i> Personal Information
                        </h5>

                        <div class="row mb-3">
                            <div class="col-md-4 mb-3">
                                <label for="last_name" class="form-label">Last Name</label>
                                <input type="text" class="form-control @error('last_name') is-invalid @enderror" 
                                       id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                                @error('last_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="first_name" class="form-label">First Name</label>
                                <input type="text" class="form-control @error('first_name') is-invalid @enderror" 
                                       id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                                @error('first_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="middle_name" class="form-label">Middle Name</label>
                                <input type="text" class="form-control @error('middle_name') is-invalid @enderror" 
                                       id="middle_name" name="middle_name" value="{{ old('middle_name') }}">
                                @error('middle_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-3 mb-3">
                                <label for="age" class="form-label">Age</label>
                                <input type="number" class="form-control @error('age') is-invalid @enderror" 
                                       id="age" name="age" value="{{ old('age') }}" min="0" max="120" required>
                                @error('age')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="gender" class="form-label">Gender</label>
                                <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender" required>
                                    <option value="" disabled selected>Select</option>
                                    <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                    <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="contact_number" class="form-label">
                                    <i class="fas fa-phone me-1"></i> Contact Number
                                </label>
                                <input type="text" class="form-control @error('contact_number') is-invalid @enderror" 
                                       id="contact_number" name="contact_number" value="{{ old('contact_number') }}" required>
                                @error('contact_number')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <h5 class="mb-3 text-primary">
                            <i class="fas fa-home me-1"></i> Address Information
                        </h5>

                        <div class="row mb-3">
                            <div class="col-md-6 mb-3">
                                <label for="barangay" class="form-label">Barangay</label>
                                <input type="text" class="form-control @error('barangay') is-invalid @enderror" 
                                       id="barangay" name="barangay" value="{{ old('barangay') }}" required>
                                @error('barangay')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="address" class="form-label">Complete Address</label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror" 
                                       id="address" name="address" value="{{ old('address') }}" required>
                                @error('address')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <h5 class="mb-3 text-primary">
                            <i class="fas fa-heartbeat me-1"></i> Health Information
                        </h5>

                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <label for="medical_condition" class="form-label">Medical Condition (if any)</label>
                                <textarea class="form-control @error('medical_condition') is-invalid @enderror" 
                                          id="medical_condition" name="medical_condition" rows="2">{{ old('medical_condition') }}</textarea>
                                @error('medical_condition')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="remarks" class="form-label">Remarks</label>
                                <textarea class="form-control @error('remarks') is-invalid @enderror" 
                                          id="remarks" name="remarks" rows="2">{{ old('remarks') }}</textarea>
                                @error('remarks')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="reset" class="btn btn-outline-secondary me-md-2">
                                <i class="fas fa-undo me-1"></i> Reset
                            </button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i> Save Evacuee
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection