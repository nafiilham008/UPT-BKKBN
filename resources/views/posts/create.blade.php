@extends('layouts.app')

@section('title', __('Create Content'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('Posts') }}</h3>
                    <p class="text-subtitle text-muted">
                        {{ __('Create a new Posts.') }}
                    </p>
                </div>

                <x-breadcrumb>
                    <li class="breadcrumb-item">
                        <a href="{{ url('dashboard') }}">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard.posts.index') }}">{{ __('Posts') }}</a>
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
                            <form action="{{ route('dashboard.posts.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('POST')

                                {{-- @include('posts.include.form') --}}
                                <div class="row mb-2">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="title" class="form-label">{{ __('Title') }}</label>
                                            <input type="text" name="title" id="title"
                                                class="form-control @error('title') is-invalid @enderror"
                                                placeholder="{{ __('Insert Title') }}" data-parsley-trigger="change"
                                                data-parsley-required="true"
                                                data-parsley-required-message="{{ __('Please enter a title') }}">
                                            @error('title')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="thumbnail" class="form-label">{{ __('Thumbnail') }}</label>
                                            <input class="form-control @error('thumbnail') is-invalid @enderror"
                                                type="file" id="thumbnail" name="thumbnail"
                                                accept="image/png, image/jpeg" required data-parsley-trigger="change"
                                                data-parsley-filemaxmegabytes="2"
                                                data-parsley-required-message="{{ __('Please select a thumbnail') }}"
                                                data-parsley-error-message="{{ __('Please upload an image file (JPEG, PNG) with a maximum size of 2MB') }}">
                                            @error('thumbnail')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="created_at" class="form-label">{{ __('Publication Date') }}</label>
                                            <input type="datetime-local" name="created_at" id="created_at"
                                                class="form-control @error('created_at') is-invalid @enderror"
                                                placeholder="{{ __('Insert Publication Date') }}"
                                                data-parsley-trigger="change" data-parsley-required="false">
                                            @error('created_at')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description" class="form-label">{{ __('Description') }}</label>
                                            <textarea id="summernote" name="description" class="form-control @error('description') is-invalid @enderror"
                                                placeholder="Insert description" required autofocus data-parsley-trigger="change" data-parsley-required="true"
                                                data-parsley-required-message="{{ __('Please enter a description') }}"></textarea>
                                            @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <fieldset class="form-group">
                                            <label for="category" class="form-label">{{ __('Category') }}</label>
                                            <select class="form-select" id="category" name="category"
                                                data-parsley-trigger="change" data-parsley-required="true">
                                                @foreach ($data as $item)
                                                    <option value="{{ $item->id }}">{{ $item->label }}</option>
                                                @endforeach
                                            </select>
                                            @error('category')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </fieldset>
                                    </div>

                                    <div class="col-md-6">
                                        <fieldset class="form-group {{ $errors->has('status') ? ' has-error' : '' }}">
                                            <label for="status" class="form-label">{{ __('Status') }}</label>
                                            <select class="form-select" id="status" name="status"
                                                data-parsley-trigger="change" data-parsley-required="true">
                                                <option value="1" @if (old('status') == 1) selected @endif>
                                                    Tampilkan</option>
                                                <option value="0" @if (old('status') == 0) selected @endif>
                                                    Sembunyikan</option>
                                            </select>
                                            @error('status')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </fieldset>
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
    </div>
@endsection

@push('css')
    {{-- Summernote --}}
    <link rel="stylesheet" href="{{ asset('mazer') }}/css/pages/summernote.css">
    <link rel="stylesheet" href="{{ asset('mazer') }}/extensions/summernote/summernote-lite.css">

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

    <script src="{{ asset('mazer') }}/extensions/parsleyjs/parsley.min.js"></script>
    <script src="{{ asset('mazer') }}/js/pages/parsley.js"></script>
    <script>
        $(document).ready(function() {
            $('form').parsley();
        });
    </script>
@endpush
