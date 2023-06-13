@extends('layouts.app')

@section('title', __('Add Public Information'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('Public Information') }}</h3>
                    <p class="text-subtitle text-muted">
                        {{ __('Add public information.') }}
                    </p>
                </div>

                <x-breadcrumb>
                    <li class="breadcrumb-item">
                        <a href="{{ url('dashboard') }}">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard.public-informations.index') }}">{{ __('Public Information') }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ __('Create') }}
                    </li>
                </x-breadcrumb>
            </div>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('dashboard.public-informations.store') }}" method="POST" enctype="multipart/form-data"
                                data-parsley-validate>
                                @csrf
                                @method('POST')
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group mandatory">
                                            <label for="title" class="form-label">{{ __('Title') }}</label>
                                            <input type="text" name="title" id="title"
                                                class="form-control @error('title') is-invalid @enderror"
                                                placeholder="e.g. Beasiswa" data-parsley-required="true"
                                                data-parsley-required-message="The Title field is required!" autofocus>
                                            @error('title')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="type_public_information"
                                                class="form-label">{{ __('Type of Public Information') }}</label>
                                            <select class="form-select" name="type_public_information" id="type_public_information"
                                                class="form-control @error('type_public_information') is-invalid @enderror"
                                                data-parsley-required="true"
                                                data-parsley-required-message="The Type of Public Information field is required!">
                                                <option value="">-- Select Type of Public Information --</option>
                                                @foreach ($typePublicInformation as $type)
                                                    <option value="{{ $type['id'] }}"
                                                        {{ old('typePublicInformation') == $type['id'] ? 'selected' : '' }}>
                                                        {{ $type['label'] }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('type_public_information')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="link" class="form-label">{{ __('Link') }}</label>
                                            <input type="text" name="link" id="link"
                                                class="form-control @error('link') is-invalid @enderror"
                                                placeholder="e.g. https://example.com" data-parsley-required="true"
                                                data-parsley-required-message="The Link field is required!"
                                                data-parsley-pattern="^(https?://)[\w.-]+\.[a-zA-Z]{2,}(\/\S*)?$"
                                                data-parsley-pattern-message="Please enter a valid URL starting with 'http://', or 'https://'">
                                            @error('link')
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
    @endpush
