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
                            <form action="{{ route('employees.store') }}" method="POST" enctype="multipart/form-data"
                                data-parsley-validate>
                                @csrf
                                @method('POST')
                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <div class="form-group mandatory">
                                            <label for="name" class="form-label">{{ __('Name') }}</label>
                                            <input type="text" name="name" id="name"
                                                class="form-control @error('name') is-invalid @enderror"
                                                placeholder="e.g. John Doe" data-parsley-required="true"
                                                data-parsley-required-message="The Name field is required!" autofocus>
                                            @error('name')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email" class="form-label">{{ __('Email') }}</label>
                                            <input type="email" name="email" id="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                placeholder="e.g. johndoe@example.com" data-parsley-type="email"
                                                data-parsley-trigger="blur"
                                                data-parsley-error-message="Invalid email format!">
                                            @error('email')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="place_of_birth"
                                                class="form-label">{{ __('Place of birth') }}</label>
                                            <input type="text" name="place_of_birth" id="place_of_birth"
                                                class="form-control @error('place_of_birth') is-invalid @enderror"
                                                placeholder="e.g. New York, USA" data-parsley-trigger="blur"
                                                value="{{ old('place_of_birth') }}">
                                            @error('place_of_birth')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="birthdate" class="form-label">{{ __('Birthdate') }}</label>
                                            <input type="date" name="birthdate" id="birthdate"
                                                class="form-control @error('birthdate') is-invalid @enderror"
                                                placeholder="e.g. 1990-01-01" min="1900-01-01" max="{{ date('Y-m-d') }}"
                                                data-parsley-trigger="blur">
                                            @error('birthdate')
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
                                                placeholder="e.g. Manager" data-parsley-required="true"
                                                data-parsley-required-message="The Position field is required!">
                                            @error('position')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nip" class="form-label">{{ __('NIP') }}</label>
                                            <input type="text" name="nip" id="nip"
                                                class="form-control @error('nip') is-invalid @enderror"
                                                placeholder="e.g. 1234567890" data-parsley-type="digits"
                                                data-parsley-maxlength="30" data-parsley-required="false"
                                                data-parsley-error-message="Please enter a valid NIP (only digits)">
                                            @error('nip')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address" class="form-label">{{ __('Address') }}</label>
                                            <textarea name="address" id="address" rows="3" class="form-control @error('address') is-invalid @enderror"
                                                placeholder="{{ __('e.g. 123 Main St, Anytown, USA') }}" data-parsley-trigger="blur"
                                                data-parsley-required="false">{{ old('address') }}</textarea>
                                            @error('address')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="type_employee"
                                                class="form-label">{{ __('Type of Employee') }}</label>
                                            <select class="form-select" name="type_employee" id="type_employee"
                                                class="form-control @error('type_employee') is-invalid @enderror"
                                                data-parsley-required="true"
                                                data-parsley-required-message="The Type of Employee field is required!">
                                                <option value="">-- Select Type of Employee --</option>
                                                <option value="PNS"
                                                    {{ old('type_employee') == 'PNS' ? 'selected' : '' }}>PNS</option>
                                                <option value="Non PNS"
                                                    {{ old('type_employee') == 'Non PNS' ? 'selected' : '' }}>Non PNS
                                                </option>
                                            </select>
                                            @error('type_employee')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="phone_number" class="form-label">{{ __('Phone Number') }}</label>
                                            <input type="tel" name="phone_number" id="phone_number"
                                                class="form-control @error('phone_number') is-invalid @enderror"
                                                placeholder="e.g. +6281234567890" pattern="[+][0-9]{12,15}"
                                                data-parsley-error-message="Please enter a valid phone number (+ followed by 12-14 digits)">
                                            @error('phone_number')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="photo" class="form-label">{{ __('Photo') }}</label>
                                            <input class="form-control" type="file" id="photo" name="photo"
                                                accept="image/png, image/jpeg" data-parsley-filemaxmegabytes="2"
                                                data-parsley-trigger="change"
                                                data-parsley-filemimetypes="image/jpeg,image/png"
                                                data-parsley-error-message="Please upload an image file (JPEG, PNG) with a maximum size of 2MB">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="awards">{{ __('Awards') }}</label>
                                            <textarea id="summernote-awards" name="awards" class="form-control @error('awards') is-invalid @enderror"
                                                placeholder="Insert awards" autofocus>{{ old('awards') }}</textarea>
                                            @error('awards')
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
        {{-- Summernote --}}
        <link rel="stylesheet" href="{{ asset('mazer') }}/css/pages/summernote.css">
        <link rel="stylesheet" href="{{ asset('mazer') }}/extensions/summernote/summernote-lite.css">

        <link rel="stylesheet" href="{{ asset('mazer') }}/extensions/choices.js/public/assets/styles/choices.css">


        <link rel="stylesheet" href="{{ asset('mazer') }}/extensions/simple-datatables/style.css">
        <link rel="stylesheet" href="{{ asset('mazer') }}/css/pages/simple-datatables.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
            integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
            crossorigin="anonymous" referrerpolicy="no-referrer" />

        <style>
            .note-group-image-url {
                display: none;
            }
        </style>
    @endpush

    @push('js')
        <script>
            $(document).ready(function() {
                $('#nip').on('input', function() {
                    if (this.value.length > 30) {
                        this.value = this.value.slice(0, 30);
                    }
                });

                var phoneInput = document.getElementById('phone_number');
                phoneInput.addEventListener('input', function(event) {
                    if (this.value.length > 15) {
                        this.value = this.value.slice(0, 15);
                    }
                    this.value = this.value.replace(/[^0-9+-]/g, '');
                });


                // Summernote
                $("#summernote-awards").summernote({
                    tabsize: 2,
                    height: 300,
                    maximumImageFileSize: 204800,
                    // maximumFileSize: 1048576
                    toolbar: [
                        ["style", ["bold", "italic", "underline", "clear", "fontname", "fontsize"]],
                        ["font", ["strikethrough", "superscript", "subscript"]],
                        ["color", ["color"]],
                        ["para", ["ul", "ol", "paragraph"]],
                        ["help", ["help"]],
                    ],
                    fontNames: [
                        "Arial",
                        "Arial Black",
                        "Comic Sans MS",
                        "Courier New",
                        "sans-serif",
                        "Roboto",
                    ],
                    fontSizes: [
                        "8",
                        "9",
                        "10",
                        "11",
                        "12",
                        "14",
                        "16",
                        "18",
                        "20",
                        "22",
                        "24",
                        "36",
                    ],

                    // callbacks: {
                    //     onMediaDelete : function(target) {
                    //         var mpath = $(target[0]).attr('src').replace("..", "");
                    //         $('#summernote').val(mpath);
                    //         },
                    // },
                });
            });
        </script>




        {{-- Summernote --}}
        <script src="{{ asset('mazer') }}/extensions/summernote/summernote-lite.min.js"></script>
        <script src="{{ asset('mazer') }}/js/pages/summernote.js"></script>

        {{-- Select --}}
        <script src="{{ asset('mazer') }}/extensions/choices.js/public/assets/scripts/choices.js"></script>
        <script src="{{ asset('mazer') }}/js/pages/form-element-select.js"></script>

        <script src="{{ asset('mazer') }}/extensions/parsleyjs/parsley.min.js"></script>
        <script src="{{ asset('mazer') }}/js/pages/parsley.js"></script>
    @endpush
