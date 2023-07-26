@extends('layouts.app')

@section('title', __('Add Collaboration'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('Collaboration') }}</h3>
                    <p class="text-subtitle text-muted">
                        {{ __('Add collaboration.') }}
                    </p>
                </div>

                <x-breadcrumb>
                    <li class="breadcrumb-item">
                        <a href="{{ url('dashboard') }}">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard.collaborations.index') }}">{{ __('Collaboration') }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ __('Create') }}
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
                        <form action="{{ route('dashboard.collaborations.store') }}" method="POST" enctype="multipart/form-data"
                            data-parsley-validate>
                            @csrf
                            @method('POST')
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="logo" class="form-label">{{ __('Logo') }}</label>
                                        <input class="form-control" type="file" id="logo" name="logo"
                                            accept="image/png, image/jpeg" data-parsley-filemaxmegabytes="2"
                                            data-parsley-trigger="change" data-parsley-filemimetypes="image/jpeg,image/png"
                                            data-parsley-error-message="Please upload an image file (JPEG, PNG) with a maximum size of 2MB">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mandatory">
                                        <label for="type" class="form-label">{{ __('Institution Name') }}</label>
                                        <input type="text" name="institution_name" id="institution_name"
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

                            <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </section>

@endsection

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@push('js')
    <script src="{{ asset('mazer') }}/extensions/parsleyjs/parsley.min.js"></script>
    <script src="{{ asset('mazer') }}/js/pages/parsley.js"></script>
    <script>
        $(document).ready(function() {
            $('form').parsley();
        });
    </script>
@endpush
