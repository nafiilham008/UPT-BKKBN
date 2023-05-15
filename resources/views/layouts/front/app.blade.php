<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    @include('layouts.front.style')

    <title>@yield('title')</title>

    <style>
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
    </style>

    @stack('css')

</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top">
        @include('layouts.front.components.menu')
    </nav>

    @yield('content')

    <div class="floating-button bg-success">
        <button type="button" class="btn btn-light" data-toggle="modal" data-target="#guestBookModal">
            <i class="fas fa-book"></i>
        </button>
    </div>

    <!-- footer -->
    @include('layouts.front.footer')

    @include('layouts.front.script')

    <script>
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
    </script>

    @stack('js')

</body>

</html>
