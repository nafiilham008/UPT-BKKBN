@extends('layouts.front.app')

@section('title', __('Diklat UPT KKB Banyumas'))

@section('content')
    <div class="background-image-profile d-flex align-items-center justify-content-center">
        <div class="profile-text">
            <h3>Informasi Diklat</h3>
            <p>Kumpulan informasi terkait Kediklatan UPT Balai Diklat KKB Banyumas</p>
        </div>
        {{-- <img class="img-fluid" src="{{ asset('uploads/images/profile/history/' . $item->thumbnail) }}" alt="Background Image"> --}}
        <img class="img-fluid" src="{{ asset('img/dummy/img-kediklatan-2.jpg') }}" alt="Background Image">
    </div>



    <div class="container-fluid detail-news" id="beasiswa">
        <h2 class="text-center bold-text mb-5">Kediklatan</h2>

        <div class="row">
            <div class="d-flex justify-content-center">
                <div class="col-md-4">
                    @if (isset($getImage->photo))
                        <div class=" text-end me-5">
                            <img class="image-kediklatan"
                                src="{{ asset('uploads/images/kediklatan/' . $getImage->photo) }}">
                        </div>
                    @endif
                </div>
                <div class="col-md-8 my-auto">
                    @if (isset($kediklatan))
                        <div class="sd_master_wrapper">
                            <div class="slideshow d-flex justify-content-center align-items-center">
                                @foreach ($kediklatan as $item)
                                    <div class="content">
                                        <!-- slide 1 -->
                                        <div class="btnNtxt">
                                            <div class="sdAllContent">
                                                <p class="SdClientName">{{ $item->title }}</p>
                                                <div class="sd_scroll">
                                                    <h1 class="sdCustomSliderHeadig">{{ $item->description }}</h1>
                                                </div>
                                                <p class="SdClientDesc"><a href="{{ $item->link }}" target="_blank">Lihat
                                                        Selengkapnya</a></p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    @endif
                </div>
            </div>
        </div>





        {{-- <div class="spacer2"></div>
        
            <div class="spacer"></div>


            <div class="spacer"></div> --}}


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
        .image-kediklatan {
            border-radius: 2rem;
            max-height: 400px;
            height: 100%;
            width: 100%;
        }
    </style>

    {{-- NEW --}}
    <style>
        /* spacer */
        .spacer {
            height: 150px;
            width: 100%;
        }

        .spacer2 {
            height: 20px;
            width: 100%;
        }

        /* spacer ends */

        /* slider styles */
        .sd_master_wrapper {
            position: relative;
            /* padding-bottom: 100px !important; */
            max-width: 900px;
            margin: 0 auto;
            padding: 0;
            border-radius: 10px;
            z-index: 5;
        }

        .sdtestBg3 {
            height: 100%;
            width: 80%;
            background: #fff;
            position: absolute;
            bottom: -40px;
            left: 10%;
            border-radius: 20px;
            box-shadow: 0px 18px 52.8537px rgb(215 228 249 / 50%);
            z-index: 1;
        }

        .sdtestBg2 {
            height: 100%;
            width: 90%;
            background: #fff;
            position: absolute;
            bottom: -22px;
            left: 5%;
            border-radius: 20px;
            box-shadow: 0px 18px 52.8537px rgb(215 228 249 / 50%);
            z-index: 2;
        }

        .sd_scroll {
            height: auto;
            max-height: 180px;
            overflow: auto;
        }

        .slideshow {
            position: relative;
            min-height: 200px;
            height: auto;
            width: 100%;
            background: #fff;
            box-shadow: 0px 18px 52.8537px rgba(215, 228, 249, 0.5);
            border-radius: 20px;
            /* background-image: url(https://farsighttechnologies.com/wp-content/uploads/2021/03/quote1.png), url(https://farsighttechnologies.com/wp-content/uploads/2021/03/quote.png);
                                            background-position: top 15px left 15px, bottom 40% right 15px;
                                            background-repeat: no-repeat;
                                            background-size: 180px, 180px; */
            z-index: 3;
        }

        button.slick-prev.slick-arrow {
            position: absolute;
            z-index: 5;
            bottom: -80px;
            right: 160px;
            background: transparent;
            color: transparent;
            border: none;
            outline: none;
            cursor: pointer;
            height: 15px;
            width: 30px;
            padding: 0;
            background-image: url(https://farsighttechnologies.com/wp-content/uploads/2021/03/left-icon.png);
            background-size: 100% 100%;
        }

        button.slick-next.slick-arrow {
            position: absolute;
            bottom: -82px;
            right: 105px;
            background: transparent;
            color: transparent;
            border: none;
            padding: 0;
            cursor: pointer;
            outline: none;
            height: 18px;
            width: 40px;
            background-image: url(https://farsighttechnologies.com/wp-content/uploads/2021/03/right-icon.png);
            background-size: 100% 100%;
        }

        .pagingInfo {
            position: absolute;
            bottom: 0;
            z-index: 5;
        }

        .sdCustomSliderHeadig {
            color: #94A2B3;
            font-family: "Poppins", Sans-serif;
            font-size: 15px;
            font-weight: 400;
            line-height: 1.6em;
            text-align: center;
        }

        .sdCustomSliderBtn {
            display: inline-block;
            text-decoration: none;
            font-family: montserrat;
            background: #E31C3A;
            color: #fff;
            padding: 12px 25px;
            margin-top: 30px;
            border-radius: 4px;
            outline: none;
            font-size: 14px;
            font-weight: 500;
        }

        .sdAllContent {
            width: 75%;
            margin: auto;
        }

        .thumbnail img {
            height: 55px;
            width: 55px;
            border-radius: 50%;
            margin: auto;
            margin-top: 15px;
        }

        .content {
            display: block !important;
            padding: 5px;
        }

        .SdClientName {
            text-align: center;
            color: #272D4E;
            font-family: "Poppins", Sans-serif;
            font-size: 16px;
            font-weight: 500;
            line-height: 1.4em;
            margin-top: 15px;
        }

        .SdClientDesc {
            text-align: center;
            color: #7854F7;
            font-family: "Poppins", Sans-serif;
            font-size: 14px;
            line-height: 1.4em;
            margin-bottom: 10px;
        }


        /* style for moblile */
        @media (max-width:576px) {
            .sd_scroll {
                height: auto;
                overflow: auto;
                max-height: 240px;
            }

            .thumbnail,
            .btnNtxt {
                width: 100% !important;
                display: block !important;
            }

        }

        /* scroll bar */
        /* total width */
        .sd_scroll::-webkit-scrollbar {
            background-color: transparent;
            width: 6px;
        }

        /* background of the scrollbar except button or resizer */
        .sd_scroll::-webkit-scrollbar-track {
            background-color: transparent;
        }

        .sd_scroll::-webkit-scrollbar-track:hover {
            background-color: transparent;
        }

        /* scrollbar itself */
        .sd_scroll::-webkit-scrollbar-thumb {
            background-color: #babac0;
            border-radius: 16px;

        }

        .sd_scroll::-webkit-scrollbar-thumb:hover {
            background-color: #a0a0a5;
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
