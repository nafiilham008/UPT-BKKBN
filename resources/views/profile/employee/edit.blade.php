@extends('layouts.app')

@section('title', __('Edit Employee'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('Employee') }}</h3>
                    <p class="text-subtitle text-muted">
                        {{ __('Edit an employee.') }}
                    </p>
                </div>

                <x-breadcrumb>
                    <li class="breadcrumb-item">
                        <a href="{{ url('dashboard') }}">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('employees.index') }}">{{ __('Employee') }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ __('Edit') }}
                    </li>
                </x-breadcrumb>
            </div>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('employees.update', $employee->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name">{{ __('Name') }}</label>
                                            <input type="text" name="name" id="name"
                                                class="form-control @error('name') is-invalid @enderror"
                                                placeholder="{{ __('Insert name') }}"
                                                value="{{ isset($employee) ? $employee->name : old('name') }}" required
                                                autofocus>
                                            @error('name')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-1 text-center">
                                        <div class="avatar avatar-xl">
                                            <img src="{{ asset('uploads/images/profile/employee-photo/' . $employee->photo) }}"
                                                alt="avatar">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="photo">{{ __('Photo') }}</label>
                                            <input class="form-control @error('photo') is-invalid @enderror" type="file"
                                                id="photo" name="photo" accept="image/png, image/jpeg">
                                            @error('photo')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nip">{{ __('NIP') }}</label>
                                            <input type="number" name="nip" id="nip"
                                                class="form-control @error('nip') is-invalid @enderror"
                                                value="{{ isset($employee) ? $employee->nip : old('nip') }}"
                                                placeholder="{{ __('Insert NIP') }}" required pattern="[0-9]+">
                                            @error('nip')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="position">{{ __('Position') }}</label>
                                            <input type="text" name="position" id="position"
                                                class="form-control @error('position') is-invalid @enderror"
                                                placeholder="{{ __('Insert position') }}"
                                                value="{{ isset($employee) ? $employee->position : old('position') }}"
                                                required autofocus>
                                            @error('position')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>


                                <a href="{{ url()->previous() }}" class="btn btn-secondary">{{ __('Back') }}</a>

                                <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('css')
    <style>
        .note-group-image-url {
            display: none;
        }
    </style>
@endpush
