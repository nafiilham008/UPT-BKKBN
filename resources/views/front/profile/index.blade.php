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
                <a class="nav-link active" href="#" data-target="sejarah">Sejarah</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-target="tugas-fungsi">Tugas & Fungsi</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-target="struktur-organisasi">Struktur Organisasi</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-target="informasi-pejabat">Informasi Pejabat</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#" data-target="informasi-pegawai">Informasi Pegawai</a>
            </li>

        </ul>
    </div>
    <div class="container-fluid detail-news fade-in" id="sejarah">
        @foreach ($history as $item)
            <h2 class="text-center mb-5">{{ $item->title }}</h2>
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

        <div class="d-flex align-items-end">
            <h6 class="me-4">Bagikan</h6>
            <a href="{{ 'https://www.facebook.com/sharer.php?u=' . route('home.profile') }}" target="_blank"
                class="me-2 text-decoration-none">
                <iconify-icon inline icon="logos:facebook" width="30" height="30"></iconify-icon>
            </a>
            <a href="#" target="_blank" class="me-2 text-decoration-none">
                <iconify-icon inline icon="logos:whatsapp-icon" width="33" height="33"></iconify-icon>
            </a>
            <a href="#" target="_blank" class="text-decoration-none">
                <iconify-icon inline icon="logos:telegram" width="30" height="30"></iconify-icon>
            </a>
        </div>
        <hr class="border border-dark border-3 opacity-100">
    </div>
    <div class="container-fluid detail-news fade-in d-none" id="tugas-fungsi">
        @foreach ($jobandfunc as $item)
            <h2 class="text-center mb-5">{{ $item->title }}</h2>
            <div class="mt-5">
                {!! str_replace(
                    ['<img ', '<span '],
                    ["<img class='img-fluid-summernote' ", "<span class='span-text-summernote' "],
                    $item->description,
                ) !!}
            </div>
        @endforeach


        <div class="d-flex align-items-end">
            <h6 class="me-4">Bagikan</h6>
            <a href="{{ 'https://www.facebook.com/sharer.php?u=' . route('home.profile') }}" target="_blank"
                class="me-2 text-decoration-none">
                <iconify-icon inline icon="logos:facebook" width="30" height="30"></iconify-icon>
            </a>
            <a href="#" target="_blank" class="me-2 text-decoration-none">
                <iconify-icon inline icon="logos:whatsapp-icon" width="33" height="33"></iconify-icon>
            </a>
            <a href="#" target="_blank" class="text-decoration-none">
                <iconify-icon inline icon="logos:telegram" width="30" height="30"></iconify-icon>
            </a>
        </div>
        <hr class="border border-dark border-3 opacity-100">
    </div>
    <div class="container-fluid detail-news fade-in d-none" id="struktur-organisasi">
        <h2 class="text-center mb-5">Struktur Organisasi</h2>
        {{-- @foreach ($employee as $item)

        @endforeach --}}


        <div id="wrapper">
            <div id="container">

                <ol class="organizational-chart">
                    <li>
                        <div>
                            <h1>Primary</h1>
                        </div>
                        <div>
                            <h1>Primary</h1>
                        </div>
                        <div>
                            <h1>Primary</h1>
                        </div>
                        <ol>
                            <li>
                                <div>
                                    <h2>Secondary</h2>
                                </div>
                                <ol>
                                    <li>
                                        <div>
                                            <h3>Tertiary</h3>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <h3>Tertiary</h3>
                                        </div>
                                        <ol>
                                            <li>
                                                <div>
                                                    <h4>Quaternary</h4>
                                                </div>
                                            </li>
                                            <li>
                                                <div>
                                                    <h4>Quaternary</h4>
                                                </div>
                                                <ol>
                                                    <li>
                                                        <div>
                                                            <h5>Quinary</h5>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div>
                                                            <h5>Quinary</h5>
                                                        </div>
                                                        <ol>
                                                            <li>
                                                                <div>
                                                                    <h6>Senary</h6>
                                                                </div>
                                                            </li>
                                                        </ol>
                                                    </li>
                                                </ol>
                                            </li>
                                            <li>
                                                <div>
                                                    <h4>Quaternary</h4>
                                                </div>
                                            </li>
                                        </ol>
                                    </li>
                                    <li>
                                        <div>
                                            <h3>Tertiary</h3>
                                        </div>
                                    </li>
                                </ol>
                            </li>
                            <li>
                                <div>
                                    <h2>Secondary</h2>
                                </div>
                                <ol>
                                    <li>
                                        <div>
                                            <h3>Tertiary</h3>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <h3>Tertiary</h3>
                                        </div>
                                        <ol>
                                            <li>
                                                <div>
                                                    <h4>Quaternary</h4>
                                                </div>
                                            </li>
                                            <li>
                                                <div>
                                                    <h4>Quaternary</h4>
                                                </div>
                                            </li>
                                            <li>
                                                <div>
                                                    <h4>Quaternary</h4>
                                                </div>
                                            </li>
                                        </ol>
                                    </li>
                                </ol>
                            </li>
                            <li>
                                <div>
                                    <h2>Secondary</h2>
                                </div>
                                <ol>
                                    <li>
                                        <div>
                                            <h3>Tertiary</h3>
                                        </div>
                                        <ol>
                                            <li>
                                                <div>
                                                    <h4>Quaternary</h4>
                                                </div>
                                                <ol>
                                                    <li>
                                                        <div>
                                                            <h5>Quinary</h5>
                                                        </div>
                                                        <ol>
                                                            <li>
                                                                <div>
                                                                    <h6>Senary</h6>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div>
                                                                    <h6>Senary</h6>
                                                                </div>
                                                            </li>
                                                        </ol>
                                                    </li>
                                                    <li>
                                                        <div>
                                                            <h5>Quinary</h5>
                                                        </div>
                                                    </li>
                                                </ol>
                                            </li>
                                        </ol>
                                    </li>
                                    <li>
                                        <div>
                                            <h3>Tertiary</h3>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <h3>Tertiary</h3>
                                        </div>
                                    </li>
                                </ol>
                            </li>
                            <li>
                                <div>
                                    <h2>Secondary</h2>
                                </div>
                                <ol>
                                    <li>
                                        <div>
                                            <h3>Tertiary</h3>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <h3>Tertiary</h3>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <h3>Tertiary</h3>
                                        </div>
                                        <ol>
                                            <li>
                                                <div>
                                                    <h4>Quaternary</h4>
                                                </div>
                                            </li>
                                            <li>
                                                <div>
                                                    <h4>Quaternary</h4>
                                                </div>
                                            </li>
                                        </ol>
                                    </li>
                                    <li>
                                        <div>
                                            <h3>Tertiary</h3>
                                        </div>
                                    </li>
                                    <li>
                                        <div>
                                            <h3>Tertiary</h3>
                                        </div>
                                    </li>
                                </ol>
                            </li>
                        </ol>
                    </li>
                </ol>

            </div>
        </div>













        {{-- <div class="d-flex justify-content-center">
            <img class="rounded-4 img-news-detail"
                src="{{ asset('uploads/images/profile/history/' . $item->thumbnail) }}" alt="">
        </div> --}}

        {{-- <div class="d-flex align-items-end">
            <h6 class="me-4">Bagikan</h6>
            <a href="{{ 'https://www.facebook.com/sharer.php?u=' . route('home.detail', [$history->categories->label, $history->slug_url]) }}"
                target="_blank" class="me-2 text-decoration-none">
                <iconify-icon inline icon="logos:facebook" width="30" height="30"></iconify-icon>
            </a>
            <a href="#" target="_blank" class="me-2 text-decoration-none">
                <iconify-icon inline icon="logos:whatsapp-icon" width="33" height="33"></iconify-icon>
            </a>
            <a href="#" target="_blank" class="text-decoration-none">
                <iconify-icon inline icon="logos:telegram" width="30" height="30"></iconify-icon>
            </a>
        </div>
        <hr class="border border-dark border-3 opacity-100"> --}}
    </div>
    <div class="container-fluid detail-news fade-in d-none" id="informasi-pejabat">

        @foreach ($employee as $item)
            <h5 class="text-center mb-2">Profil Pimpinan</h5>
            <h1 class="text-center mb-5">{{ $item->position }}</h1>
            <div class="row">
                <div class="col-md-6 col-sm-6">
                    <div class="d-flex justify-content-center">
                        <img class="rounded-4 img-detail-profile"
                            src="{{ asset('uploads/images/profile/employee-photo/' . $item->photo) }}" alt="">
                    </div>
                </div>
                <div class="col-md-6 col-sm-6">
                    <div class="d-flex justify-content-start">
                        <h4>{{ $item->name }}</h4>
                    </div>
                    <p>NIP:{{ $item->nip }}</p>
                    <p>Jabatan:{{ $item->position }}</p>

                </div>
            </div>
        @endforeach

        {{-- <div class="d-flex align-items-end">
            <h6 class="me-4">Bagikan</h6>
            <a href="{{ 'https://www.facebook.com/sharer.php?u=' . route('home.detail', [$history->categories->label, $history->slug_url]) }}"
                target="_blank" class="me-2 text-decoration-none">
                <iconify-icon inline icon="logos:facebook" width="30" height="30"></iconify-icon>
            </a>
            <a href="#" target="_blank" class="me-2 text-decoration-none">
                <iconify-icon inline icon="logos:whatsapp-icon" width="33" height="33"></iconify-icon>
            </a>
            <a href="#" target="_blank" class="text-decoration-none">
                <iconify-icon inline icon="logos:telegram" width="30" height="30"></iconify-icon>
            </a>
        </div>
        <hr class="border border-dark border-3 opacity-100"> --}}
    </div>
    <div class="container-fluid detail-news fade-in d-none" id="informasi-pegawai">
        @foreach ($history as $item)
            <h2 class="text-center mb-5">{{ $item->title }}</h2>
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

        {{-- <div class="d-flex align-items-end">
            <h6 class="me-4">Bagikan</h6>
            <a href="{{ 'https://www.facebook.com/sharer.php?u=' . route('home.detail', [$history->categories->label, $history->slug_url]) }}"
                target="_blank" class="me-2 text-decoration-none">
                <iconify-icon inline icon="logos:facebook" width="30" height="30"></iconify-icon>
            </a>
            <a href="#" target="_blank" class="me-2 text-decoration-none">
                <iconify-icon inline icon="logos:whatsapp-icon" width="33" height="33"></iconify-icon>
            </a>
            <a href="#" target="_blank" class="text-decoration-none">
                <iconify-icon inline icon="logos:telegram" width="30" height="30"></iconify-icon>
            </a>
        </div>
        <hr class="border border-dark border-3 opacity-100"> --}}
    </div>
