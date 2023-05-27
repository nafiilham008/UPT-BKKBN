@extends('layouts.front.app')

@section('title', __('UPT Balai Diklat KKB Banyumas'))

@section('content')
    <!-- Carousel -->
    <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @if (!empty($banner))
                @foreach ($banner as $key => $slide)
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                        <img src="{{ asset('uploads/images/content/thumbnail/' . $slide->thumbnail) }}" class="d-block w-100"
                            alt="{{ $slide->thumbnail }}" />
                        <div class="carousel-caption d-flex h-100 justify-content-center">
                            <a href="#">
                                <h3 class="text-white font-30 mb-5">{{ $slide->title }}</h3>
                            </a>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
        <ol class="carousel-indicators">
            @foreach ($banner as $key => $slide)
                <li data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="{{ $key }}"
                    class="{{ $loop->first ? 'active' : '' }}"></li>
            @endforeach
        </ol>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <!-- <h1 style="padding-bottom: 1000px;">Hello, world!</h1> -->

    <!-- Content Highlight -->
    <div class="container-fluid fade-in">
        @foreach ($history as $item)
            <div class="row py-5 px-7">
                <h1 class="font-title text-center mb-5">{{ $item->title }}</h1>
                <div class="col-sm-6 col-lg-6 fade-in">
                    <img class="img-fluid img-rounded-custom"
                        src="{{ asset('uploads/images/profile/history/' . $item->thumbnail) }}" alt="">
                </div>
                <div class="col-sm-6 col-lg-6 d-flex align-items-center fade-in">
                    <h6 class="img-desc">{!! strip_tags($item->description) !!}
                    </h6>
                    <a href="{{ route('home.detail.history') }}" class="btn btn-md rounded-4 mt-3 btn-detail">Baca
                        Selengkapnya</a>

                </div>
            </div>
        @endforeach

    </div>

    <div class="background-image-overlay d-flex align-items-center justify-content-center">
        <div class="overlay-divider"></div>
        <div class="overlay-text">
            <h1>Informasi Kediklatan Terbaru</h1>
            <a href="" class="btn btn-overlay">Lihat Selengkapnya</a>
        </div>
        <div class="overlay-divider"></div>
        <img class="img-fluid" src="{{ asset('img/dummy/img-kediklatan.jpg') }}" alt="Background Image">
    </div>

    <!-- Tabs -->
    <div class="container-fluid fade-in">
        <div class="row px-7 py-5">
            <div class="col-sm-8 col-lg-8">
                <div class="card rounded-4 fade-in">

                    <div class="card-header rounded-top-4">
                        <ul class="nav nav-pills mb-3 d-flex justify-content-center" id="pills-tab" role="tablist">
                            @foreach ($constant as $key => $category)
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link {{ $loop->first ? 'active' : '' }} fs-custom"
                                        id="{{ $category['label'] }}-tab" data-bs-toggle="pill"
                                        data-bs-target="#{{ $category['label'] }}" type="button" role="tab"
                                        aria-controls="{{ $category['label'] }}"
                                        aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                        {{ $category['label'] }}
                                    </button>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="card-body">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="Berita" role="tabpanel"
                                aria-labelledby="pills-home-tab" tabindex="0">
                                @include('front.landing.components.postnews')
                            </div>
                            <div class="tab-pane fade" id="Artikel" role="tabpanel" aria-labelledby="pills-profile-tab"
                                tabindex="0">
                                @include('front.landing.components.postarticle')
                            </div>
                            <div class="tab-pane fade" id="Informasi" role="tabpanel" aria-labelledby="pills-contact-tab"
                                tabindex="0">
                                @include('front.landing.components.postinformation')
                            </div>
                        </div>
                    </div>




                    {{-- <nav aria-label="content">
                        <ul class="pagination d-flex justify-content-center">
                            <li class="page-item disabled">
                                <span class="page-link">Previous</span>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item" aria-current="page">
                                <a class="page-link" href="#">2</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav> --}}
                </div>
            </div>
            <div class="col-sm-4 col-lg-4">
                <div class="card rounded-4 card-information fade-in">
                    <div class="card-header rounded-top-4 d-flex align-items-center">
                        <h4 class="fs-custom2">LAYANAN INFORMASI</h4>
                    </div>
                    <div class="card-body">
                        <a href="#" class=" text-decoration-none text-dark btn btn-outline-light btn-banner "
                            style="background-image: url('{{ asset('img/banner-tombol-dump/kediklatan.png') }}');">
                        </a>
                        <a href="#" class=" text-decoration-none text-dark btn btn-outline-light btn-banner "
                            style="background-image: url('{{ asset('img/banner-tombol-dump/pengumuman.png') }}');">
                        </a>
                    </div>
                </div>
                <div class="card rounded-4 mt-4 fade-in">
                    <div class="card-header card-header-custom rounded-top-4 d-flex align-items-center">
                        <h4 class="fs-custom2 mb-1 mt-2">SOSIAL MEDIA</h4>
                        <div>
                            <a href="https://www.instagram.com/balai_diklat_kkb_banyumas" target="_blank"
                                class="me-2 text-decoration-none">
                                <iconify-icon inline icon="skill-icons:instagram" width="32" height="32">
                                </iconify-icon>
                            </a>
                            <a href="#" target="_blank" class="me-2 text-decoration-none">
                                <iconify-icon inline icon="logos:facebook" width="31" height="31"></iconify-icon>
                            </a>
                            <a href="" target="_blank" class="me-2 text-decoration-none">
                                <iconify-icon inline icon="logos:youtube-icon" width="33" height="33">
                                </iconify-icon>
                            </a>
                        </div>
                    </div>
                    <div class="card-body card-body-custom">
                        <blockquote class="instagram-media rounded-4"
                            data-instgrm-permalink="https://www.instagram.com/balai_diklat_kkb_banyumas"
                            data-instgrm-version="12">
                        </blockquote>
                    </div>
                </div>
                <div class="card rounded-4 mt-4 fade-in">
                    <div class="card-header rounded-top-4 d-flex align-items-center">
                        <h4 class="fs-custom2">LOKASI</h4>
                        <div>

                        </div>
                    </div>
                    <div class="card-body card-body-custom fade-in">
                        <div class="flex justify-center">
                            <div class="mapouter">
                                <div class="gmap_canvas">
                                    <iframe class="gmap_iframe" frameborder="0" scrolling="no" marginheight="0"
                                        marginwidth="0"
                                        src="https://maps.google.com/maps?width=350&amp;height=255&amp;hl=en&amp;q=Balai Diklat KKB Banyumas&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed">
                                    </iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        // $(document).ready(function() {
        //     $(document).on('click', '#pagination-news li a', function(e) {
        //         e.preventDefault();
        //         var url = $(this).attr('href');
        //         $.ajax({
        //             url: url,
        //             success: function(response) {
        //                 $('#Berita').html(response);
        //             }
        //         });
        //     });
        // });
    </script>
