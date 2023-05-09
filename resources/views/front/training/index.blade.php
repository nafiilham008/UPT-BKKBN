@extends('layouts.front.app')

@section('title', __('Kediklatan'))

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
                <a class="nav-link active" href="#kalender-pelatihan" data-target="kalender-pelatihan">Kalender Pelatihan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#profile-pelatihan" data-target="profil-pelatihan">Profil Pelatihan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#profil-pengajar" data-target="profil-pengajar">Profil Pengajar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#kerjasama" data-target="kerjasama">Kerjasama</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#alumni" data-target="alumni">Alumni</a>
            </li>

        </ul>
    </div>
    <div class="container-fluid detail-news fade-in d-none" id="kalender-pelatihan">
        <h2 class="text-center bold-text mb-5">Kalender Pendidikan</h2>


        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card rounded-custom">
                    <div class="card-body">
                        <p>
                            Beberapa daftar kelas yang tersedia adalah sebagai berikut:
                        </p>
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            @foreach ($calendar as $item)
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="flush-heading{{ $item->id }}">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#flush-collapse{{ $item->id }}" aria-expanded="false"
                                            aria-controls="flush-collapse{{ $item->id }}">
                                            {{ $item->title }}
                                        </button>
                                    </h2>
                                    <div id="flush-collapse{{ $item->id }}" class="accordion-collapse collapse"
                                        aria-labelledby="flush-heading{{ $item->id }}"
                                        data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            <a href="{{ $item->link }}" target="_blank">{{ $item->link }}</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid detail-news fade-in d-none" id="profile-pelatihan">
        a
    </div>
    <div class="container-fluid detail-news fade-in d-none" id="profil-pengajar">
        <h2 class="text-center bold-text mb-3">Profil Pengajar</h2>
        @foreach ($profileInstructor as $item)
            <div class="row">
                <div class="col-md-4 col-sm-4 mt-2">
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
        @endforeach
    </div>
    <div class="container-fluid detail-news fade-in" id="kerjasama">
        <h2 class="text-center mb-4 bold-text">Kerja Sama</h2>
        <p class="text-center paragraph-text">Kami Selaku Lembaga Badan Kependudukan dan Keluarga Berencana Nasional</p>
        <p class="text-center paragraph-text">Bekerjasama Dengan Beberapa Universitas dan Lembaga Pemerintahan</p>

        <div class="logo-container mt-5">
            @foreach ($collaboration as $item)
                <img src="{{ asset('uploads/images/training/collaboration-logo/' . $item->logo) }}"
                    alt="Logo {{ $item->institution_name }}">
            @endforeach
        </div>
    </div>




    <div class="container-fluid detail-news fade-in d-none" id="alumni">

    </div>
@endsection

@push('css')
    <style>
        .text-white-accordion {
            color: #ffffff
        }

        .rounded-custom {
            border-radius: 1rem !important;
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

        .paragraph-text {
            font-size: 16px;
        }

        .logo-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: flex-start;
            margin-top: 20px;
        }

        .logo-container img {
            width: 250px;
            max-height: 250px;
            margin-left: 20px;
            margin-right: 20px;
            margin-top: 20px;
            margin-bottom: 20px;
            border-radius: 2rem;
            object-fit: cover;
        }

        @media (max-width: 767px) {
            .logo-container {
                justify-content: flex-start;
            }
        }
    </style>
@endpush

@push('js')
    <script>
        $(document).ready(function() {
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

            $(".nav-link").click(function(event) {
                event.preventDefault();
                var target = $(this).data('target');

                // Membuat link yang aktif menjadi tidak aktif
                $('.nav-link').removeClass('active');

                // Membuat link yang diklik menjadi aktif
                $(this).addClass('active');

                // Menampilkan konten yang sesuai dengan data-target
                $('.content').hide();
            });
        })
    </script>
@endpush
