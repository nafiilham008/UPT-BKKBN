@extends('layouts.app')

@section('title', __('Category Quiz'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('Category Quiz') }}</h3>
                    <p class="text-subtitle text-muted">
                        {{ __('Below is a list of Category quiz.') }}
                    </p>
                </div>
                <x-breadcrumb>
                    <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Category Quiz') }}</li>
                </x-breadcrumb>
            </div>
        </div>

        <section class="section">
            <x-alert></x-alert>

            @can('quiz-category create')
                <div class="d-flex justify-content-end">
                    <button id="add-category" class="btn btn-primary mb-3" data-bs-toggle="modal"
                        data-bs-target="#exampleModalScrollable">
                        <i class="fas fa-plus"></i>
                        {{ __('Add Quiz Category') }}
                    </button>
                </div>
            @endcan

            <div class="row">
                <div class="col-md-12">
                    <div class="card border">
                        <x-alert></x-alert>
                        <div class="card-body">
                            <div class="table-responsive p-1">
                                <table class="table table-striped" id="table-category" width="100%">
                                    <thead>
                                        <tr>
                                            {{-- <th>{{ __('No') }}</th> --}}
                                            <th>{{ __('Title') }}</th>
                                            <th>{{ __('Created At') }}</th>
                                            <th>{{ __('Updated At') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                            {{-- create --}}
                            @include('remaja.category.include.modal-category-create')
                            {{-- edit --}}
                            {{-- <div id="modal-container"></div> --}}
                            @if (!empty($category))
                                @foreach ($category as $item)
                                    @include('remaja.category.include.modal-category-edit', [
                                        'id' => $item->id,
                                    ])
                                @endforeach
                            @endif
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
    <script src="{{ asset('mazer') }}/extensions/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.0/datatables.min.js"></script>

    <script>
        $(document).ready(function() {

            $('#table-category').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('dashboard.categories.datatable') }}",
                columns: [{
                        data: 'title',
                        name: 'title'
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
                // order: [
                //     [2,
                //         'desc'
                //     ] // mengurutkan berdasarkan kolom ke-2 (graduation_year) secara descending
                // ],
                drawCallback: function(settings) {
                    // menghilangkan notifikasi
                    $('.alert').hide();
                }
            });


            $("#save-category").click(function(event) {
                event.preventDefault();

                $.ajax({
                    url: '{{ route('dashboard.categories.store') }}',
                    type: 'POST',
                    data: $("#form-category-create").serialize(),
                    success: function(response) {
                        // Menutup modal
                        $("#exampleModalScrollable").modal("hide");

                        // Menampilkan notifikasi berhasil
                        if (response.success) {
                            // console.log(response.success);

                            alert(response.success);
                        }

                        // Reload datatable
                        $('#table-category').DataTable().ajax.reload();
                        $("#form-category-create").trigger('reset');

                    },
                    error: function(xhr, status, error) {
                        // Menampilkan notifikasi kesalahan
                        if (xhr.responseJSON && xhr.responseJSON.error) {
                            console.log("Terjadi kesalahan: " + xhr.responseJSON.error);
                            alert(xhr.responseJSON.error);
                            $('#table-category').DataTable().ajax.reload();
                            $("#form-category-create").trigger('reset');
                        } else {
                            console.log("Terjadi kesalahansss: " + error);
                            alert(error);
                            $('#table-category').DataTable().ajax.reload();
                            $("#form-category-create").trigger('reset');
                        }
                    }

                });
            });

            document.querySelector('#form-category-create').addEventListener('submit', async function(event) {
                event.preventDefault();

                const formData = new FormData(this);
                const response = await fetch(this.action, {
                    method: 'POST',
                    body: formData
                });

                const data = await response.json();
                $("#exampleModalScrollable").modal("hide");
                $('#table-category').DataTable().ajax.reload();
                $("#form-category-create").trigger('reset');
                alert(data.success); // Menampilkan pesan dari respons JSON
            });

            // GET DATA Category
            $(document).on("click", ".btn-edit", function() {
                var categoryId = $(this).data("id");
                var url = "/dashboard/categories/" + categoryId + "/edit";

                $.ajax({
                    url: url,
                    type: "GET",
                    success: function(response) {
                        var category = response.category;
                        // Mengisi data category ke dalam form
                        $("#form-category-edit" + categoryId + " #title_category")
                            .val(category.title);

                        // Menampilkan modal
                        $("#exampleModalScrollableEdit" + categoryId).modal("show");

                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });

            $(document).on("click", "[id^='update-category']", function(event) {
                event.preventDefault();
                var categoryId = $(this).data('id');
                // console.log("id employee " + employeeId);
                // console.log("id category " + categoryId);

                $.ajax({
                    url: '/dashboard/categories/' + categoryId,
                    type: 'PUT',
                    data: $("#form-category-edit" + categoryId).serialize(),
                    success: function(response) {
                        // Menutup modal
                        $("#exampleModalScrollableEdit" + categoryId).modal("hide");
                        // console.log(response.data);

                        alert(response.success);

                        // Reload datatable
                        $('#table-category').DataTable().ajax.reload();
                    },
                    error: function(xhr, status, error) {
                        // Menampilkan notifikasi gagal
                        alert("Terjadi kesalahan: " + error);
                        console.log("Terjadi kesalahan: " + error);
                        // Reload datatable
                        $('#table-category').DataTable().ajax.reload();
                    }
                });
            });

            // DELEETE
            $(document).on("click", "#delete-category", function(e) {
                e.preventDefault();
                var categoryId = $(this).data('id');
                var token = $('meta[name="csrf-token"]').attr('content');
                var url = "{{ route('dashboard.categories.destroy', ':id') }}";
                url = url.replace(':id', categoryId);

                if (confirm('Are you sure you want to delete this data?')) {
                    $.ajax({
                        url: url,
                        type: 'DELETE', // Mengubah metode permintaan menjadi DELETE
                        data: {
                            '_token': token
                        },
                        success: function(response) {
                            alert(response.success);
                            $('#table-category').DataTable().ajax.reload();
                        },
                        error: function(xhr) {
                            alert(xhr
                                .statusText
                            ); // Menggunakan xhr.statusText untuk menampilkan pesan kesalahan
                            $('#table-category').DataTable().ajax.reload();
                        }
                    });
                }
            });



        });
    </script>
@endpush
