@extends('layouts.front.app')

@section('title', __('Tautan UPT KKB Banyumas'))

@section('content')
    <div class="background-image-profile d-flex align-items-center justify-content-center">
        <div class="profile-text">
            <h3>Informasi Tautan</h3>
            <p>Kumpulan tautan terkait UPT Balai Diklat KKB Banyumas</p>
        </div>
        {{-- <img class="img-fluid" src="{{ asset('uploads/images/profile/history/' . $item->thumbnail) }}" alt="Background Image"> --}}
        <img class="img-fluid" src="{{ asset('img/dummy/img-kediklatan-2.jpg') }}" alt="Background Image">
    </div>



    <div class="container-fluid detail-news" id="tautan">

        <div class="text-center">
            @if ($link->contains('type', 'Website'))
                <h2 class="text-center bold-text mb-3">Tautan Website</h2>
                <div class="image-button-link mb-5">
                    @foreach ($link as $item)
                        @if ($item->type == 'Website')
                            <h6 class="text-center">{{ $item->title }}</h6>
                            <a href="{{ $item->link }}" target="_blank"
                                class="text-decoration-none text-dark btn btn-outline-light btn-banner"
                                style="background-image: url('{{ asset('uploads/images/link/' . $item->photo) }}');">
                            </a>
                        @endif
                    @endforeach
                </div>
            @endif

            @if ($link->contains('type', 'LMS'))
                <h2 class="text-center bold-text mb-3">Tautan LMS</h2>
                <div class="image-button-link mb-5">
                    @foreach ($link as $item)
                        @if ($item->type == 'LMS')
                            <h6 class="text-center">{{ $item->title }}</h6>
                            <a href="{{ $item->link }}" target="_blank"
                                class="text-decoration-none text-dark btn btn-outline-light btn-banner"
                                style="background-image: url('{{ asset('uploads/images/link/' . $item->photo) }}');">
                            </a>
                        @endif
                    @endforeach
                </div>
            @endif
        </div>



    </div>

@endsection

@push('css')
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
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

        a {
            text-decoration: none;
        }



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
        .image-button-link {
            display: inline-block;
            margin: 10px;
            text-align: center;
        }

        .image-button-link a {
            display: block;
            text-decoration: none;
            padding: 0;
            background-size: 100% auto;
            width: 500px;
            /* Sesuaikan ukuran yang diinginkan */
            height: 100px;
            /* Sesuaikan ukuran yang diinginkan */
            border: none;
            cursor: pointer;
        }

        .image-button-link a span {
            display: none;
        }
    </style>
@endpush

@push('js')
    <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
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

    {{-- NEW --}}
    <script>
        jQuery(document).ready(function($) {
            var $slickElement = $('.slideshow');

            $slickElement.slick({
                autoplay: false,
                dots: false,
            });

        });
    </script>
@endpush
