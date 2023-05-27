@extends('layouts.front.app')

@section('title', __('Sejarah'))

@section('content')
    <div class="background-image-profile d-flex align-items-center justify-content-center">
        <div class="profile-text">
            <h3>Profil Perusahaan</h3>
            <p>Profil Perusahaan UPT Balai Diklat KKB Banyumas</p>
        </div>
        {{-- <img class="img-fluid" src="{{ asset('uploads/images/profile/history/' . $item->thumbnail) }}" alt="Background Image"> --}}
        <img class="img-fluid" src="{{ asset('img/dummy/img-kediklatan.jpg') }}" alt="Background Image">
    </div>
    <div class="container-fluid d-flex justify-content-center bg-menu mt-custom">
        <ul class="nav d-flex my-auto">
            <li class="nav-item">
                <a class="nav-link active clickable-link" data-target="sejarah">Sejarah</a>
            </li>
            <li class="nav-item">
                <a class="nav-link clickable-link" data-target="tugas-fungsi">Tugas & Fungsi</a>
            </li>
            <li class="nav-item">
                <a class="nav-link clickable-link" data-target="struktur-organisasi">Struktur Organisasi</a>
            </li>
            <li class="nav-item">
                <a class="nav-link clickable-link" data-target="informasi-pejabat">Informasi Pejabat</a>
            </li>
            <li class="nav-item">
                <a class="nav-link clickable-link" data-target="informasi-pegawai">Informasi Pegawai</a>
            </li>
        </ul>
    </div>

    <div class="container-fluid detail-news fade-in" id="sejarah">
        @foreach ($history as $item)
            <h2 class="text-center mb-5 bold-text">{{ $item->title }}</h2>
            <div class="d-flex justify-content-center">
                <img class="rounded-4 img-news-detail"
                    src="{{ asset('uploads/images/profile/history/' . $item->thumbnail) }}" alt="">
            </div>
            <div class="mt-5">
                {!! str_replace(
                    ['<img ', '<span '],
                    ["<img class='img-fluid-summernote' ", "<span class='span-text-summernote' "],
                    $item->description,
                ) !!}
            </div>
        @endforeach


    </div>
    <div class="container-fluid detail-news fade-in d-none" id="tugas-fungsi">
        @foreach ($jobandfunc as $item)
            <h2 class="text-center mb-5 bold-text">{{ $item->title }}</h2>
            <div class="mt-5">
                {!! str_replace(
                    ['<img ', '<span '],
                    ["<img class='img-fluid-summernote' ", "<span class='span-text-summernote' "],
                    $item->description,
                ) !!}
            </div>
        @endforeach



    </div>
    <div class="container-fluid detail-news fade-in d-none" id="struktur-organisasi">
        <h2 class="text-center bold-text mb-5">Struktur Organisasi</h2>
        <img class="img-structure mx-auto d-block" src="{{ asset('img/struktur.svg') }}" alt="">
    </div>
    <div class="container-fluid detail-news fade-in d-none" id="informasi-pejabat">

        <h2 class="text-center mb-2 bold-text">Informasi Pejabat</h2>
        @foreach ($structural as $item)
            <h1 class="text-center mb-5">{{ $item->position }}</h1>
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <div class="d-flex justify-content-center">
                        <img class="rounded-4 img-detail-profile"
                            src="{{ asset('uploads/images/profile/employee-photo/' . $item->photo) }}" alt="">
                    </div>
                </div>
                <div class="col-md-8 col-sm-8">
                    <div class="d-flex justify-content-start mb-4">
                        <h4>{{ $item->name }}</h4>
                    </div>
                    <p><strong>NIP : </strong>{{ $item->nip }}</p>
                    <p><strong>Jabatan : </strong>{{ $item->position }}</p>
                    <p><strong>Deskripsi singkat : </strong></p>
                    <p style="text-align: justify">
                        @if ($item->place_of_birth)
                            Lahir di {{ $item->place_of_birth }},
                        @else
                            Lahir pada tanggal
                        @endif

                        @php
                            $latestEducation = $item->educationHistories->sortByDesc('graduation_year')->first();
                        @endphp

                        @if ($latestEducation)
                            {{ \Carbon\Carbon::parse($item->birthdate)->locale('id')->isoFormat('D MMMM YYYY') }}.
                            Menyelesaikan pendidikan dan memperoleh gelar {{ $latestEducation->degree }}
                            {{ $latestEducation->major }}
                            dari {{ $latestEducation->institution_name }} pada tahun
                            {{ $latestEducation->graduation_year }}.
                            Jabatan saat ini adalah {{ $item->position }}.
                        @elseif ($item->employeeHistories->isEmpty() && $item->educationHistories->isEmpty())
                            {{ \Carbon\Carbon::parse($item->birthdate)->locale('id')->isoFormat('D MMMM YYYY') }}.
                        @endif
                    </p>

                    <div class="row mb-5">
                        <div class="col-md-6 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Riwayat Pendidikan</h5>
                                    <table class="education-table">
                                        <tbody>
                                            @if ($item->educationHistories->isEmpty())
                                                <tr>
                                                    <td colspan="4">Data belum tersedia</td>
                                                </tr>
                                            @else
                                                @foreach ($item->educationHistories as $education)
                                                    <tr>
                                                        <td class="bullet-point"></td> <!-- Empty cell for bullet point -->
                                                        <td><strong>{{ $education->institution_name }}</strong></td>
                                                        <td>{{ $education->degree }}</td>
                                                        <td><em>{{ $education->graduation_year }}</em></td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-6 col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Riwayat Pekerjaan</h5>
                                    <table class="education-table">
                                        <tbody>
                                            @if ($item->employeeHistories->isEmpty())
                                                <tr>
                                                    <td colspan="4">Data belum tersedia</td>
                                                </tr>
                                            @else
                                                @foreach ($item->employeeHistories as $employee)
                                                    <tr>
                                                        <td></td> <!-- Empty cell for bullet point -->
                                                        <td><strong>{{ $employee->company_name }}</strong></td>
                                                        <td>{{ $employee->position }}</td>
                                                        <td><em>{{ $employee->end_year }}</em></td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 col-sm-12 mt-4">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Penghargaan/Tanda Jasa</h5>
                                    {{-- <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6> --}}
                                    @empty($item->awards)
                                        <p class="card-text">Data belum tersedia</p>
                                    @else
                                        <p class="card-text">{!! $item->awards !!}</p>
                                    @endempty
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
            <hr class="border border-dark border-2 opacity-100 mb-5 mt-3">
        @endforeach
    </div>
    <div class="container-fluid detail-news fade-in d-none" id="informasi-pegawai">
        <h2 class="text-center mb-5 bold-text">Informasi Pegawai</h2>
        <div class="row">
            <div class="col-md-2 col-sm-2">
                <div class="card shadow-none border-0 bg-transparent">
                    <div class="card-body text-center">
                        <div
                            class="rounded-circle bg-primary-bkkbn mx-auto align-items-center mb-3 icon-circle-center d-flex justify-content-center align-items-center">
                            <i class="bi bi-people-fill fs-1 text-white-icon"></i>
                        </div>
                        <h5 class="card-title mb-2 mt-4">{{ count($employee) }}</h5>
                        <p class="card-text fs-5">Total Pegawai</p>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-2">
                <div class="card shadow-none border-0 bg-transparent">
                    <div class="card-body text-center">
                        <div
                            class="rounded-circle bg-primary-bkkbn mx-auto align-items-center mb-3 icon-circle-center d-flex justify-content-center align-items-center">
                            <i class="bi bi-people-fill fs-1 text-white-icon"></i>
                        </div>
                        <h5 class="card-title mb-2 mt-4">{{ count($structural) }}</h5>
                        <p class="card-text fs-5">Pejabat Struktural</p>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-2">
                <div class="card shadow-none border-0 bg-transparent">
                    <div class="card-body text-center">
                        <div
                            class="rounded-circle bg-primary-bkkbn mx-auto align-items-center mb-3 icon-circle-center d-flex justify-content-center align-items-center">
                            <i class="bi bi-people-fill fs-1 text-white-icon"></i>
                        </div>
                        <h5 class="card-title mb-2 mt-4">{{ count($functional) }}</h5>
                        <p class="card-text fs-5">Pejabat Fungsional</p>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-2">
                <div class="card shadow-none border-0 bg-transparent">
                    <div class="card-body text-center">
                        <div
                            class="rounded-circle bg-primary-bkkbn mx-auto align-items-center mb-3 icon-circle-center d-flex justify-content-center align-items-center">
                            <i class="bi bi-people-fill fs-1 text-white-icon"></i>
                        </div>
                        <h5 class="card-title mb-2 mt-4">{{ count($executor) }}</h5>
                        <p class="card-text fs-5">Pejabat Pelaksana</p>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-2">
                <div class="card shadow-none border-0 bg-transparent">
                    <div class="card-body text-center">
                        <div
                            class="rounded-circle bg-primary-bkkbn mx-auto align-items-center mb-3 icon-circle-center d-flex justify-content-center align-items-center">
                            <i class="bi bi-people-fill fs-1 text-white-icon"></i>
                        </div>
                        <h5 class="card-title mb-2 mt-4">{{ count($widyaiswara) }}</h5>
                        <p class="card-text fs-5">Widyaiswara</p>
                    </div>
                </div>
            </div>
            <div class="col-md-2 col-sm-2">
                <div class="card shadow-none border-0 bg-transparent">
                    <div class="card-body text-center">
                        <div
                            class="rounded-circle bg-primary-bkkbn mx-auto align-items-center mb-3 icon-circle-center d-flex justify-content-center align-items-center">
                            <i class="bi bi-people-fill fs-1 text-white-icon"></i>
                        </div>
                        <h5 class="card-title mb-2 mt-4">{{ count($ppnpn) }}</h5>
                        <p class="card-text fs-5">PPNPN</p>
                    </div>
                </div>
            </div>


        </div>
        <table class="table table-bordered mt-5" style="background-color: #F4F4F4;">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Lengkap</th>
                    <th scope="col">NIP</th>
                    <th scope="col">Jabatan</th>
                    <th scope="col">Detail</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($employee as $key => $item)
                    <tr>
                        <td>{{ $loop->iteration }}. </td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->nip }}</td>
                        <td>{{ $item->position }}</td>
                        <td>
                            <a href="#" data-bs-toggle="modal"
                                data-bs-target="#detail-employee{{ $item->id }}" data-id="{{ $item->id }}">View
                                Detail</a>
                        </td>


                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @foreach ($employee as $item)
        @include('front.profile.include.modal-detail', [
            'id' => $item->id,
        ])
    @endforeach



