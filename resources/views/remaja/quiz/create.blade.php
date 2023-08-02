@extends('layouts.app')

@section('title', __('Create Quiz'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('Quiz') }}</h3>
                    <p class="text-subtitle text-muted">
                        {{ __('Create a new quiz.') }}
                    </p>
                </div>

                <x-breadcrumb>
                    <li class="breadcrumb-item">
                        <a href="{{ url('dashboard') }}">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard.quizzes.index') }}">{{ __('Quiz') }}</a>
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
                            <form action="{{ route('dashboard.quizzes.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('POST')

                                {{-- @include('quizzes.include.form') --}}
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

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="url"
                                                class="form-label">{{ __('URL Video (Youtube)') }}</label>
                                            <input type="text" name="url" id="url"
                                                class="form-control @error('url') is-invalid @enderror"
                                                placeholder="{{ __('Insert url') }}" data-parsley-trigger="change"
                                                data-parsley-required="true"
                                                data-parsley-required-message="{{ __('Please enter a url') }}">
                                            @error('url')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="image" class="form-label">{{ __('Image') }}</label>
                                            <input class="form-control @error('image') is-invalid @enderror" type="file"
                                                id="image" name="image" accept="image/png, image/jpeg" required
                                                data-parsley-trigger="change" data-parsley-filemaxmegabytes="5"
                                                data-parsley-required-message="{{ __('Please select a image') }}"
                                                data-parsley-error-message="{{ __('Please upload an image file (JPEG, PNG) with a maximum size of 5MB') }}">
                                            @error('image')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <fieldset class="form-group">
                                            <label for="category_quiz_id"
                                                class="form-label">{{ __('Category Quiz') }}</label>
                                            <select class="form-select" id="category_quiz_id" name="category_quiz_id"
                                                data-parsley-trigger="change" data-parsley-required="true">
                                                <option value="">-- Select Category --</option>
                                                @foreach ($category as $item)
                                                    <option value="{{ $item->id }}">
                                                        {{ $item->title }}</option>
                                                @endforeach
                                            </select>
                                            @error('category_quiz_id')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </fieldset>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="description" class="form-label">{{ __('Description') }}</label>
                                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                                placeholder="{{ __('Insert Description') }}" data-parsley-trigger="change" rows="4"></textarea> {{-- {{ isset($quiz) ? $quiz->description : old('description') }} --}}
                                            @error('description')
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
    </div>
@endsection

@push('css')
    {{-- Select --}}
    <link rel="stylesheet" href="{{ asset('mazer') }}/extensions/choices.js/public/assets/styles/choices.css">
    <style>
        .note-group-image-url {
            display: none;
        }
    </style>
@endpush

@push('js')
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
