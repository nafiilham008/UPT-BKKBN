@extends('layouts.app')

@section('title', __('Edit Employee'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('Employee') }}</h3>
                    <p class="text-subtitle text-muted">
                        {{ __('Edit an employee.') }}
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
                            <form action="{{ route('employees.update', $employee->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <div class="form-group mandatory">
                                            <label for="title" class="form-label">{{ __('Name') }}</label>
                                            <input type="text" name="name" id="name"
                                                value="{{ $employee->name }}"
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
                                    <div class="col-md-1 text-center">
                                        @if (empty($employee->photo))
                                            <div class="avatar avatar-xl">
                                                <img style="object-fit: cover"
                                                    src="{{ asset('img/avatar-default/default.png') }}" alt="avatar">
                                            </div>
                                        @else
                                            <div class="avatar avatar-xl">
                                                <img style="object-fit: cover"
                                                    src="{{ asset('uploads/images/profile/employee-photo/' . $employee->photo) }}"
                                                    alt="avatar">
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-5">
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
                                                value="{{ $employee->nip }}"
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
                                                value="{{ $employee->position }}"
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
                                                value="{{ $employee->birthdate }}"
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
                                    {{-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="employment_history"
                                                class="form-label">{{ __('Employment History') }}</label>
                                            <input type="text" name="employment_history" id="employment_history"
                                                value="{{ $employee->employment_history }}"
                                                class="form-control @error('employment_history') is-invalid @enderror"
                                                placeholder="{{ __('Insert Employment History') }}">
                                            @error('employment_history')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div> --}}
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="awards">{{ __('Awards') }}</label>
                                            {{ csrf_field() }}
                                            <textarea id="summernote-awards" name="awards" class="form-control @error('awards') is-invalid @enderror"
                                                placeholder="Insert awards" required autofocus>{!! $employee->awards !!}</textarea>
                                            @error('awards')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="card border">
                                        <div class="card-header d-flex justify-content-between align-items-center">
                                            <h5>Education History</h5>
                                            <button type="button" id="add-education" class="btn btn-primary"
                                                data-bs-toggle="modal" data-bs-target="#exampleModalScrollable"
                                                data-id="{{ $employee->id }}">
                                                <i class="fas fa-plus mr-2"></i>
                                            </button>
                                        </div>
                                        <x-alert></x-alert>
                                        <div class="card-body">
                                            <div class="table-responsive p-1">
                                                <table class="table table-striped" id="table1" width="100%">
                                                    <thead>
                                                        <tr>
                                                            {{-- <th>{{ __('No') }}</th> --}}
                                                            <th>{{ __('Institution Name') }}</th>
                                                            <th>{{ __('Degree') }}</th>
                                                            <th>{{ __('Graduation Year') }}</th>
                                                            <th>{{ __('Major') }}</th>
                                                            <th>{{ __('GPA') }}</th>
                                                            <th>{{ __('Description') }}</th>
                                                            <th>{{ __('Created At') }}</th>
                                                            <th>{{ __('Action') }}</th>
                                                        </tr>
                                                    </thead>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>




                                <a href="{{ route('employees.index') }}"
                                    class="btn btn-secondary">{{ __('Back') }}</a>

                                <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                            </form>


                            <div id="education-list">
                                @if (!empty($educationHistory))
                                    @foreach ($educationHistory as $education)
                                        @include('profile.employee.include.modal-edu-history-edit', [
                                            'id' => $education->id,
                                            'employeeId' => $education->employee_id,
                                        ])
                                    @endforeach
                                @endif
                            </div>
                            {{-- create --}}
                            @include('profile.employee.include.modal-edu-history')


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

    {{-- <link rel="stylesheet" href="{{ asset('mazer') }}/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="{{ asset('mazer') }}/css/pages/datatables.css"> --}}

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.0/datatables.min.css" />


    {{-- <link rel="stylesheet" href="{{ asset('mazer') }}/extensions/simple-datatables/style.css"> --}}
    {{-- <link rel="stylesheet" href="{{ asset('mazer') }}/css/pages/simple-datatables.css"> --}}
    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.0/datatables.min.css" /> --}}

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
    {{-- Summernote --}}
    <script src="{{ asset('mazer') }}/extensions/summernote/summernote-lite.min.js"></script>
    <script src="{{ asset('mazer') }}/js/pages/summernote.js"></script>

    <script src="{{ asset('mazer') }}/extensions/parsleyjs/parsley.min.js"></script>
    <script src="{{ asset('mazer') }}/js/pages/parsley.js"></script>

    {{-- <script src="{{ asset('mazer') }}/extensions/simple-datatables/umd/simple-datatables.js"></script> --}}
    {{-- <script src="{{ asset('mazer') }}/js/pages/simple-datatables.js"></script> --}}
    {{-- <script src="{{ asset('mazer') }}/js/pages/datatables.js"></script> --}}
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.0/datatables.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.32/moment-timezone-with-data.min.js"></script> --}}



    <script>
        $(document).ready(function() {
            $('#table1').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('employees.educations', $employee->id) }}",
                columns: [{
                        data: 'institution_name',
                        name: 'institution_name'
                    },
                    {
                        data: 'degree',
                        name: 'degree'
                    },
                    {
                        data: 'graduation_year',
                        name: 'graduation_year'
                    },
                    {
                        data: 'major',
                        name: 'major',
                        defaultContent: '-'
                    },
                    {
                        data: 'gpa',
                        name: 'gpa',
                        defaultContent: '-'
                    },
                    {
                        data: 'description',
                        name: 'description',
                        defaultContent: '-'
                    },
                    {
                        data: 'created_at',
                        name: 'created_at',
                        defaultContent: '-'
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                order: [
                    [6,
                        'desc'
                    ] // mengurutkan berdasarkan kolom ke-2 (graduation_year) secara descending
                ],
                drawCallback: function(settings) {
                    // menghilangkan notifikasi
                    $('.alert').hide();
                }
            });



            // SAVE EDUCATION HISTORY
            $("#save-education").click(function(event) {
                event.preventDefault();
                var employeeId = $(this).data('id');

                $.ajax({
                    url: '{{ route('educations.store', ':employeeId') }}'.replace(':employeeId',
                        employeeId),
                    type: 'POST',
                    data: $("#form-education-history").serialize(),
                    success: function(response) {
                        // Menutup modal
                        $("#exampleModalScrollable").modal("hide");

                        // Menampilkan notifikasi berhasil
                        if (response.success) {
                            console.log(response.success);

                            alert(response.success);
                        }

                        // Reload datatable
                        $('#table1').DataTable().ajax.reload();




                    },
                    error: function(xhr, status, error) {
                        // Menampilkan notifikasi berhasil
                        if (xhr.responseJSON && xhr.responseJSON.error) {
                            // $('.alert-danger').text(xhr.responseJSON.error);
                            // $('.alert-danger').show();
                            // $('.alert-danger').delay(3000).slideUp(300);
                            alert(response.error);
                        }
                        console.log("Terjadi kesalahan: " + error);
                        alert(response.error);
                    }

                });
            });

            // UPDATE EDUCATION HISTORY
            $(`#update-education${$(this).data('id')}`).click(function(event) {
                event.preventDefault();
                var employeeId = $(this).data('employee-id');
                var educationId = $(this).data('id');
                console.log("id employee " + employeeId);
                console.log("id education " + educationId);

                $.ajax({
                    url: '/dashboard/employees/' + employeeId + '/educations/' + educationId,
                    type: 'PUT',
                    data: $("#form-education-history-edit" + educationId).serialize(),
                    success: function(response) {
                        // Menutup modal
                        $("#exampleModalScrollableEdit" + educationId).modal("hide");
                        console.log(response.data);

                        // Menampilkan notifikasi berhasil
                        // $('.alert-success').show();
                        // $('.alert-success').text('Data has been updated successfully!');
                        // $('.alert').delay(3000).slideUp(300);
                        alert(response.success);


                        // Reload datatable
                        $('#table1').DataTable().ajax.reload();

                    },
                    error: function(xhr, status, error) {
                        // Menampilkan notifikasi gagal
                        // $('.alert-danger').show();
                        // $('.alert-danger').text(
                        //     'Failed to update data. Please try again later.');
                        // $('.alert').delay(3000).slideUp(300);
                        alert(response.error);
                        console.log("Terjadi kesalahan: " + error);
                    }
                });
            });


            // DELEETE
            $(document).on('click', '#delete-education', function(e) {
                e.preventDefault();
                var educationId = $(this).data('id');
                var token = $('meta[name="csrf-token"]').attr('content');
                var url = "{{ route('educations.destroy', ':id') }}";
                url = url.replace(':id', educationId);

                if (confirm('Are you sure you want to delete this data?')) {
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            'id': educationId,
                            '_token': token
                        },
                        success: function(response) {
                            alert(response.success);
                            $('#table1').DataTable().ajax.reload();

                        },
                        error: function(xhr) {
                            alert(response.error);

                        }
                    });
                }
            });



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
@endpush
