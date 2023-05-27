@extends('layouts.front.app')

@section('title', __('Dokumentasi'))

@section('content')
    <div class="background-image-profile d-flex align-items-center justify-content-center">
        <div class="profile-text">
            <h3>Dokumentasi</h3>
            <p>Kumpulan dokumentasi dari berita, artikel, informasi UPT Balai Diklat KKB Banyumas</p>
        </div>
        {{-- <img class="img-fluid" src="{{ asset('uploads/images/profile/history/' . $item->thumbnail) }}" alt="Background Image"> --}}
        <img class="img-fluid" src="{{ asset('img/dummy/img-kediklatan.jpg') }}" alt="Background Image">
    </div>
    
    <div class="container-fluid detail-news fade-in" id="galeri-foto">
        <h2 class="text-center bold-text mb-5">Galeri Foto</h2>

        <div class="gallery-image">
            @if (count($gallery) > 0)
                @foreach ($gallery as $image)
                    @php
                        $image->fresh(); // Memperbarui objek $image dari database
                    @endphp
                    <div class="img-box">
                        <img class="img-rounded-custom-detail"
                            src="{{ asset('uploads/images/content/thumbnail/' . $image->posts->thumbnail) }}"
                            alt="{{ $image->title }}" />
                        <div class="transparent-box">
                            <div class="caption-doc">
                                <p>{{ $image->title }}</p>
                                <p class="opacity-low">{{ $image->posts->categories->label }}</p>
                            </div>
                        </div>
                    </div>

                    @php
                        $description = $image->posts->description;
                        $dom = new DOMDocument();
                        libxml_use_internal_errors(true);
                        $dom->loadHTML($description);
                        libxml_use_internal_errors(false);
                        $imgElements = $dom->getElementsByTagName('img');
                    @endphp

                    @if ($imgElements->length > 0)
                        @foreach ($imgElements as $img)
                            <div class="img-box">
                                <img class="img-rounded-custom-detail" src="{{ $img->getAttribute('src') }}"
                                    alt="" />
                                <div class="transparent-box">
                                    <div class="caption-doc">
                                        <p>Detail {{ $image->posts->categories->label }}</p>
                                        <p class="opacity-low"> {{ $image->title }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                @endforeach
            @endif
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

        .img-box {
            box-sizing: content-box;
            margin: 10px;
            height: 300px;
            width: 450px;
            overflow: hidden;
            display: inline-block;
            position: relative;
            border-radius: 1.5rem;

        }

        .img-box img {
            height: 100%;
            width: 100%;
            object-fit: cover;
            transform: scale(1.0);
            transition: transform 0.4s ease;
        }

        .transparent-box {
            height: 100%;
            width: 100%;
            background-color: rgba(0, 0, 0, 0);
            position: absolute;
            top: 0;
            left: 0;
            transition: background-color 0.3s ease;
        }

        .caption-doc {
            position: absolute;
            bottom: 10px;
            left: 10px;
            opacity: 0;
            transition: transform 0.3s ease, opacity 0.3s ease;
            z-index: 1;
            color: white;
        }

        .img-box:hover img {
            transform: scale(1.1);
        }

        .img-box:hover .transparent-box {
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 1.5rem !important;
        }

        .img-box:hover .caption-doc {
            transform: translateY(-20px);
            opacity: 1;
        }

        .caption-doc>p:nth-child(2) {
            font-size: 0.8em;
            margin-top: 5px;
        }

        .opacity-low {
            opacity: 0.5;
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
    
@endpush