@endpush

@push('css')
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tw-elements/dist/css/index.min.css" /> --}}
@endpush

@push('js')
    <script src="https://code.iconify.design/iconify-icon/1.0.2/iconify-icon.min.js"></script>

    <!-- js Tabs -->
    <script type="text/javascript">
        function changeAtiveTab(event, tabID) {
            let element = event.target;
            while (element.nodeName !== "A") {
                element = element.parentNode;
            }
            ulElement = element.parentNode.parentNode;
            aElements = ulElement.querySelectorAll("li > a");
            tabContents = document.getElementById("tabs-id").querySelectorAll(".tab-content > div");
            for (let i = 0; i < aElements.length; i++) {

                aElements[i].classList.remove("border-black");
                aElements[i].classList.remove("border-b-4");
                tabContents[i].classList.add("hidden");
                tabContents[i].classList.remove("block");
            }
            element.classList.add("border-white");
            element.classList.add("border-b-4");
            document.getElementById(tabID).classList.remove("hidden");
            document.getElementById(tabID).classList.add("block");
        }
    </script>
    <script>
        function applyLineClamp() {
            var element = document.getElementById('description');
            var lineHeight = parseFloat(window.getComputedStyle(element).lineHeight);
            var maxHeight = lineHeight * 3; // Ganti angka 3 dengan jumlah baris yang Anda inginkan

            var text = element.innerText;
            var truncatedText = text;

            while (element.scrollHeight > maxHeight) {
                truncatedText = truncatedText.slice(0, -1);
                element.innerText = truncatedText + '...';
            }
        }

        // Panggil fungsi applyLineClamp setelah konten selesai dimuat
        window.addEventListener('DOMContentLoaded', applyLineClamp);
    </script>
@endpush
