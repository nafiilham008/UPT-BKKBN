@extends('layouts.app')

@section('title', __('Edit Content'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('Content') }}</h3>
                    <p class="text-subtitle text-muted">
                        {{ __('Edit an content.') }}
                    </p>
                </div>

                <x-breadcrumb>
                    <li class="breadcrumb-item">
                        <a href="/">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('posts.index') }}">{{ __('Content') }}</a>
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
                            <form action="{{ route('posts.update', $post->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                {{-- @include('posts.include.form') --}}
                                <div class="row mb-2">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label for="title">{{ __('Title') }}</label>
                                            <input type="text" name="title" id="title"
                                                class="form-control @error('title') is-invalid @enderror"
                                                placeholder="{{ __('Insert Title') }}"
                                                value="{{ isset($post) ? $post->title : old('title') }}" required autofocus>
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
                                                placeholder="Insert description" required autofocus></textarea> {{-- {!! $post->description !!} --}}
                                            @error('description')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <fieldset class="form-group">
                                            <label for="category">{{ __('Category') }}</label>
                                            <select class="form-select {{ $errors->has('category') ? ' has-error' : '' }}"
                                                id="category" name="category">
                                                @foreach ($data as $item)
                                                    <option value="{{ $item->id }}"
                                                        {{ $item->id == $post->categories->id ? 'selected' : '' }}>
                                                        {{ $item->label }}</option>
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
                                            <label for="status">{{ __('Status') }}</label>
                                            <select class="form-select" id="status" name="status">
                                                <option value="1" {{ $post->status == 1 ? 'selected' : '' }}>
                                                    Tampilkan</option>
                                                <option value="0" {{ $post->status == 0 ? 'selected' : '' }}>
                                                    Sembunyikan</option>
                                            </select>
                                        </fieldset>
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
            `{!! $post->description !!}`

        );
    </script>
    
@endpush
