@extends('layouts.app')

@section('title', __('Edit Collaboration'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('Collaboration') }}</h3>
                    <p class="text-subtitle text-muted">
                        {{ __('Edit collaboration.') }}
                    </p>
                </div>

                <x-breadcrumb>
                    <li class="breadcrumb-item">
                        <a href="{{ url('dashboard') }}">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('collaborations.index') }}">{{ __('Collaboration') }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ __('Edit') }}
                    </li>
                </x-breadcrumb>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('collaborations.update', $collaboration->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-2">
                                <div class="col-md-1 text-center"
                                    style="display: flex; justify-content: center; align-items: center;">
                                    <div class="avatar avatar-xl">
                                        <img style="object-fit: cover"
                                            src="{{ asset('uploads/images/training/collaboration-logo/' . $collaboration->logo) }}"
                                            alt="avatar">
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group mandatory">
                                        <label for="logo" class="form-label">{{ __('Logo') }}</label>
                                        <input class="form-control" type="file" id="logo" name="logo"
                                            accept="image/png, image/jpeg" data-parsley-filemaxmegabytes="2"
                                            data-parsley-trigger="change" data-parsley-filemimetypes="image/jpeg,image/png"
                                            data-parsley-error-message="Please upload an image file (JPEG, PNG) with maximum size of 2MB">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mandatory">
                                        <label for="type" class="form-label">{{ __('Institution Name') }}</label>
                                        <input type="text" name="institution_name" id="institution_name"
                                            value="{{ $collaboration->institution_name }}"
                                            class="form-control @error('institution_name') is-invalid @enderror"
                                            placeholder="e.g. XYZ University" data-parsley-required="true"
                                            data-parsley-required-message="The Institution Name field is required!"
                                            autofocus>
                                        @error('institution_name')
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
@endsection
