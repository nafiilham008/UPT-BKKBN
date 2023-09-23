@extends('layouts.app')

@section('title', __('Question - ' . $question->title))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('Question') }}</h3>
                    <p class="text-subtitle text-muted">
                        {{ __('Below is a list of all question.') }}
                    </p>
                </div>
                <x-breadcrumb>
                    <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('dashboard.quizzes.index') }}">{{ __('Quiz') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Question') }}</li>
                </x-breadcrumb>
            </div>
        </div>

        <section class="section">
            <x-alert></x-alert>

            @can('question create')
                <div class="d-flex justify-content-end">
                    <button id="add-question" class="btn btn-primary mb-3" data-bs-toggle="modal"
                        data-bs-target="#exampleModalScrollable">
                        <i class="fas fa-plus"></i>
                        {{ __('Add question') }}
                    </button>
                </div>
            @endcan

            <div class="row">
                <div class="col-md-12">
                    <div class="card border">
                        <div class="card-body">
                            <div class="table-responsive p-1">
                                <table class="table table-striped" id="table-question" width="100%">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Quiz Title') }}</th>
                                            <th>{{ __('User') }}</th>
                                            <th>{{ __('Question') }}</th>
                                            <th>{{ __('Image') }}</th>
                                            <th>{{ __('Options') }}</th>
                                            <th>{{ __('Created At') }}</th>
                                            <th>{{ __('Update At') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            {{-- create --}}
                            @include('remaja.question.include.modal-question-create')

                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.0/datatables.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@push('js')
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.0/datatables.min.js"></script>
    <script>
        $(document).ready(function() {

            $('#table-question').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('dashboard.questions.datatable', $question->id) }}",
                columns: [{
                        data: 'quiz.title',
                        name: 'quiz_id'
                    },
                    {
                        data: 'users.name',
                        name: 'user_id',
                        defaultContent: '-'
                    },
                    {
                        data: 'question',
                        name: 'question',
                        defaultContent: '-'
                    },
                    {
                        data: 'image',
                        name: 'image',
                        defaultContent: '-',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, full, meta) {
                            if (data && data !== '-') {
                                return `<div class="avatar">
                        <img src="${data}" alt="avatar">
                    </div>`;
                            } else {
                                return data;
                            }
                        }
                    },
                    {
                        data: 'options',
                        name: 'options',
                        defaultContent: '-',
                        render: function(data, type, full, meta) {
                            if (data) {
                                try {
                                    // menyesuaikan format json
                                    let cleanedData = data.replace(/&quot;/g, '"');
                                    let parsedData = JSON.parse(cleanedData);
                                    return parsedData.map(option => {
                                        let isCorrect = option.is_correct === '1' || option
                                            .is_correct === true;
                                        let label = isCorrect ?
                                            '<span style="color:#198754;"><strong>benar</strong></span>' :
                                            '<span style="color:#dc3545;"><strong>salah</strong></span>';
                                        return `&bull; ${option.value} (${label})`;
                                    }).join('<br>');
                                } catch (e) {
                                    console.error(e);
                                    return data;
                                }
                            } else {
                                return '-';
                            }
                        }
                    },

                    {
                        data: 'created_at',
                        name: 'created_at',
                        defaultContent: '-'
                    },
                    {
                        data: 'updated_at',
                        name: 'updated_at',
                        defaultContent: '-'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                drawCallback: function(settings) {
                    // menghilangkan notifikasi
                    $('.alert').hide();
                }
            });

            $('#exampleModalScrollable').on('shown.bs.modal', function() {
                $('#options-container input[type="checkbox"]').prop('checked', false);
                $('#options-container input[name^="correct_answers"]').val('0');
                $('#options-container .options-input:first .remove-option').attr('disabled', true);
            });

            function limitCheckboxBasedOnAnswerType() {
                let answerType = $('#answerType').val();

                if (answerType === 'single') {
                    if (this.checked) {
                        $('input[type="checkbox"]').not(this).prop('checked', false);
                    }
                }

                // Jangan lakukan tindakan apa pun jika jenis jawaban adalah "multiple"
            }

            $('input[type="checkbox"]').change(limitCheckboxBasedOnAnswerType);

            $('#add-option').click(function() {
                var inputField = `
        <div class="options-input">
            <div class="input-group mb-2">
                <input name="options[]" type="text" class="form-control" placeholder="Insert option">
                <div class="form-check ms-2 me-2 mt-2">
                    <input type="hidden" name="correct_answers[]" value="0">
                    <input type="checkbox" name="correct_answers[]" class="form-check-input" value="1">
                    <label class="form-check-label">Correct</label>
                </div>
                <button type="button" class="btn btn-danger remove-option">Remove</button>
            </div>
        </div>`;

                var newOption = $(inputField);

                var index = $('.options-input').length;

                newOption.find('input[name="options[]"]').attr('name', 'options[' + index + ']');
                newOption.find('input[name^="correct_answers"]').each(function() {
                    $(this).attr('name', 'correct_answers[' + index + ']');
                });

                $('#options-container').append(newOption);
                newOption.find('input[type="checkbox"]').change(limitCheckboxBasedOnAnswerType);
                newOption.find('.remove-option').removeAttr('disabled');

            });

            $('#answerType').change(function() {
                if ($(this).val() === 'single') {
                    $('input[type="checkbox"]').prop('checked', false);
                } else {
                    $('input[name^="correct_answers"]').val('0');
                }
            });

            $('#options-container').on('change', 'input[type="checkbox"]', function() {
                $(this).closest('.options-input').find('input[type="hidden"]').val($(this).prop('checked') ?
                    '1' : '0');
            });

            $('#options-container').on('click', '.remove-option', function() {
                $(this).closest('.options-input').remove();
            });



            $("#save-question").click(function(event) {
                event.preventDefault();

                $(this).html('Sending... <i class="fa fa-spinner fa-spin"></i>');
                $(this).prop('disabled', true);

                var formData = new FormData($("#form-question-create")[0]);

                formData.forEach(function(value, key) {
                    console.log(key + " : " + value);
                });
                $.ajax({
                    url: '{{ route('dashboard.questions.store', $question->id) }}',
                    type: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        // Menutup modal
                        $("#exampleModalScrollable").modal("hide");

                        // Menampilkan notifikasi berhasil
                        if (response.success) {
                            alert(response.success);
                        }

                        // Reload datatable
                        $('#table-question').DataTable().ajax.reload();
                        $("#form-question-create")[0].reset();
                        $('#options-container .options-input:not(:first)').remove();
                    },
                    error: function(xhr, status, error) {
                        // Menampilkan notifikasi kesalahan
                        if (xhr.responseJSON && xhr.responseJSON.error) {
                            console.log("Terjadi kesalahan: " + xhr.responseJSON.error);
                            alert(xhr.responseJSON.error);
                            $('#table-question').DataTable().ajax.reload();
                            $("#form-question-create").trigger('reset');
                        } else {
                            console.log("Terjadi kesalahan: " + error);
                            alert(error);
                            $('#table-question').DataTable().ajax.reload();
                            $("#form-question-create").trigger('reset');
                        }
                    },
                    complete: function() {
                        // Mengembalikan teks dan keadaan tombol ke semula
                        $("#save-question").html('Save');
                        $("#save-question").prop('disabled', false);
                    }
                });
            });


        });
    </script>
@endpush
