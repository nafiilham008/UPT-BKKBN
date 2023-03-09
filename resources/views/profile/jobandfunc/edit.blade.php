@extends('layouts.app')

@section('title', __('Edit Job and Function'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('Job and Function') }}</h3>
                    <p class="text-subtitle text-muted">
                        {{ __('Edit an job and function.') }}
                    </p>
                </div>

                <x-breadcrumb>
                    <li class="breadcrumb-item">
                        <a href="/">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('jobandfuncs.index') }}">{{ __('Job and Function') }}</a>
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
                            <form action="{{ route('jobandfuncs.update', $jobandfunc->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                {{-- @include('jobandfuncs.include.form') --}}
                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="title">{{ __('Title') }}</label>
                                            <input type="text" name="title" id="title"
                                                class="form-control @error('title') is-invalid @enderror"
                                                placeholder="{{ __('Insert Title') }}"
                                                value="{{ isset($jobandfunc) ? $jobandfunc->title : old('title') }}" required
                                                autofocus>
                                            @error('title')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description">{{ __('Description') }}</label>
                                            {{ csrf_field() }}
                                            <textarea id="summernote" name="description" class="form-control @error('description') is-invalid @enderror"
                                                placeholder="Insert description" required autofocus></textarea>
                                            @error('description')
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
    {{-- Summernote --}}
    <link rel="stylesheet" href="{{ asset('mazer') }}/css/pages/summernote.css">
    <link rel="stylesheet" href="{{ asset('mazer') }}/extensions/summernote/summernote-lite.css">
    {{-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet"> --}}

    {{-- Select --}}
    <link rel="stylesheet" href="{{ asset('mazer') }}/extensions/choices.js/public/assets/styles/choices.css">
    <style>
        .note-group-image-url {
            display: none;
        }
    </style>
@endpush

@push('js')
    {{-- Summernote --}}
    <script src="{{ asset('mazer') }}/extensions/jquery/jquery.min.js"></script>
    <script src="{{ asset('mazer') }}/extensions/summernote/summernote-lite.min.js"></script>
    <script src="{{ asset('mazer') }}/js/pages/summernote.js"></script>

    {{-- Select --}}
    <script src="{{ asset('mazer') }}/extensions/choices.js/public/assets/scripts/choices.js"></script>
    <script src="{{ asset('mazer') }}/js/pages/form-element-select.js"></script>

    <script>
        $('#summernote').summernote(
            'code',
            `{!! $jobandfunc->description !!}`

        );
    </script>
@endpush
