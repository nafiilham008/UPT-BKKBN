@extends('layouts.app')

@section('title', __('Add Profile Training'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('Profile Training') }}</h3>
                    <p class="text-subtitle text-muted">
                        {{ __('Add Profile Training.') }}
                    </p>
                </div>

                <x-breadcrumb>
                    <li class="breadcrumb-item">
                        <a href="{{ url('dashboard') }}">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('profiletrainings.index') }}">{{ __('Profile Training') }}</a>
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
                        <form action="{{ route('profiletrainings.store') }}" method="POST" enctype="multipart/form-data"
                            data-parsley-validate>
                            @csrf
                            @method('POST')
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <div class="form-group mandatory">
                                        <label for="type" class="form-label">{{ __('Type') }}</label>
                                        <input type="text" name="type" id="type"
                                            class="form-control @error('type') is-invalid @enderror"
                                            placeholder="e.g. Workshop" data-parsley-required="true"
                                            data-parsley-required-message="The Type field is required!" autofocus>
                                        @error('type')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mandatory">
                                        <label for="model" class="form-label">{{ __('Model') }}</label>
                                        <input type="text" name="model" id="model"
                                            class="form-control @error('model') is-invalid @enderror"
                                            placeholder="e.g. Training Model" data-parsley-required="true"
                                            data-parsley-required-message="The Model field is required!">
                                        @error('model')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mandatory">
                                        <label for="training_name" class="form-label">{{ __('Training Name') }}</label>
                                        <input type="text" name="training_name" id="training_name"
                                            class="form-control @error('training_name') is-invalid @enderror"
                                            placeholder="e.g. Training Name" data-parsley-required="true"
                                            data-parsley-required-message="The Training Name field is required!">
                                        @error('training_name')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mandatory">
                                        <label for="participant_requirement"
                                            class="form-label">{{ __('Participant Requirement') }}</label>
                                        <textarea name="participant_requirement" id="participant_requirement" rows="3"
                                            class="form-control @error('participant_requirement') is-invalid @enderror"
                                            placeholder="{{ __('Enter the participant requirement') }}" data-parsley-required="true"
                                            data-parsley-required-message="{{ __('The Participant Requirement field is required!') }}"></textarea>
                                        @error('participant_requirement')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="instructor_requirement"
                                            class="form-label">{{ __('Instructor Requirement') }}</label>
                                        <textarea name="instructor_requirement" id="instructor_requirement" rows="3"
                                            class="form-control @error('instructor_requirement') is-invalid @enderror"
                                            placeholder="{{ __('Enter the instructor requirement') }}"></textarea>
                                        @error('instructor_requirement')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group mandatory">
                                        <label for="description" class="form-label">{{ __('Description') }}</label>
                                        <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                            placeholder="e.g. Training Description" data-parsley-required="true"
                                            data-parsley-required-message="The Description field is required!"></textarea>
                                        @error('description')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group mandatory">
                                        <label for="training_goal" class="form-label">{{ __('Training Goal') }}</label>
                                        <textarea name="training_goal" id="training_goal" class="form-control @error('training_goal') is-invalid @enderror"
                                            placeholder="e.g. Training Goal" data-parsley-required="true"
                                            data-parsley-required-message="The Training Goal field is required!"></textarea>
                                        @error('training_goal')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                    <a href="{{ url()->previous() }}" class="btn btn-secondary">{{ __('Back') }}</a>

                                    <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                </div>
                            </div>
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
