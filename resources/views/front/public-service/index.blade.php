@extends('layouts.front.app')

@section('title', __('Information'))

@section('content')
    <div class="background-image-profile d-flex align-items-center justify-content-center">
        <div class="profile-text">
            <h3>Informasi</h3>
            <p>Kumpulan informasi terkait Beasiswa dan Short/Long Course UPT Balai Diklat KKB Banyumas</p>
        </div>
        <img class="img-fluid" src="{{ asset('img/dummy/img-kediklatan-2.jpg') }}" alt="Background Image">
    </div>
    <div class="container-fluid d-flex justify-content-center bg-menu mt-custom">
        <ul class="nav d-flex my-auto">
            <li class="nav-item">
                <a class="nav-link active" href="#" data-target="daftar-informasi">Daftar Informasi Publik</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-target="akuntabilitas-kerja">Akuntabilitas kerja</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-target="maklumat-pelayanan">Maklumat Pelayanan</a>
            </li>

        </ul>
    </div>
    <div class="container-fluid detail-news" id="daftar-informasi">
        <h2 class="text-center bold-text mb-5">Daftar Informasi</h2>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card rounded-custom">
                    <div class="card-body">
                        <p>
                            Berikut adalah daftar informasi publik yang dapat di akses:
                        </p>
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            @foreach ($publicService as $item)
                                @php
                                    $iterationCount = 1;
                                @endphp

                                @foreach ($typePublicInformation as $itemType)
                                    @if ($itemType['id'] == $item->type)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="flush-heading{{ $itemType['id'] }}">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#flush-collapse{{ $itemType['id'] }}"
                                                    aria-expanded="false"
                                                    aria-controls="flush-collapse{{ $itemType['id'] }}">
                                                    {{ $itemType['label'] }}
                                                </button>
                                            </h2>
                                            <div id="flush-collapse{{ $itemType['id'] }}"
                                                class="accordion-collapse collapse"
                                                aria-labelledby="flush-heading{{ $itemType['id'] }}"
                                                data-bs-parent="#accordionFlushExample">
                                                <div class="accordion-body">
                                                    <table class="table table-bordered mt-2"
                                                        style="background-color: #F4F4F4;">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">#</th>
                                                                <th scope="col">Informasi</th>
                                                                <th scope="col"></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($publicService as $key => $itemPublicInformation)
                                                                @if ($itemPublicInformation->type === $item->type)
                                                                    <tr>
                                                                        <td>{{ $iterationCount }}. </td>
                                                                        <td>{{ $itemPublicInformation->title }}</td>
                                                                        <td>
                                                                            <a href="{{ $itemPublicInformation->link }}"
                                                                                target="_blank">Lihat
                                                                                Detail</a>
                                                                        </td>
                                                                    </tr>
                                                                    @php
                                                                        $iterationCount++;
                                                                    @endphp
                                                                @endif
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            @endforeach
                        </div>


                    </div>
                </div>
            </div>
        </div>



    </div>

    <div class="container-fluid detail-news fade-in d-none" id="akuntabilitas-kerja">
        <h2 class="text-center bold-text mb-5">Akuntabilitas Kerja</h2>
        <div class="table-responsive">
            <table class="table table-bordered mt-2" style="background-color: #F4F4F4;">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Year</th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($workAccountability as $item)
                        <tr>
                            <td>{{ $loop->iteration }}. </td>
                            <td>{{ $item->year }} - {{ $item->additional }}</td>
                            <td>
                                <a href="{{ $item->link }}" target="_blank">Lihat Selengkapnya</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="container-fluid detail-news fade-in d-none" id="maklumat-pelayanan">
        <h2 class="text-center bold-text mb-5">Maklumat Pelayanan</h2>
        @foreach ($serviceInformation as $item)
            <div class="center-img-service mt-3">
                <img src="{{ asset('uploads/images/public-service/service-information/' . $item->photo) }}" alt="">
            </div>
        @endforeach
    </div>

@endsection

@push('css')
    <style>
        .bg-menu-doc {
            background-color: #0672B0;
            max-width: 600px;
            height: 50px;
            margin: 0 auto;
            border-radius: 1rem;
        }

        /* .bg-menu-doc .nav {
                flex-wrap: nowrap;
                overflow-x: auto;
            }

            .bg-menu-doc .nav-link {
                color: #f4f4f4c5;
            }

            .bg-menu-doc .nav-link.active {
                color: #fff;
            } */

        .center-img-service {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .center-img-service img {
            max-width: 100%;
            max-height: 100%;
            width: 500px !important;
            object-fit: contain;
        }

        /* @media (max-width: 767px) {
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

            } */
    </style>
    <style>
        .text-white-accordion {
            color: #ffffff
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