@endsection

@push('css')
    <style>
        #wrapper {
            margin-left: auto;
            margin-right: auto;
            max-width: 80em;
        }

        #container {
            float: left;
            padding: 1em;
            width: 100%;
        }

        ol.organizational-chart,
        ol.organizational-chart ol,
        ol.organizational-chart li,
        ol.organizational-chart li>div {
            position: relative;
        }

        ol.organizational-chart,
        ol.organizational-chart ol {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        ol.organizational-chart {
            text-align: center;
        }

        ol.organizational-chart ol {
            padding-top: 1em;
        }

        ol.organizational-chart ol:before,
        ol.organizational-chart ol:after,
        ol.organizational-chart li:before,
        ol.organizational-chart li:after,
        ol.organizational-chart>li>div:before,
        ol.organizational-chart>li>div:after {
            background-color: #b7a6aa;
            content: '';
            position: absolute;
        }

        ol.organizational-chart ol>li {
            padding: 1em 0 0 1em;
        }

        ol.organizational-chart>li ol:before {
            height: 1em;
            left: 50%;
            top: 0;
            width: 3px;
        }

        ol.organizational-chart>li ol:after {
            height: 3px;
            left: 3px;
            top: 1em;
            width: 50%;
        }

        ol.organizational-chart>li ol>li:not(:last-of-type):before {
            height: 3px;
            left: 0;
            top: 2em;
            width: 1em;
        }

        ol.organizational-chart>li ol>li:not(:last-of-type):after {
            height: 100%;
            left: 0;
            top: 0;
            width: 3px;
        }

        ol.organizational-chart>li ol>li:last-of-type:before {
            height: 3px;
            left: 0;
            top: 2em;
            width: 1em;
        }

        ol.organizational-chart>li ol>li:last-of-type:after {
            height: 2em;
            left: 0;
            top: 0;
            width: 3px;
        }

        ol.organizational-chart li>div {
            background-color: #fff;
            border-radius: 3px;
            min-height: 2em;
            padding: 0.5em;
        }

        /*** PRIMARY ***/
        ol.organizational-chart>li>div {
            background-color: #a2ed56;
            margin-right: 1em;
        }

        ol.organizational-chart>li>div:before {
            bottom: 2em;
            height: 3px;
            right: -1em;
            width: 1em;
        }

        ol.organizational-chart>li>div:first-of-type:after {
            bottom: 0;
            height: 2em;
            right: -1em;
            width: 3px;
        }

        ol.organizational-chart>li>div+div {
            margin-top: 1em;
        }

        ol.organizational-chart>li>div+div:after {
            height: calc(100% + 1em);
            right: -1em;
            top: -1em;
            width: 3px;
        }

        /*** SECONDARY ***/
        ol.organizational-chart>li>ol:before {
            left: inherit;
            right: 0;
        }

        ol.organizational-chart>li>ol:after {
            left: 0;
            width: 100%;
        }

        ol.organizational-chart>li>ol>li>div {
            background-color: #83e4e2;
        }

        /*** TERTIARY ***/
        ol.organizational-chart>li>ol>li>ol>li>div {
            background-color: #fd6470;
        }

        /*** QUATERNARY ***/
        ol.organizational-chart>li>ol>li>ol>li>ol>li>div {
            background-color: #fca858;
        }

        /*** QUINARY ***/
        ol.organizational-chart>li>ol>li>ol>li>ol>li>ol>li>div {
            background-color: #fddc32;
        }

        /*** MEDIA QUERIES ***/
        @media only screen and (min-width: 64em) {

            ol.organizational-chart {
                margin-left: -1em;
                margin-right: -1em;
            }

            /* PRIMARY */
            ol.organizational-chart>li>div {
                display: inline-block;
                float: none;
                margin: 0 1em 1em 1em;
                vertical-align: bottom;
            }

            ol.organizational-chart>li>div:only-of-type {
                margin-bottom: 0;
                width: calc((100% / 1) - 2em - 4px);
            }

            ol.organizational-chart>li>div:first-of-type:nth-last-of-type(2),
            ol.organizational-chart>li>div:first-of-type:nth-last-of-type(2)~div {
                width: calc((100% / 2) - 2em - 4px);
            }

            ol.organizational-chart>li>div:first-of-type:nth-last-of-type(3),
            ol.organizational-chart>li>div:first-of-type:nth-last-of-type(3)~div {
                width: calc((100% / 3) - 2em - 4px);
            }

            ol.organizational-chart>li>div:first-of-type:nth-last-of-type(4),
            ol.organizational-chart>li>div:first-of-type:nth-last-of-type(4)~div {
                width: calc((100% / 4) - 2em - 4px);
            }

            ol.organizational-chart>li>div:first-of-type:nth-last-of-type(5),
            ol.organizational-chart>li>div:first-of-type:nth-last-of-type(5)~div {
                width: calc((100% / 5) - 2em - 4px);
            }

            ol.organizational-chart>li>div:before,
            ol.organizational-chart>li>div:after {
                bottom: -1em !important;
                top: inherit !important;
            }

            ol.organizational-chart>li>div:before {
                height: 1em !important;
                left: 50% !important;
                width: 3px !important;
            }

            ol.organizational-chart>li>div:only-of-type:after {
                display: none;
            }

            ol.organizational-chart>li>div:first-of-type:not(:only-of-type):after,
            ol.organizational-chart>li>div:last-of-type:not(:only-of-type):after {
                bottom: -1em;
                height: 3px;
                width: calc(50% + 1em + 3px);
            }

            ol.organizational-chart>li>div:first-of-type:not(:only-of-type):after {
                left: calc(50% + 3px);
            }

            ol.organizational-chart>li>div:last-of-type:not(:only-of-type):after {
                left: calc(-1em - 3px);
            }

            ol.organizational-chart>li>div+div:not(:last-of-type):after {
                height: 3px;
                left: -2em;
                width: calc(100% + 4em);
            }

            /* SECONDARY */
            ol.organizational-chart>li>ol {
                display: flex;
                flex-wrap: nowrap;
            }

            ol.organizational-chart>li>ol:before,
            ol.organizational-chart>li>ol>li:before {
                height: 1em !important;
                left: 50% !important;
                top: 0 !important;
                width: 3px !important;
            }

            ol.organizational-chart>li>ol:after {
                display: none;
            }

            ol.organizational-chart>li>ol>li {
                flex-grow: 1;
                padding-left: 1em;
                padding-right: 1em;
                padding-top: 1em;
            }

            ol.organizational-chart>li>ol>li:only-of-type {
                padding-top: 0;
            }

            ol.organizational-chart>li>ol>li:only-of-type:before,
            ol.organizational-chart>li>ol>li:only-of-type:after {
                display: none;
            }

            ol.organizational-chart>li>ol>li:first-of-type:not(:only-of-type):after,
            ol.organizational-chart>li>ol>li:last-of-type:not(:only-of-type):after {
                height: 3px;
                top: 0;
                width: 50%;
            }

            ol.organizational-chart>li>ol>li:first-of-type:not(:only-of-type):after {
                left: 50%;
            }

            ol.organizational-chart>li>ol>li:last-of-type:not(:only-of-type):after {
                left: 0;
            }

            ol.organizational-chart>li>ol>li+li:not(:last-of-type):after {
                height: 3px;
                left: 0;
                top: 0;
                width: 100%;
            }

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
            });
        });
    </script>
@endpush
