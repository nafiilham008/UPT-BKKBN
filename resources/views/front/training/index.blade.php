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
    <div class="container-fluid detail-news fade-in" id="kalender-pelatihan">
        <h2 class="text-center mb-5">Kalender Pendidikan</h2>


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
        dwada
    </div>
    <div class="container-fluid detail-news fade-in d-none" id="kerjasama">
        kerjasama
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
