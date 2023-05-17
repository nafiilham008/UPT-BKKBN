@extends('layouts.app')

@section('title', __('Edit Profile Training'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('Profile Training') }}</h3>
                    <p class="text-subtitle text-muted">
                        {{ __('Edit Profile Training.') }}
                    </p>
                </div>

                <x-breadcrumb>
                    <li class="breadcrumb-item">
                        <a href="{{ url('dashboard') }}">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('profiletrainings.index') }}">{{ __('Profile Training') }}</a>
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
                        <form action="{{ route('profiletrainings.update', $profileTraining->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <fieldset class="form-group {{ $errors->has('type') ? ' has-error' : '' }}">
                                        <label for="type" class="form-label">{{ __('Type Training') }}</label>
                                        <select class="form-select" id="type" name="type">
                                            <option value="">-- Select Type of Training --</option>
                                            <option value="Pelatihan Dasar"
                                                @if (old('type', $profileTraining->type) === 'Pelatihan Dasar') selected @endif>
                                                Pelatihan Dasar</option>
                                            <option value="Pelatihan Teknis"
                                                @if (old('type', $profileTraining->type) === 'Pelatihan Teknis') selected @endif>
                                                Pelatihan Teknis</option>
                                            <option value="Pelatihan Manajerial"
                                                @if (old('type', $profileTraining->type) === 'Pelatihan Manajerial') selected @endif>
                                                Pelatihan Manajerial</option>
                                        </select>
                                        @error('type')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </fieldset>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mandatory">
                                        <label for="model" class="form-label">{{ __('Model') }}</label>
                                        <input type="text" name="model" id="model"
                                            value="{{ $profileTraining->model }}"
                                            class="form-control @error('model') is-invalid @enderror"
                                            placeholder="e.g. Online Class" data-parsley-required="true"
                                            data-parsley-required-message="The Model field is required!">
                                        @error('model')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mandatory">
                                        <label for="training_name" class="form-label">{{ __('Training Name') }}</label>
                                        <input type="text" name="training_name" id="training_name"
                                            value="{{ $profileTraining->training_name }}"
                                            class="form-control @error('training_name') is-invalid @enderror"
                                            placeholder="e.g. Pelatihan dasar" data-parsley-required="true"
                                            data-parsley-required-message="The Training Name field is required!">
                                        @error('training_name')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group mandatory">
                                        <label for="description" class="form-label">{{ __('Description') }}</label>
                                        <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                            placeholder="e.g. Training Description" data-parsley-required="true"
                                            data-parsley-required-message="The Description field is required!">{{ old('description', $profileTraining->description) }}</textarea>
                                        @error('description')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group mandatory">
                                        <label for="training_goal" class="form-label">{{ __('Training Goal') }}</label>
                                        <textarea name="training_goal" id="training_goal" class="form-control @error('training_goal') is-invalid @enderror"
                                            placeholder="e.g. Training Goal" data-parsley-required="true"
                                            data-parsley-required-message="The Training Goal field is required!">{{ old('training_goal', $profileTraining->training_goal) }}</textarea>
                                        @error('training_goal')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <a href="{{ url()->previous() }}" class="btn btn-secondary">{{ __('Back') }}</a>

                                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
