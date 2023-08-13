@extends('layouts.front.app')

@section('title', __('Information'))

@section('content')
    <div class="background-image-profile d-flex align-items-center justify-content-center">
        <div class="profile-text">
            <h3>Informasi Pelatihan Lainnya</h3>
            <p>Kumpulan informasi terkait Pelatihan UPT Balai Diklat KKB Banyumas</p>
        </div>
        <img class="img-fluid" src="{{ asset('img/dummy/img-kediklatan-2.jpg') }}" alt="Background Image">
    </div>



    <div class="container-fluid detail-news fade-in" id="kursus">
        <h2 class="text-center bold-text mb-5">Pelatihan Lainnya</h2>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card rounded-custom">
                    <div class="card-body">
                        <p>
                            Beberapa daftar pelatihan lainnya yang tersedia adalah sebagai berikut:
                        </p>
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            @foreach ($otherCourse as $item)
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
                                            {{ $item->description }}
                                            @if (isset($item->link))
                                                Lihat selengkapnya <a href="{{ $item->link }}" target="_blank">Disini</a>
                                            @endif
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

        a {
            text-decoration: none;
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
