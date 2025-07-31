@extends('layouts.app')

@section('content')

    <div class="container mt-5">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-9">

                @if (session('status'))
                    <div class="alert alert-success">{{ session('status') }}</div>
                @endif

                <div class="card">
                    <div class="card-header fw-bold">
                        <h7>Role : {{ $role->name }}
                            <a href="{{ url('roles') }}" class="btn btn-danger btn-sm float-end">Back</a>
                        </h7>
                    </div>
                    <div class="card-body">

                        <form action="{{ url('roles/'.$role->id.'/give-permissions') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                @error('permission')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror

                                <label for="">Permissions</label>
                                <hr>
                                <div class="row">
                                    @foreach ($permissions as $permission)
                                    <div class="col-md-3">
                                        <label>
                                            <input
                                                type="checkbox"
                                                name="permission[]"
                                                value="{{ $permission->name }}"
                                                {{ in_array($permission->id, $rolePermissions) ? 'checked':'' }}
                                            />
                                            {{ $permission->name }}
                                        </label>
                                    </div>
                                    @endforeach
                                </div>

                            </div>
                            <hr>
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