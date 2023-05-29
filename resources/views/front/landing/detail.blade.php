@extends('layouts.front.app')

@section('title', __($post->categories->label . ' - ' . $post->title))

@section('content')
    <div class="container-fluid detail-news">
        <h2 class="detail-news-title mb-3">{{ $post->title }}</h2>
        <div class="d-flex">
            <i class="bi bi-calendar2 date-news-detail"></i>
            <p class="date-news-text">{{ $post->created_at->format('d F Y') }}</p>
            <i class="bi bi-clock clock-news-detail"></i>
            <p class="clock-news-text">{{ $post->created_at->format('H:i:s') }}</p>
        </div>
        <div class="d-flex justify-content-center">
            <img class="rounded-5 img-news-detail" src="{{ asset('uploads/images/content/thumbnail/' . $post->thumbnail) }}"
                alt="">
        </div>
        <div class="mt-4">
            <h6>Penulis: {{ $post->users->name }}</h6>
            {!! str_replace(
                ['<img ', '<span '],
                ["<img class='img-fluid-summernote' ", "<span class='span-text-summernote' "],
                $post->description,
            ) !!}
        </div>

        <div class="d-flex align-items-end">
            <h6 class="me-4">Bagikan</h6>
            <a href="{{ 'https://www.facebook.com/sharer.php?u=' . route('home.detail', [$post->categories->label, $post->slug_url]) }}"
                target="_blank" class="me-2 text-decoration-share">
                <iconify-icon inline icon="logos:facebook" width="30" height="30"></iconify-icon>
            </a>
            <a href="https://api.whatsapp.com/send?text={{ urlencode(route('home.detail', [$post->categories->label, $post->slug_url])) }}" target="_blank" class="me-2 text-decoration-share">
                <iconify-icon inline icon="logos:whatsapp-icon" width="33" height="33"></iconify-icon>
            </a>
            <a href="https://t.me/share/url?url={{ urlencode(route('home.detail', [$post->categories->label, $post->slug_url])) }}" target="_blank" class="text-decoration-share">
                <iconify-icon inline icon="logos:telegram" width="30" height="30"></iconify-icon>
            </a>
        </div>
        <hr class="border border-dark border-3 opacity-100">

        {{-- Terkait --}}
        <h6>{{ $post->categories->label }} Lainnya</h6>
        <div class="justify-custom-detail">
            <div class="row text-center">
                <div class="col-sm-12 col-md-12">
                    @foreach ($getCategory as $slide => $item)
                        <div class="image-wrapper">
                            <img src="{{ asset('uploads/images/content/thumbnail/' . $item->thumbnail) }}"
                                class="img-fluid-detail img-rounded-custom-detail m-2 " alt="{{ $item->thumbnail }}" />
                            <div class="caption">
                                <a class="font-other-news-tablet"
                                    href="{{ route('home.detail', [$item->categories->label, $item->slug_url]) }}">{{ $item->title }}</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>


    </div>
@endsection
