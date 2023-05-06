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
                                    <div class="form-group mandatory">
                                        <label for="type" class="form-label">{{ __('Type') }}</label>
                                        <input type="text" name="type" id="type"
                                            class="form-control @error('type') is-invalid @enderror"
                                            placeholder="e.g. Workshop" data-parsley-required="true"
                                            data-parsley-required-message="The Type field is required!"
                                            value="{{ $profileTraining->type }}" autofocus>
                                        @error('type')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mandatory">
                                        <label for="model" class="form-label">{{ __('Model') }}</label>
                                        <input type="text" name="model" id="model"
                                            class="form-control @error('model') is-invalid @enderror"
                                            placeholder="e.g. Training Model" data-parsley-required="true"
                                            data-parsley-required-message="The Model field is required!"
                                            value="{{ $profileTraining->model }}">
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
                                            class="form-control @error('training_name') is-invalid @enderror"
                                            placeholder="e.g. Training Name" data-parsley-required="true"
                                            data-parsley-required-message="The Training Name field is required!"
                                            value="{{ $profileTraining->training_name }}">
                                        @error('training_name')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mandatory">
                                        <label for="participant_requirement"
                                            class="form-label">{{ __('Participant
                                                                                                                                Requirement') }}</label>
                                        <textarea name="participant_requirement" id="participant_requirement" rows="3"
                                            class="form-control @error('participant_requirement') is-invalid @enderror"
                                            placeholder="{{ __('Enter the participant requirement') }}" data-parsley-required="true"
                                            data-parsley-required-message="{{ __('The Participant Requirement field is required!') }}">{{ $profileTraining->participant_requirement }}</textarea>
                                        @error('participant_requirement')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="instructor_requirement"
                                            class="form-label">{{ __('Instructor
                                                                                                                                Requirement') }}</label>
                                        <textarea name="instructor_requirement" id="instructor_requirement" rows="3"
                                            class="form-control @error('instructor_requirement') is-invalid @enderror"
                                            placeholder="{{ __('Enter the instructor requirement') }}">{{ $profileTraining->instructor_requirement }}</textarea>
                                        @error('instructor_requirement')
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
                                            data-parsley-required-message="The Description field is required!">{{ $profileTraining->description }}</textarea>
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
                                            data-parsley-required-message="The Training Goal field is required!">{{ $profileTraining->training_goal }}</textarea>
                                        @error('training_goal')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <a href="{{ url()->previous() }}" class="btn btn-secondary">{{ __('Back') }}</a>
                                    <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