@endsection

@push('css')
    <style>
        .clickable-link {
            cursor: pointer;
        }

        .icon-circle-center {
            width: 80px;
            height: 80px;
        }

        .text-white-icon {
            color: #ffffff
        }

        .employee-photo {
            max-width: 100%;
            height: auto;
        }

        .img-structure {
            width: 100%;
            object-fit: contain;
        }

        .education-table {
            border-collapse: collapse;
        }

        .education-table td {
            padding: 0.5rem;
        }

        .education-table td.bullet-point::before {
            content: "\2022";
            /* Bullet point character */
            margin-right: 0.5rem;
        }

        .bold-text {
            font-weight: bold;
        }
    </style>
@endpush

@push('js')
    <script>
        const navLinks = document.querySelectorAll('.nav-link');
        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                const target = this.getAttribute('data-target');
                const containers = document.querySelectorAll('.detail-news');
                containers.forEach(container => {
                    if (container.id === target) {
                        container.classList.remove('d-none');
                    } else {
                        container.classList.add('d-none');
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            // Mengambil data-target dari link yang diklik
            $(".nav-link").click(function(event) {
                event.preventDefault();
                var target = $(this).data('target');

                // Membuat link yang aktif menjadi tidak aktif
                $('.nav-link').removeClass('active');

                // Membuat link yang diklik menjadi aktif
                $(this).addClass('active');

                // Menampilkan konten yang sesuai dengan data-target
                $('.content').hide();
                $('#' + target).show();

                // Jalankan counter jika #informasi-pegawai aktif
                if (target === 'informasi-pegawai') {
                    $('.card-title').each(function() {
                        $(this).prop('Counter', 0).animate({
                            Counter: $(this).text()
                        }, {
                            duration: 3000,
                            easing: 'swing',
                            step: function(now) {
                                $(this).text(Math.ceil(now));
                            }
                        });
                    });
                }
            });

            $('a[data-bs-toggle="modal"]').on('click', function() {
                var employeeId = $(this).data('id');
                $.ajax({
                    url: '/profile/employees/' + employeeId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        if (data.success) {
                            var employee = data.employee;
                            $('#detail-employee' + employeeId + ' .employee-photo')
                                .attr('src',
                                    '{{ asset('uploads/images/profile/employee-photo/') }}/' +
                                    employee.photo);
                            $('#detail-employee' + employeeId + ' .employee-name')
                                .text(employee.name);
                            $('#detail-employee' + employeeId + ' .employee-nip')
                                .text(employee.nip);
                            $('#detail-employee' + employeeId +
                                ' .employee-position').text(employee.position);
                            $('#detail-employee' + employeeId).modal('show');
                        } else {
                            alert('Failed to get employee detail!');
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error getting employee detail!');
                    }
                });
            });

        });
    </script>
@endpush
