@extends('layouts.app')

@section('content')

<div class="container mb-3">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0 text-gray-800">
                <i class="fas fa-house-circle-exclamation me-2"></i>Evacuees Data
            </h5>
            <div class="d-flex ms-auto gap-2">
                <a href="{{ route('evacuee.create') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-users me-2"></i> Add Evacuee
                </a>
            </div>
        </div>
    </div>
</div>

@endsection