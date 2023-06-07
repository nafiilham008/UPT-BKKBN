@extends('layouts.front.app')

@section('title', __('Information'))

@section('content')
    <div class="background-image-profile d-flex align-items-center justify-content-center">
        <div class="profile-text">
            <h3>Informasi Beasiswa</h3>
            <p>Kumpulan informasi terkait Beasiswa UPT Balai Diklat KKB Banyumas ataupun pihak lain</p>
        </div>
        {{-- <img class="img-fluid" src="{{ asset('uploads/images/profile/history/' . $item->thumbnail) }}" alt="Background Image"> --}}
        <img class="img-fluid" src="{{ asset('img/dummy/img-kediklatan-2.jpg') }}" alt="Background Image">
    </div>



    <div class="container-fluid detail-news" id="beasiswa">
        <h2 class="text-center bold-text mb-5">Beasiswa</h2>

        <div class="gallery-image">
            @if (!empty($scholarship))
                @foreach ($scholarship as $item)
                    <div class="img-box">
                        <a href="#" data-bs-toggle="modal" data-target="#detail-scholarship{{ $item->id }}"
                            data-id="{{ $item->id }}">
                            <img class="img-banner-scholarship"
                                src="{{ asset('uploads/images/information/scholarship/' . $item->photo) }}"
                                alt="" />
                        </a>
                    </div>
                @endforeach
            @else
                <p>Beasiswa belum tersedia.</p>
            @endif
        </div>

        @foreach ($scholarship as $item)
            @include('front.scholarship.include.modal-scholarship', [
                'id' => $item->id,
            ])
        @endforeach

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
            max-width: 100%;
            height: auto;
            max-height: 800px;
            /* Ubah angka ini sesuai kebutuhan */
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
