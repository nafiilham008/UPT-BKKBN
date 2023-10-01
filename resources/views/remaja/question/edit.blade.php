@extends('layouts.app')

@section('title', __('Edit Question'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('Question') }}</h3>
                    <p class="text-subtitle text-muted">
                        {{ __('Edit an question.') }}
                    </p>
                </div>

                <x-breadcrumb>
                    <li class="breadcrumb-item">
                        <a href="{{ url('dashboard') }}">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard.questions', $question->quiz_id) }}">{{ __('Question') }}</a>
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
                            <form
                                action="{{ route('dashboard.questions.update', ['id' => $question->quiz_id, 'question_id' => $question->id]) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                {{-- @include('questionzes.include.form') --}}
                                <div class="row mb-2">
                                    <div class="col-md-12">
                                        <div class="form-group mandatory">
                                            <label for="question" class="form-label">{{ __('Question') }}</label>
                                            <input type="text" name="question" id="question"
                                                value="{{ isset($question) ? $question->question : old('question') }}"
                                                class="form-control @error('question') is-invalid @enderror"
                                                placeholder="{{ __('Insert question question') }}"
                                                data-parsley-required="true"
                                                data-parsley-required-message="Question must be fill!" autofocus>
                                            @error('question')
                                                <span class="invalid-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                    @if (!empty($question->image))
                                        <div class="col-md-1 text-center">
                                            <div class="avatar avatar-xl">
                                                <img src="{{ asset('storage/' . $question->image) }}" alt="avatar">
                                            </div>
                                        </div>
                                        <div class="col-md-11">
                                        @else
                                            <div class="col-md-12">
                                    @endif
                                    <div class="form-group">
                                        <label for="image" class="form-label">{{ __('Image') }}</label>
                                        <input class="form-control @error('image') is-invalid @enderror" type="file"
                                            id="image" name="image" accept="image/png, image/jpeg"
                                            data-parsley-trigger="change" data-parsley-filemaxmegabytes="5"
                                            data-parsley-error-message="{{ __('Please upload an image file (JPEG, PNG) with a maximum size of 5MB') }}">
                                        @error('image')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="answerType">{{ __('Type of Answer') }}</label>
                                        <select name="answerType" id="answerType" class="form-control">
                                            <option value="single">{{ __('Single Choice') }}</option>
                                            <option value="multiple">{{ __('Multiple Choice') }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="description" class="form-label">{{ __('Description') }}</label>
                                        <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                            placeholder="{{ __('Insert Description') }}" data-parsley-trigger="change" data-parsley-required="false"
                                            rows="4">{!! isset($question) ? $question->description : old('description') !!}</textarea>
                                        @error('description')
                                            <span class="text-danger">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>{{ __('Options') }}</label>
                                        <div id="options-container">
                                            @php
                                                $options = !empty($question->options) ? json_decode($question->options, true) : [];
                                            @endphp
                                            @foreach ($options as $index => $option)
                                                <div class="options-input">
                                                    <div class="input-group mb-2">
                                                        <input name="options[{{ $index }}]" id="options"
                                                            type="text" class="form-control" placeholder="Insert option"
                                                            value="{{ $option['value'] }}">
                                                        <div class="form-check ms-2 me-2 mt-2">
                                                            <input type="hidden"
                                                                name="correct_answers[{{ $index }}]" value="0">
                                                            <input name="correct_answers[{{ $index }}]"
                                                                id="correct_answers" type="checkbox"
                                                                class="form-check-input" value="1"
                                                                {{ $option['is_correct'] ? 'checked' : '' }}>
                                                            <label class="form-check-label">Correct</label>
                                                        </div>
                                                        <button type="button"
                                                            class="btn btn-danger remove-option">Remove</button>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                        <button type="button" id="add-option" class="btn btn-success btn-sm mt-2">Add
                                            Option</button>
                                        <button type="button" id="remove-all-options"
                                            class="btn btn-danger btn-sm mt-2">Remove All Options</button>
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

    <script src="{{ asset('mazer') }}/extensions/parsleyjs/parsley.min.js"></script>
    <script src="{{ asset('mazer') }}/js/pages/parsley.js"></script>
    <script>
        $(document).ready(function() {
            $('form').parsley();
        });
    </script>
    <script>
        $(document).ready(function() {

            function handleCheckboxChange() {
                let hiddenInput = $(this).prev('input[type="hidden"]');
                let answerType = $('#answerType').val();

                if (answerType === 'single') {
                    if (this.checked) {
                        $('input[type="checkbox"]').not(this).prop('checked', false);
                    }
                }

                if (this.checked) {
                    hiddenInput.attr('disabled', 'disabled');
                } else {
                    hiddenInput.removeAttr('disabled');
                }
            }


            var checkedCount = $('input[type="checkbox"]:checked').length;

            if (checkedCount > 1) {
                $('#answerType').val('multiple');
            } else {
                $('#answerType').val('single');
            }

            $('input[type="checkbox"]').change(handleCheckboxChange);

            $('#add-option').click(function() {
                var inputField = `
        <div class="options-input">
            <div class="input-group mb-2">
                <input name="options[]" type="text" class="form-control" placeholder="Insert option">
                <div class="form-check ms-2 me-2 mt-2">
                    <input type="hidden" name="correct_answers[]" value="0">
                    <input name="correct_answers[]" type="checkbox" class="form-check-input" value="1">
                    <label class="form-check-label">Correct</label>
                </div>
                <button type="button" class="btn btn-danger remove-option">Remove</button>
            </div>
        </div>`;

                var newOption = $(inputField);
                $('#options-container').append(newOption);

                newOption.find('input[type="checkbox"]').change(handleCheckboxChange);
            });

            $('#options-container').on('click', '.remove-option', function() {
                $(this).closest('.options-input').remove();
            });

            $("#remove-all-options").click(function() {
                $("#options-container").empty();
            });

            $('#answerType').change(function() {
                if ($(this).val() === 'single') {
                    $('input[type="checkbox"]').prop('checked', false);
                }
            });
        });
    </script>
@endpush
