@extends('layouts.front.app')

@section('title', __('Information'))

@section('content')
    <div class="background-image-profile d-flex align-items-center justify-content-center">
        <div class="profile-text">
            <h3>Informasi</h3>
            <p>Kumpulan informasi terkait Beasiswa dan Short/Long Course UPT Balai Diklat KKB Banyumas</p>
        </div>
        {{-- <img class="img-fluid" src="{{ asset('uploads/images/profile/history/' . $item->thumbnail) }}" alt="Background Image"> --}}
        <img class="img-fluid" src="{{ asset('img/dummy/img-kediklatan-2.jpg') }}" alt="Background Image">
    </div>
    <div class="container-fluid d-flex justify-content-center bg-menu-doc mt-custom">
        <ul class="nav d-flex my-auto">
            <li class="nav-item">
                <a class="nav-link active" href="#" data-target="beasiswa">Beasiswa</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-target="kursus">Kursus</a>
            </li>
            {{-- 
            <li class="nav-item">
                <a class="nav-link" href="#" data-target="profil-pengajar">Profil Pengajar</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-target="kerjasama">Kerjasama</a>
            </li> --}}
            {{-- <li class="nav-item">
                <a class="nav-link" href="#alumni" data-target="alumni">Alumni</a>
            </li> --}}

        </ul>
    </div>
    <div class="container-fluid detail-news" id="beasiswa">
        <h2 class="text-center bold-text mb-5">Beasiswa</h2>

        <div class="gallery-image">
            @if (!empty($information))
                @foreach ($information as $item)
                    <div class="img-box">
                        <a href="#" data-bs-toggle="modal" data-target="#detail-scholarship{{ $item->id }}"
                            data-id="{{ $item->id }}">
                            <img class="img-banner-scholarship"
                                src="{{ asset('uploads/images/information/scholarship/' . $item->photo) }}"
                                alt="" />
                        </a>
                    </div>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#detail-scholarship{{ $item->id }}"
                        data-id="{{ $item->id }}">View
                        Detail</a>
                @endforeach
            @else
                <p>Beasiswa belum tersedia.</p>
            @endif
        </div>

        @foreach ($information as $item)
            @include('front.information.include.modal-scholarship', [
                'id' => $item->id,
            ])
        @endforeach



    </div>

    {{-- <div class="container-fluid detail-news fade-in d-none" id="profile-pelatihan">
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
    <div class="container-fluid detail-news fade-in d-none" id="kerjasama">
        <h2 class="text-center mb-4 bold-text">Kerja Sama</h2>
        <p class="text-center paragraph-text">Kami Selaku Lembaga Badan Kependudukan dan Keluarga Berencana Nasional</p>
        <p class="text-center paragraph-text">Bekerjasama Dengan Beberapa Universitas dan Lembaga Pemerintahan</p>

        <div class="logo-container mt-5">
            @foreach ($collaboration as $item)
                <img class="img-rounded-custom-detail" src="{{ asset('uploads/images/training/collaboration-logo/' . $item->logo) }}"
                    alt="Logo {{ $item->institution_name }}">
            @endforeach
        </div>
    </div> --}}
    {{-- <div class="container-fluid detail-news fade-in" id="alumni">
        <h2 class="text-center mb-4 bold-text">Alumni</h2>

    </div> --}}
@endsection

@push('css')
    <style>
        .bg-menu-doc {
            background-color: #0672B0;
            max-width: 300px;
            height: 50px;
            margin: 0 auto;
            border-radius: 1rem;
        }

        .bg-menu-doc .nav {
            flex-wrap: nowrap;
            overflow-x: auto;
        }

        .bg-menu-doc .nav-link {
            color: #f4f4f4c5;
        }

        .bg-menu-doc .nav-link.active {
            color: #fff;
        }

        /* Gallery */
        .gallery-image {
            padding: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .gallery-image img {
            height: 250px;
            width: 350px;
            transform: scale(1.0);
            transition: transform 0.4s ease;
        }

        .img-box {
            box-sizing: content-box;
            margin: 10px;
            height: 400px;
            width: 300px;
            overflow: hidden;
            display: inline-block;
            color: white;
            position: relative;
            background-color: white;
        }


        .img-box:hover img {
            border: 3px solid #0672B0;
        }

        .img-box:hover .transparent-box {
            background-color: rgba(0, 0, 0, 0.5);
        }

        .img-box:hover .caption-scholarship {
            transform: translateY(-20px);
            opacity: 1.0;
        }

        .img-box:hover {
            cursor: pointer;
        }


        .opacity-low {
            opacity: 0.5;
        }

        .img-banner-scholarship {
            height: 400px !important;
            width: 300px !important;
            object-fit: cover;
        }

        .img-box a {
            color: inherit;
            text-decoration: none;
        }

        .scholarship-photo {
            max-height: 800px;
        }

        .btn-detail-scholarship {
            background: linear-gradient(to right, #0672B0, #5197d4);
            color: #FFFFFF;
        }

        .btn-detail-scholarship:hover {
            background: linear-gradient(to right, #5197d4, #0672B0);
            cursor: pointer;
            color: #FFFFFF;
        }

        /* End */

        @media (max-width: 767px) {
            .bg-menu-doc {
                max-width: 300px;
                height: 150px;
                margin: 0 auto;
            }

            .bg-menu-doc .nav {
                flex-wrap: wrap;
            }

            .bg-menu-doc .nav-item {
                flex-basis: 50%;
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
    <script>
        $(document).ready(function() {
            $('a[data-bs-toggle="modal"]').on('click', function() {
                var scholarshipId = $(this).data('id');
                $.ajax({
                    url: '/information/scholarship/' + scholarshipId,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        if (data.success) {
                            var scholarship = data.scholarship;
                            $('#detail-scholarship' + scholarshipId + ' .scholarship-photo')
                                .attr('src',
                                    '{{ asset('uploads/images/information/scholarship/') }}/' +
                                    scholarship.photo);
                            $('#detail-scholarship' + scholarshipId +
                                    ' .scholarship-description')
                                .text(scholarship.description);
                            $('#detail-scholarship' + scholarshipId +
                                    ' .scholarship-title')
                                .text(scholarship.title);
                            $('#detail-scholarship' + scholarshipId).modal('show');
                        } else {
                            alert('Failed to get scholarship detail!');
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        alert('Error getting scholarship detail!');
                    }
                });
            });

        });
    </script>
@endpush
