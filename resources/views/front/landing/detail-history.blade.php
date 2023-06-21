@extends('layouts.front.app')

@section('title', __($history->title))

@section('content')
    <div class="container-fluid detail-news">
        <h2 class="detail-news-title mb-3">{{ $history->title }}</h2>
        <div class="d-flex">
            <i class="bi bi-calendar2 date-news-detail"></i>
            <p class="date-news-text">{{ $history->created_at->format('d F Y') }}</p>
            <i class="bi bi-clock clock-news-detail"></i>
            <p class="clock-news-text">{{ $history->created_at->format('H:i:s') }}</p>
        </div>
        <div class="d-flex justify-content-center">
            <img class="rounded-5 img-news-detail" src="{{ asset('uploads/images/profile/history/' . $history->thumbnail) }}"
                alt="">
        </div>
        <div class="mt-5">
            {{-- <h6>Penulis: {{ $history->users->name }}</h6> --}}
            {!! str_replace(
                ['<img ', '<span '],
                ["<img class='img-fluid-summernote' ", "<span class='span-text-summernote' "],
                $history->description,
            ) !!}
        </div>

        <div class="d-flex align-items-end">
            <h6 class="me-4">Bagikan</h6>
            <a href="{{ 'https://www.facebook.com/sharer.php?u=' . route('home.detail.history') }}" target="_blank"
                class="me-2 text-decoration-none">
                <iconify-icon inline icon="logos:facebook" width="30" height="30"></iconify-icon>
            </a>
            <a href="https://api.whatsapp.com/send?text={{ urlencode(route('home.detail.history')) }}" target="_blank"
                class="me-2 text-decoration-none">
                <iconify-icon inline icon="logos:whatsapp-icon" width="33" height="33"></iconify-icon>
            </a>
            <a href="https://t.me/share/url?url={{ urlencode(route('home.detail.history')) }}" target="_blank"
                class="text-decoration-none">
                <iconify-icon inline icon="logos:telegram" width="30" height="30"></iconify-icon>
            </a>
        </div>
        {{-- <hr class="border border-dark border-3 opacity-100"> --}}




    </div>
@endsection