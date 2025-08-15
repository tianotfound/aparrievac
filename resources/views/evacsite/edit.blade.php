@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body p-4">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="mb-0">
                            <i class="fas fa-edit text-primary me-2"></i>Edit Evacuation Site
                        </h5>
                        <a href="{{ route('manageevac.index') }}" class="btn btn-outline-secondary btn-sm">
                            <i class="fas fa-arrow-left me-1"></i> Back
                        </a>
                    </div>
                    
                    <form action="{{ route('evacsites.update', $evacsite->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row g-3">
                            <!-- Basic Information -->
                            <div class="col-md-6">
                                <div class="card mb-3 border-primary">
                                    <div class="card-header bg-primary text-white">
                                        <i class="fas fa-info-circle me-2"></i>Basic Information
                                    </div>
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label for="sitename" class="form-label">Site Name</label>
                                            <input type="text" class="form-control" id="sitename" name="sitename" 
                                                value="{{ old('sitename', $evacsite->sitename) }}" required>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="lat" class="form-label">Latitude</label>
                                                <input type="number" step="any" class="form-control" id="lat" name="lat" 
                                                    value="{{ old('lat', $evacsite->lat) }}" required min="-90" max="90" placeholder="e.g. 14.5995">
                                                <small class="text-muted">Between -90 and 90</small>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="lang" class="form-label">Longitude</label>
                                                <input type="number" step="any" class="form-control" id="lang" name="lang" 
                                                    value="{{ old('lang', $evacsite->lang) }}" required min="-180" max="180" placeholder="e.g. 120.9842">
                                                <small class="text-muted">Between -180 and 180</small>
                                            </div>
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label for="address" class="form-label">Address</label>
                                            <textarea class="form-control" id="address" name="address" rows="2" required>{{ old('address', $evacsite->address) }}</textarea>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="type" class="form-label">Type</label>
                                                <select class="form-select" id="type" name="type" required>
                                                    <option value="" disabled>Select type</option>
                                                    <option value="school" {{ old('type', $evacsite->type) == 'school' ? 'selected' : '' }}>School</option>
                                                    <option value="gymnasium" {{ old('type', $evacsite->type) == 'gymnasium' ? 'selected' : '' }}>Gymnasium</option>
                                                    <option value="community_center" {{ old('type', $evacsite->type) == 'community_center' ? 'selected' : '' }}>Community Center</option>
                                                    <option value="other" {{ old('type', $evacsite->type) == 'other' ? 'selected' : '' }}>Other</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="status" class="form-label">Status</label>
                                                <select class="form-select" id="status" name="status" required>
                                                    <option value="" disabled>Select status</option>
                                                    <option value="operational" {{ old('status', $evacsite->status) == 'operational' ? 'selected' : '' }}>Operational</option>
                                                    <option value="under_maintenance" {{ old('status', $evacsite->status) == 'under_maintenance' ? 'selected' : '' }}>Under Maintenance</option>
                                                    <option value="closed" {{ old('status', $evacsite->status) == 'closed' ? 'selected' : '' }}>Closed</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Capacity & Facilities -->
                            <div class="col-md-6">
                                <div class="card mb-3 border-success">
                                    <div class="card-header bg-success text-white">
                                        <i class="fas fa-chart-bar me-2"></i>Capacity & Facilities
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="capacity" class="form-label">Capacity</label>
                                                <input type="number" class="form-control" id="capacity" name="capacity" 
                                                    value="{{ old('capacity', $evacsite->capacity) }}" min="1" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="room" class="form-label">No. of Rooms</label>
                                                <input type="number" class="form-control" id="room" name="room" 
                                                    value="{{ old('room', $evacsite->room) }}" min="1" required>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="powerstatus" class="form-label">Power Status</label>
                                                <select class="form-select" id="powerstatus" name="powerstatus" required>
                                                    <option value="available" {{ old('powerstatus', $evacsite->powerstatus) == 'available' ? 'selected' : '' }}>Available</option>
                                                    <option value="unavailable" {{ old('powerstatus', $evacsite->powerstatus) == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="waterstatus" class="form-label">Water Status</label>
                                                <select class="form-select" id="waterstatus" name="waterstatus" required>
                                                    <option value="available" {{ old('waterstatus', $evacsite->waterstatus) == 'available' ? 'selected' : '' }}>Available</option>
                                                    <option value="unavailable" {{ old('waterstatus', $evacsite->waterstatus) == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3 border-warning">
                                    <div class="card-header bg-warning text-dark">
                                        <i class="fas fa-chart-bar me-2"></i>Food & Supplies
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="medicine_qty" class="form-label">Medicine Quantity</label>
                                                <input type="number" class="form-control" id="medicine_qty" name="medicine_qty" value="{{ old('medicine_qty', $evacsite->medicine_qty) }}" min="1" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="toiletries_qty" class="form-label">Toiletries Quantity</label>
                                                <input type="number" class="form-control" id="toiletries_qty" name="toiletries_qty" value="{{ old('toiletries_qty', $evacsite->toiletries_qty) }}" min="1" required>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="relief_goods_qty" class="form-label">Relief Goods Quantity</label>
                                                <input type="number" class="form-control" id="relief_goods_qty" name="relief_goods_qty" value="{{ old('relief_goods_qty', $evacsite->relief_goods_qty) }}" min="1" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="beddings_qty" class="form-label">Beddings Quantity</label>
                                                <input type="number" class="form-control" id="beddings_qty" name="beddings_qty" value="{{ old('beddings_qty', $evacsite->beddings_qty) }}" min="1" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Contact Information -->
                            <div class="col-12">
                                <div class="card border-info">
                                    <div class="card-header bg-info text-white">
                                        <i class="fas fa-user-tie me-2"></i>Contact Information
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="head" class="form-label">Head Person</label>
                                                <input type="text" class="form-control" id="head" name="head" 
                                                    value="{{ old('head', $evacsite->head) }}" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="contact" class="form-label">Contact Number</label>
                                                <input type="text" class="form-control" id="contact" name="contact" 
                                                    value="{{ old('contact', $evacsite->contact) }}" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Submit Button -->
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-primary px-4 py-2">
                                    <i class="fas fa-save me-2"></i>Update Evacuation Site
                                </button>
                                <a href="{{ route('evacsites.index') }}" class="btn btn-outline-secondary ms-2">
                                    <i class="fas fa-times me-2"></i>Cancel
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .card-header {
        font-weight: 600;
    }
    .form-label {
        font-weight: 500;
    }
    .card {
        transition: transform 0.2s;
    }
    .card:hover {
        transform: translateY(-2px);
    }
</style>
@endsection
