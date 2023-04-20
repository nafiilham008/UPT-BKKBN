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
                                            <label for="name" class="form-label">{{ __('Name') }}</label>
                                            <input type="text" name="name" id="name"
                                                value="{{ $employee->name }}"
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
                                                value="{{ $employee->email }}"
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
                                                value="{{ $employee->place_of_birth }}"
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
                                                value="{{ $employee->birthdate }}"
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
                                                value="{{ $employee->position }}"
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
                                                value="{{ $employee->nip }}"
                                                class="form-control @error('nip') is-invalid @enderror"
                                                placeholder="e.g. 1234567890" data-parsley-type="digits"
                                                data-parsley-maxlength="30" data-parsley-required="true"
                                                data-parsley-required-message="NIP is required."
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
                                                data-parsley-required="false">{{ $employee->address ?? old('address') }}</textarea>
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
                                                    {{ $employee->type_employee == 'PNS' ? 'selected' : '' }}>PNS</option>
                                                <option value="Non PNS"
                                                    {{ $employee->type_employee == 'Non PNS' ? 'selected' : '' }}>Non PNS
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
                                            <input type="text" name="phone_number" id="phone_number"
                                                value="{{ $employee->phone_number }}"
                                                class="form-control @error('phone_number') is-invalid @enderror"
                                                placeholder="e.g. +6281234567890" data-parsley-type="number"
                                                data-parsley-maxlength="16"
                                                data-parsley-error-message="Please enter a valid phone number (maximum 16 digits)">
                                            @error('phone_number')
                                                <span class="text-danger">
                                                    {{ $message }}
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-1 text-center"
                                        style="display: flex; justify-content: center; align-items: center;">
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

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="awards">{{ __('Awards') }}</label>
                                            {{ csrf_field() }}
                                            <textarea id="summernote-awards" name="awards" class="form-control @error('awards') is-invalid @enderror"
                                                placeholder="Insert awards">{!! $employee->awards !!}</textarea>
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


                            {{-- <div id="education-list"> --}}
                            @if (!empty($educationHistory))
                                @foreach ($educationHistory as $education)
                                    @include('profile.employee.include.modal-edu-history-edit', [
                                        'id' => $education->id,
                                        'employeeId' => $education->employee_id,
                                    ])
                                @endforeach
                            @endif
                            {{-- </div> --}}

                            {{-- @include('profile.employee.include.modal-edu-history-edit') --}}

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
    {{-- Summernote --}}
    <script src="{{ asset('mazer') }}/extensions/summernote/summernote-lite.min.js"></script>
    <script src="{{ asset('mazer') }}/js/pages/summernote.js"></script>

    <script src="{{ asset('mazer') }}/extensions/parsleyjs/parsley.min.js"></script>
    <script src="{{ asset('mazer') }}/js/pages/parsley.js"></script>

    {{-- Select --}}
    <script src="{{ asset('mazer') }}/extensions/choices.js/public/assets/scripts/choices.js"></script>
    <script src="{{ asset('mazer') }}/js/pages/form-element-select.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.0/datatables.min.js"></script>




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

                        $("#form-education-history").trigger('reset');

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

            // GET DATA EDUCATION HISTORY
            $(document).on("click", ".btn-edit", function() {
                var employeeId = $(this).data("employee-id");
                var educationId = $(this).data("id");
                var url = "/dashboard/employees/" + employeeId + "/educations/" + educationId + "/edit";

                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(response) {
                        // console.log(response.education);

                        var education = response.education;

                        // Mengisi data education ke dalam form
                        $("#form-education-history-edit" + educationId + " #id")
                            .val(education.id);
                        $("#form-education-history-edit" + educationId + " #institution_name")
                            .val(education.institution_name);
                        $("#form-education-history-edit" + educationId + " #degree").val(
                            education.degree);
                        $("#form-education-history-edit" + educationId + " #graduation_year")
                            .val(education.graduation_year);
                        $("#form-education-history-edit" + educationId + " #major").val(
                            education.major);
                        $("#form-education-history-edit" + educationId + " #gpa").val(education
                            .gpa);
                        $("#form-education-history-edit" + educationId + " #description").val(
                            education.description);

                        // Menampilkan modal
                        $("#exampleModalScrollableEdit" + educationId).modal("show");

                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });




            // UPDATE EDUCATION HISTORY
            $(`#update-education`).click(function(event) {
                event.preventDefault();
                var employeeId = $(this).data('employee-id');
                var educationId = $(this).data('id');
                // console.log("id employee " + employeeId);
                // console.log("id education " + educationId);

                $.ajax({
                    url: '/dashboard/employees/' + employeeId + '/educations/' + educationId,
                    type: 'PUT',
                    data: $("#form-education-history-edit" + educationId).serialize(),
                    success: function(response) {
                        // Menutup modal
                        $("#exampleModalScrollableEdit" + educationId).modal("hide");
                        // console.log(response.data);

                        alert(response.success);

                        // Reload datatable
                        $('#table1').DataTable().ajax.reload();
                    },
                    error: function(xhr, status, error) {
                        // Menampilkan notifikasi gagal
                        alert("Terjadi kesalahan: " + error);
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
