<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    @include('layouts.front.style')

    <link rel="icon" href="{{ asset('img/logo/logo_upt.png') }}" />


    <title>@yield('title')</title>

    {{-- <style>
        .floating-button {
            position: fixed;
            bottom: 20px;
            right: 20px;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            color: #fff;
            text-align: center;
            line-height: 60px;
            font-size: 20px;
            cursor: pointer;
            z-index: 9999;
            opacity: 0.5;
            transition: transform 0.3s, opacity 0.3s;
            transform: translateX(100%);
        }

        .floating-button:hover {
            opacity: 1;
            transform: translateX(0%);
        }

        .floating-button i {
            transition: transform 0.3s;
        }

        .floating-button:hover i {
            transform: rotate(90deg);
        }

        @media (max-width: 767px) {
            .floating-button {
                right: 10px;
                bottom: 70px;
                opacity: 1;
                transform: translateY(0%);
            }

            .floating-button:hover {
                transform: translateY(-10px);
            }
        }
    </style> --}}
    <style>
        .search-container {
            position: relative;
            display: inline-block;
            /* width: 100%; */
            /* Atur lebar sesuai kebutuhan Anda */
        }

        .search-results {
            position: absolute;
            top: 100%;
            /* Munculkan hasil pencarian di bawah input */
            left: 0;
            width: 100%;
            background-color: white;
            border: 1px solid #ccc;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            z-index: 9999;
            max-height: 200px;
            /* Atur tinggi maksimal sesuai kebutuhan Anda */
            overflow-y: auto;
            /* Aktifkan scroll jika hasil pencarian melebihi tinggi maksimal */
        }

        .search-result {
            padding: 8px 12px;
            cursor: pointer;
        }

        .search-result:hover {
            background-color: #f5f5f5;
        }

        .search-container {
            position: relative;
        }

        .expanded {
            width: 400px !important;
            /* z-index: 9999; */
        }
    </style>

    @stack('css')

</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
        @include('layouts.front.components.menu')
    </nav>

    @yield('content')
    {{-- <div class="floating-button bg-success">
        <button type="button" class="btn btn-light" data-toggle="modal" data-target="#guestBookModal">
            <i class="fas fa-book"></i>
        </button>
    </div> --}}



    <!-- footer -->
    @include('layouts.front.footer')

    @include('layouts.front.script')

    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            var floatingButton = document.querySelector('.floating-button');

            document.addEventListener('mousemove', function(event) {
                var fromRight = window.innerWidth - event.clientX;

                if (fromRight < 80) {
                    floatingButton.style.opacity = '1';
                } else {
                    floatingButton.style.opacity = '0.5';
                }
            });
        });
    </script> --}}
    <script>
        function handleLinkClick(event, url) {
            event.preventDefault(); // Mencegah perilaku default dari tautan

            window.location.href = url;
        }
    </script>
    <script>
        function expandSearchInput() {
            const searchInput = document.getElementById('expand');
            searchInput.classList.add('expanded');
        }

        function shrinkSearchInput() {
            const searchInput = document.getElementById('expand');
            searchInput.classList.remove('expanded');
        }


        window.addEventListener('DOMContentLoaded', () => {
            const searchInput = document.getElementById('searchInput');
            searchInput.addEventListener('focus', expandSearchInput);
            searchInput.addEventListener('blur', shrinkSearchInput);
        });


        // Handle
        function handleSearchInput(event) {
            const searchInput = event.target.value;
            const searchResults = document.getElementById('searchResults');

            if (searchInput.trim().length > 0) {
                // Lakukan permintaan AJAX ke endpoint pencarian
                // Misalnya, '/search'
                fetch(`/search?keyword=${encodeURIComponent(searchInput)}`)
                    .then(response => response.json())
                    .then(data => {
                        // Hapus semua hasil pencarian sebelumnya
                        while (searchResults.firstChild) {
                            searchResults.firstChild.remove();
                        }

                        // Tampilkan hasil pencarian
                        data.forEach(result => {
                            const resultItem = document.createElement('div');
                            resultItem.classList.add('search-result');
                            resultItem.textContent = result.title;
                            resultItem.addEventListener('click', () => {
                                window.location.href =
                                    `/${result.categories.label}/detail/${result.slug_url}`;
                            });
                            searchResults.appendChild(resultItem);
                        });

                        searchResults.classList.remove('d-none');
                    });
            } else {
                // Jika input pencarian kosong, hapus semua hasil pencarian
                while (searchResults.firstChild) {
                    searchResults.firstChild.remove();
                }

                searchResults.classList.add('d-none');
            }
        }
    </script>

    @stack('js')

</body>

</html>
