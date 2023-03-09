@extends('layouts.app')

@section('title', __('Add Employee'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('Employee') }}</h3>
                    <p class="text-subtitle text-muted">
                        {{ __('Add employee.') }}
                    </p>
                </div>

                <x-breadcrumb>
                    <li class="breadcrumb-item">
                        <a href="{{ url('dashboard') }}">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('employees.index') }}">{{ __('Employee') }}</a>
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
                            <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data" data-parsley-validate>
                                @csrf
                                @method('POST')
                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <div class="form-group mandatory">
                                            <label for="title" class="form-label">{{ __('Name') }}</label>
                                            <input type="text" name="name" id="name"
                                                class="form-control @error('name') is-invalid @enderror"
                                                placeholder="{{ __('Insert name') }}" data-parsley-required="true" data-parsley-required-message="Kolom Nama harus diisi!" autofocus>
                                            @error('name')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mandatory">
                                            <label for="photo" class="form-label">{{ __('Photo') }}</label>
                                            <input class="form-control" type="file" id="photo" name="photo"
                                                accept="image/png, image/jpeg">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mandatory">
                                            <label for="nip" class="form-label">{{ __('NIP') }}</label>
                                            <input type="number" name="nip" id="nip"
                                                class="form-control @error('nip') is-invalid @enderror"
                                                placeholder="{{ __('Insert NIP') }}" data-parsley-required="true" data-parsley-required-message="Kolom NIP harus diisi!">
                                            @error('nip')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="position" class="form-label">{{ __('Position') }}</label>
                                            <input type="text" name="position" id="position"
                                                class="form-control @error('position') is-invalid @enderror"
                                                placeholder="{{ __('Insert Position') }}" data-parsley-required="true" data-parsley-required-message="Kolom Jabatan harus diisi!">
                                            @error('position')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="birthdate" class="form-label">{{ __('Birthdate') }}</label>
                                            <input type="text" name="birthdate" id="birthdate"
                                                class="form-control @error('birthdate') is-invalid @enderror"
                                                placeholder="{{ __('Insert Birthdate') }}" data-parsley-required="true" data-parsley-required-message="Kolom Tanggal Lahir harus diisi!">
                                            @error('birthdate')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="education_history" class="form-label">{{ __('Education History') }}</label>
                                            <input type="text" name="education_history" id="education_history"
                                                class="form-control @error('education_history') is-invalid @enderror"
                                                placeholder="{{ __('Insert Education History') }}" data-parsley-required="true" data-parsley-required-message="Kolom Riwayat Pendidikan harus diisi!">
                                            @error('education_history')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="employment_history" class="form-label">{{ __('Employment History') }}</label>
                                            <input type="text" name="employment_history" id="employment_history"
                                                class="form-control @error('employment_history') is-invalid @enderror"
                                                placeholder="{{ __('Insert Employment History') }}" data-parsley-required="true" data-parsley-required-message="Kolom Riwayat Pekerjaan harus diisi!">
                                            @error('employment_history')
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
    <script src="{{ asset('mazer') }}/extensions/summernote/summernote-lite.min.js"></script>
    <script src="{{ asset('mazer') }}/js/pages/summernote.js"></script>

    {{-- Select --}}
    <script src="{{ asset('mazer') }}/extensions/choices.js/public/assets/scripts/choices.js"></script>
    <script src="{{ asset('mazer') }}/js/pages/form-element-select.js"></script>

    <script src="{{ asset('mazer') }}/extensions/parsleyjs/parsley.min.js"></script>
    <script src="{{ asset('mazer') }}/js/pages/parsley.js"></script>
@endpush
