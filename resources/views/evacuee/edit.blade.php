@extends('layouts.app')

@section('content')
<div class="container col-md-8 py-3">
    <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-4">
        <h4 class="fw-bold mb-0">
            <i class="fa-solid fa-user-pen text-warning me-2"></i>Edit Evacuee
        </h4>
        <a href="{{ route('evacuee.index') }}" class="btn btn-outline-secondary btn-sm">
            <i class="fa-solid fa-arrow-left me-1"></i> Back
        </a>
    </div>

    <form action="{{ route('evacuee.update', $evacuee->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Evacuation Info --}}
        <h6 class="text-primary fw-bold mb-3">
            <i class="fa-solid fa-building-shield me-2"></i>Evacuation Details
        </h6>
        <div class="row mb-4">
            <div class="col-md-6 mb-3">
                <label for="evacsites_id" class="form-label">
                    <i class="fa-solid fa-location-dot text-danger me-1"></i> Evacuation Site
                </label>
                <select class="form-select @error('evacsites_id') is-invalid @enderror" id="evacsites_id" name="evacsites_id" required>
                    <option value="" disabled>Select Site</option>
                    @foreach($evacsites as $site)
                        <option value="{{ $site->id }}" {{ old('evacsites_id', $evacuee->evacsites_id) == $site->id ? 'selected' : '' }}>
                            {{ $site->sitename }}
                        </option>
                    @endforeach
                </select>
                @error('evacsites_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label for="family_count" class="form-label">
                    <i class="fa-solid fa-users me-1"></i> Family Members
                </label>
                <input type="number" class="form-control @error('family_count') is-invalid @enderror" 
                       id="family_count" name="family_count" 
                       value="{{ old('family_count', $evacuee->family_count) }}" min="1" required>
                @error('family_count')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Personal Info --}}
        <h6 class="text-primary fw-bold mb-3">
            <i class="fa-solid fa-user me-2"></i>Personal Information
        </h6>
        <div class="row mb-3">
            <div class="col-md-4 mb-3">
                <label for="last_name" class="form-label">Last Name</label>
                <input type="text" class="form-control @error('last_name') is-invalid @enderror" 
                       id="last_name" name="last_name" 
                       value="{{ old('last_name', $evacuee->last_name) }}" required>
                @error('last_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label for="first_name" class="form-label">First Name</label>
                <input type="text" class="form-control @error('first_name') is-invalid @enderror" 
                       id="first_name" name="first_name" 
                       value="{{ old('first_name', $evacuee->first_name) }}" required>
                @error('first_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-4 mb-3">
                <label for="middle_name" class="form-label">Middle Name</label>
                <input type="text" class="form-control @error('middle_name') is-invalid @enderror" 
                       id="middle_name" name="middle_name" 
                       value="{{ old('middle_name', $evacuee->middle_name) }}">
                @error('middle_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row mb-4">
            <div class="col-md-3 mb-3">
                <label for="age" class="form-label"><i class="fa-solid fa-hourglass-half me-1"></i> Age</label>
                <input type="number" class="form-control @error('age') is-invalid @enderror" 
                       id="age" name="age" 
                       value="{{ old('age', $evacuee->age) }}" min="0" max="120" required>
                @error('age')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-3 mb-3">
                <label for="gender" class="form-label"><i class="fa-solid fa-venus-mars me-1"></i> Gender</label>
                <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender" required>
                    <option value="" disabled>Select</option>
                    <option value="Male" {{ old('gender', $evacuee->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                    <option value="Female" {{ old('gender', $evacuee->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                    <option value="Other" {{ old('gender', $evacuee->gender) == 'Other' ? 'selected' : '' }}>Other</option>
                </select>
                @error('gender')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="contact_number" class="form-label"><i class="fa-solid fa-phone me-1"></i> Contact</label>
                <input type="text" class="form-control @error('contact_number') is-invalid @enderror" 
                       id="contact_number" name="contact_number" 
                       value="{{ old('contact_number', $evacuee->contact_number) }}" required>
                @error('contact_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Address Info --}}
        <h6 class="text-primary fw-bold mb-3">
            <i class="fa-solid fa-house me-2"></i>Address Information
        </h6>
        <div class="row mb-4">
            <div class="col-md-6 mb-3">
                <label for="barangay" class="form-label">Barangay</label>
                <input type="text" class="form-control @error('barangay') is-invalid @enderror" 
                       id="barangay" name="barangay" 
                       value="{{ old('barangay', $evacuee->barangay) }}" required>
                @error('barangay')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="address" class="form-label">Complete Address</label>
                <input type="text" class="form-control @error('address') is-invalid @enderror" 
                       id="address" name="address" 
                       value="{{ old('address', $evacuee->address) }}" required>
                @error('address')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Health Info --}}
        <h6 class="text-primary fw-bold mb-3">
            <i class="fa-solid fa-heart-pulse me-2"></i>Health Information
        </h6>
        <div class="row mb-4">
            <div class="col-md-6 mb-3">
                <label for="medical_condition" class="form-label">Medical Condition (if any)</label>
                <textarea class="form-control @error('medical_condition') is-invalid @enderror" 
                          id="medical_condition" name="medical_condition" rows="2">{{ old('medical_condition', $evacuee->medical_condition) }}</textarea>
                @error('medical_condition')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6 mb-3">
                <label for="remarks" class="form-label">Remarks</label>
                <textarea class="form-control @error('remarks') is-invalid @enderror" 
                          id="remarks" name="remarks" rows="2">{{ old('remarks', $evacuee->remarks) }}</textarea>
                @error('remarks')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        {{-- Action Buttons --}}
        <div class="d-flex justify-content-end gap-2">
            <a href="{{ route('evacuee.index') }}" class="btn btn-outline-secondary">
                <i class="fa-solid fa-ban me-1"></i> Cancel
            </a>
            <button type="submit" class="btn btn-warning">
                <i class="fa-solid fa-save me-1"></i> Update Evacuee
            </button>
        </div>
    </form>
</div>
@endsection
