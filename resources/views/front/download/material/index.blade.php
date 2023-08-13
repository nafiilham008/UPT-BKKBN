@extends('layouts.front.app')

@section('title', __('Unduhan'))

@section('content')
    <div class="background-image-profile d-flex align-items-center justify-content-center">
        <div class="profile-text">
            <h3>Unduhan</h3>
            <p>Kumpulan informasi berupa dokumen yang dapat di akses dan diunduh milik UPT Balai Pelatihan KKB Banyumas</p>
        </div>
        <img class="img-fluid" src="{{ asset('img/dummy/img-kediklatan-2.jpg') }}" alt="Background Image">
    </div>
    {{-- <div class="container-fluid d-flex justify-content-center bg-menu-doc mt-custom">
        <ul class="nav d-flex my-auto">
            <li class="nav-item">
                <a class="nav-link active" href="#" data-target="materi-diklat">Materi Pelatihan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-target="kursus">Pelatihan Lainnya</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-target="pengumuman">Pengumumanr</a>
            </li>

        </ul>
    </div> --}}
    <div class="container-fluid detail-news" id="materi-iklat">
        <h2 class="text-center bold-text mb-5">Materi Pelatihan</h2>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card rounded-custom">
                    <div class="card-body">
                        <p>
                            Beberapa daftar materi pelatihan yang tersedia adalah sebagai berikut:
                        </p>
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            @foreach ($download as $item)
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
                                            Dokumen dapat diunduh dengan <a href="{{ $item->link }}" target="_blank">klik
                                                di sini</a>.
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

    {{-- <div class="container-fluid detail-news fade-in d-none" id="kursus">
        <h2 class="text-center bold-text mb-5">Pelatihan Lainnya</h2>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card rounded-custom">
                    <div class="card-body">
                        <p>
                            Beberapa daftar pelatihan lainnya yang tersedia adalah sebagai berikut:
                        </p>
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            @foreach ($download as $item)
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
            width: max-content;
        }

        .bg-menu-doc .nav-link.active {
            color: #fff;
        }


        .accordion-body a {
            text-decoration: none;
        }



        @media (max-width: 767px) {
            .bg-menu-doc {
                max-width: 300px !important;
                height: 50px;
                overflow-x: auto;
            }

            .bg-menu-doc .nav {
                flex-wrap: nowrap;
            }

            .bg-menu-doc .nav-item {
                flex-basis: 50%;
            }

        }
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
