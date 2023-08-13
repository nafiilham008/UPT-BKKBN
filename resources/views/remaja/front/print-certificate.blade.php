<!DOCTYPE html>
<html>

<head>
    <title>Certificate - {{ $resultQuiz->quiz->title }} - {{ Auth()->user()->name }}</title>
    <style>
        @media print {
            @page {
                size: landscape;
            }

            .print-layout {
                width: 100%;
                border: 4px solid black;
                border-radius: 4px;
            }
        }
    </style>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" />
</head>

<body onload="window.print()">
    <div>

    </div>
    <div class="relative">
        <img src="{{ asset('img/remaja/assets/sertifikat.svg') }}" class="w-full" alt="">
        <div class="absolute top-[280px] left-[95px]">
            <h1 class="font-montserrat font-semibold text-2xl">{{ $resultQuiz->users->name }}</h1>
        </div>
        <div class="absolute top-80 left-[95px]">
            <h1 class="font-montserrat  text-xs w-[360px]">Telah Menyelesaikan Game <label
                    class="font-semibold">{{ $resultQuiz->quiz->title }}</label> pada <label
                    class="font-semibold">{{ $resultQuiz->created_at->format('j, F Y') }}</label></h1>
        </div>
        <div class="absolute top-[515px] left-[95px] w-36">
            <h1 class="font-montserrat font-semibold text-center text-sm">{{ $resultQuiz->quiz->users->name }}</h1>
        </div>
        <div class="absolute top-[550px] left-[95px] w-36">
            <h1 class="font-montserrat text-center text-xs">Pengajar</h1>
        </div>
        <div class="absolute top-[450px] left-20">
            <img src="{{ asset('img/remaja/assets/tanda tangan.png') }}" class="w-40 h-auto" alt="">
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</body>

</html>
