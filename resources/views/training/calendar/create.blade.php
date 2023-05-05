@extends('layouts.app')

@section('title', __('Add Training Calendar'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('Training Calendar') }}</h3>
                    <p class="text-subtitle text-muted">
                        {{ __('Add Training Calendar.') }}
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
                        <form action="{{ route('calendars.store') }}" method="POST" enctype="multipart/form-data"
                            data-parsley-validate>
                            @csrf
                            @method('POST')
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <div class="form-group mandatory">
                                        <label for="title" class="form-label">{{ __('Title') }}</label>
                                        <input type="text" name="title" id="title"
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
                                        <input type="text" name="link" id="link"
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
