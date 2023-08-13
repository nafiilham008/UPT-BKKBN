@extends('layouts.app')

@section('title', __('Edit Training'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('Training') }}</h3>
                    <p class="text-subtitle text-muted">
                        {{ __('Edit an training.') }}
                    </p>
                </div>

                <x-breadcrumb>
                    <li class="breadcrumb-item">
                        <a href="{{ url('dashboard') }}">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard.kediklatans.index') }}">{{ __('Training') }}</a>
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
                            <form action="{{ route('dashboard.kediklatans.update', $kediklatan->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group mandatory">
                                            <label for="title" class="form-label">{{ __('Title') }}</label>
                                            <input type="text" name="title" id="title"
                                                value="{{ $kediklatan->title }}"
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
                                    @if ($cekPhoto == true)
                                        @if (isset($kediklatan->photo))
                                            <div class="col-md-1 text-center"
                                                style="display: flex; justify-content: center; align-items: center;">
                                                <div class="avatar avatar-xl">
                                                    <img style="object-fit: cover"
                                                        src="{{ asset('storage/' . $kediklatan->photo) }}"
                                                        alt="avatar">
                                                </div>
                                            </div>
                                        @endif

                                        <div class="{{ empty($kediklatan->photo) ? 'col-md-6' : 'col-md-5' }}">
                                            <div class="form-group">
                                                <label for="photo" class="form-label">{{ __('Photo') }}</label>
                                                <input class="form-control" type="file" id="photo" name="photo"
                                                    accept="image/png, image/jpeg" data-parsley-filemaxmegabytes="2"
                                                    data-parsley-trigger="change"
                                                    data-parsley-filemimetypes="image/jpeg,image/png"
                                                    data-parsley-error-message="Please upload an image file (JPEG, PNG) with a maximum size of 2MB">
                                                @error('photo')
                                                    <span class="text-danger">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-md-1 text-center d-none"
                                            style="display: flex; justify-content: center; align-items: center;">
                                            <div class="avatar avatar-xl">
                                                <img style="object-fit: cover"
                                                    src="{{ asset('storage/' . $kediklatan->photo) }}"
                                                    alt="avatar">
                                            </div>
                                        </div>
                                        <div class="col-md-5 d-none">F
                                            <div class="form-group">
                                                <label for="photo" class="form-label">{{ __('Photo') }}</label>
                                                <input class="form-control" type="file" id="photo" name="photo"
                                                    accept="image/png, image/jpeg" data-parsley-filemaxmegabytes="2"
                                                    data-parsley-trigger="change"
                                                    data-parsley-filemimetypes="image/jpeg,image/png"
                                                    data-parsley-error-message="Please upload an image file (JPEG, PNG) with a maximum size of 2MB">
                                                @error('photo')
                                                    <span class="text-danger">
                                                        {{ $message }}
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description" class="form-label">{{ __('Description') }}</label>
                                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                                rows="4" placeholder="Enter description" data-parsley-required="true"
                                                data-parsley-required-message="The Description field is required!">{{ $kediklatan->description }}</textarea>
                                            @error('description')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="link" class="form-label">{{ __('Link') }}</label>
                                            <input type="text" name="link" id="link"
                                                value="{{ $kediklatan->link }}"
                                                class="form-control @error('link') is-invalid @enderror"
                                                placeholder="e.g. https://example.com"
                                                data-parsley-required="{{ $kediklatan->link ? 'true' : 'false' }}"
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

                                <a href="{{ route('dashboard.kediklatans.index') }}"
                                    class="btn btn-secondary">{{ __('Back') }}</a>

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
