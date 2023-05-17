@foreach ($postNews as $item)
    <div class="row p-tab" id="Berita">
        <div class="col-sm-5 col-lg-5">
            <img class="img-fluid-tab rounded-3" src="{{ asset('uploads/images/content/thumbnail/' . $item->thumbnail) }}"
                alt="">
        </div>
        <div class="col-sm-7 col-lg-7">
            <h6 class="tab-title">{{ $item->title }}</h6>
            {{-- <p class="tab-desc">{!! strip_tags($item->description) !!}</p> --}}
            {{-- <p class="tab-desc" id="description">{!! preg_replace('/<img[^>]+>/i', '', $item->description) !!}</p> --}}
            {{-- @php
                $description = preg_replace('/<img[^>]+>/i', '', $item->description);
            @endphp

            @foreach (explode('<p>', $description) as $paragraph)
                @if (!empty(trim($paragraph)))
                    <p class="tab-desc">{!! $paragraph !!}</p>
                @endif
            @endforeach --}}
            <div class="tab-desc">
                @php
                    $description = preg_replace('/<img[^>]+>/i', '', $item->description);
                    $paragraphs = explode('<p>', $description);
                    $filteredParagraphs = array_filter($paragraphs);
                    $mergedParagraph = implode(' ', $filteredParagraphs);
                @endphp

                <p>{!! $mergedParagraph !!}</p>
            </div>


            <div>
                <a href="{{ route('home.detail', [$item->categories->label, $item->slug_url]) }}">Baca
                    Selengkapnya</a>
            </div>
            <div class="d-flex ">
                <i class="bi bi-calendar2 date-tab"></i>
                <p class="date-text">{{ $item->created_at->format('d F Y') }}</p>
                <i class="bi bi-clock clock-tab"></i>
                <p class="clock-text">{{ $item->created_at->format('H:i:s') }}</p>
            </div>
        </div>
    </div>
@endforeach
<nav aria-label="content">
    <ul class="pagination d-flex justify-content-center" id="pagination-news">
        @if ($postNews->onFirstPage())
            <li class="page-item disabled">
                <span class="page-link">Previous</span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $postNews->previousPageUrl() }}" rel="prev">Previous</a>
            </li>
        @endif

        @for ($i = 1; $i <= $postNews->lastPage(); $i++)
            <li class="page-item {{ $postNews->currentPage() == $i ? 'active' : '' }}">
                <a class="page-link" href="{{ $postNews->url($i) }}">{{ $i }}</a>
            </li>
        @endfor

        @if ($postNews->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $postNews->nextPageUrl() }}" rel="next">Next</a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link">Next</span>
            </li>
        @endif
    </ul>
</nav>
