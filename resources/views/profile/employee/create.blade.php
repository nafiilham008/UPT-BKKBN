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
                                            <label for="title" class="form-label">{{ __('Name') }}</label>
                                            <input type="text" name="name" id="name"
                                                class="form-control @error('name') is-invalid @enderror"
                                                placeholder="{{ __('Insert name') }}" data-parsley-required="true"
                                                data-parsley-required-message="Kolom Nama harus diisi!" autofocus>
                                            @error('name')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mandatory">
                                            <label for="photo" class="form-label">{{ __('Photo') }}</label>
                                            <input class="form-control" type="file" id="photo" name="photo"
                                                accept="image/png, image/jpeg" data-parsley-filemaxmegabytes="2"
                                                data-parsley-trigger="change"
                                                data-parsley-filemimetypes="image/jpeg,image/png"
                                                data-parsley-error-message="Please upload an image file (JPEG, PNG) with maximum size of 2MB">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mandatory">
                                            <label for="nip" class="form-label">{{ __('NIP') }}</label>
                                            <input type="number" name="nip" id="nip"
                                                class="form-control @error('nip') is-invalid @enderror"
                                                placeholder="{{ __('Insert NIP') }}" data-parsley-required="true"
                                                data-parsley-required-message="Kolom NIP harus diisi!">
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
                                                placeholder="{{ __('Insert Position') }}" data-parsley-required="true"
                                                data-parsley-required-message="Kolom Jabatan harus diisi!">
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
                                            <input type="date" name="birthdate" id="birthdate"
                                                class="form-control @error('birthdate') is-invalid @enderror"
                                                placeholder="{{ __('Insert Birthdate') }}" min="1900-01-01"
                                                max="{{ date('Y-m-d') }}">
                                            @error('birthdate')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="employment_history"
                                                class="form-label">{{ __('Employment History') }}</label>
                                            <input type="text" name="employment_history" id="employment_history"
                                                class="form-control @error('employment_history') is-invalid @enderror"
                                                placeholder="{{ __('Insert Employment History') }}">
                                            @error('employment_history')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="awards">{{ __('Awards') }}</label>
                                            <textarea id="summernote-awards" name="awards" class="form-control @error('awards') is-invalid @enderror"
                                                placeholder="Insert awards" required autofocus></textarea> {{-- {!! $post->awards !!} --}}
                                            @error('awards')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-md-12">
                                    <div class="card border">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <h5>Education History</h5>
                                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#exampleModalScrollable">
                                                <i class="fas fa-plus mr-2"></i>
                                            </button>
                                        </div>
                                        <x-alert></x-alert>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table table-striped" id="table1">
                                                    <thead>
                                                        <tr>
                                                            <th>Institution Name</th>
                                                            <th>Degree</th>
                                                            <th>Graduation Year</th>
                                                            <th>Major</th>
                                                            <th>GPA</th>
                                                            <th>Description</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="text-center" colspan="6">No data found.</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}

                                <a href="{{ url()->previous() }}" class="btn btn-secondary">{{ __('Back') }}</a>

                                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        {{-- @include('profile.employee.include.modal-edu-history') --}}



    @endsection

    @push('css')
        {{-- Summernote --}}
        <link rel="stylesheet" href="{{ asset('mazer') }}/css/pages/summernote.css">
        <link rel="stylesheet" href="{{ asset('mazer') }}/extensions/summernote/summernote-lite.css">

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
                // Hapus session saat page direload
                

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


                // COBA
                // $(document).ready(function() {
                //     $('.btn-edit').on('click', function() {
                //         var id = $(this).closest('tr').data('id');
                //         $.ajax({
                //             url: '/education-history/' + id,
                //             type: 'GET',
                //             dataType: 'json',
                //             success: function(data) {
                //                 $('#edit_id').val(data.id);
                //                 $('#institution_name').val(data.institution_name);
                //                 $('#degree').val(data.degree);
                //                 $('#graduation_year').val(data.graduation_year);
                //                 $('#major').val(data.major);
                //                 $('#gpa').val(data.gpa);
                //                 $('#description').val(data.description);
                //             }
                //         });
                //     });
                //     $('#edit-form').on('submit', function(e) {
                //         e.preventDefault();
                //         var id = $('#edit_id').val();
                //         var url = '/education-history/' + id;
                //         $.ajax({
                //             url: url,
                //             type: 'POST',
                //             data: $('#edit-form').serialize(),
                //             success: function(data) {
                //                 location.reload();
                //             }
                //         });
                //     });
                // });
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
