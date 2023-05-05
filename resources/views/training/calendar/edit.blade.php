@extends('layouts.app')

@section('title', __('Edit Training Calendar'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('Training Calendar') }}</h3>
                    <p class="text-subtitle text-muted">
                        {{ __('Edit Training Calendar.') }}
                    </p>
                </div>

                <x-breadcrumb>
                    <li class="breadcrumb-item">
                        <a href="{{ url('dashboard') }}">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('calendars.index') }}">{{ __('Training Calendar') }}</a>
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
                        <form action="{{ route('calendars.update', $calendar->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <div class="form-group mandatory">
                                        <label for="title" class="form-label">{{ __('Title') }}</label>
                                        <input type="text" name="title" id="title" value="{{ $calendar->title }}"
                                            class="form-control @error('title') is-invalid @enderror"
                                            placeholder="e.g. Sosialisasi Stunting" data-parsley-required="true"
                                            data-parsley-required-message="The Title field is required!" autofocus>
                                        @error('title')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mandatory">
                                        <label for="title" class="form-label">{{ __('Link Calendar (drive)') }}</label>
                                        <input type="text" name="link" id="link" value="{{ $calendar->link }}"
                                            class="form-control @error('link') is-invalid @enderror"
                                            placeholder="e.g. https://drive.google.com/...."
                                            pattern="^https:\/\/drive\.google\.com\/.*$" data-parsley-required="true"
                                            data-parsley-required-message="The Link Calendar (drive) field is required!"
                                            data-parsley-pattern-message="The Link Calendar (drive) field should be a valid Google Drive link!"
                                            value="{{ old('link') }}" autofocus>
                                        @error('title')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>


                            </div>

                            <a href="{{ route('calendars.index') }}" class="btn btn-secondary">{{ __('Back') }}</a>

                            <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
