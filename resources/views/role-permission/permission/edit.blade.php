@extends('layouts.app')

@section('content')

    <div class="container mt-5">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-6">

                @if ($errors->any())
                <ul class="alert alert-warning">
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
                @endif

                <div class="card">
                    <div class="card-header">
                        <h7>Edit Permission
                            <a href="{{ url('permissions') }}" class="btn btn-danger btn-sm float-end">Back</a>
                        </h7>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('permissions/'.$permission->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="">Permission Name</label>
                                <input type="text" name="name" value="{{ $permission->name }}" class="form-control" />
                            </div>
                            <div class="mb-3 d-grid">
                                <button type="submit" class="btn btn-primary btn-sm">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection