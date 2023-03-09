@foreach ($postInformation as $item)
    <div class="row p-tab" id="Informasi">
        <div class="col-sm-5 col-lg-5">
            <img class="img-fluid-tab rounded-3" src="{{ asset('uploads/images/content/thumbnail/' . $item->thumbnail) }}"
                alt="">
        </div>
        <div class="col-sm-7 col-lg-7">
            <h6 class="tab-title">{{ $item->title }}</h6>
            <p class="tab-desc">{!! strip_tags($item->description) !!}</p>
            <div>
                <a href="{{ route('home.detail', [$item->categories->label, $item->slug_url]) }}">Baca
                    Selengkapnya</a>
            </div>
            <i class="bi bi-calendar2 date-tab"></i>
            <p class="date-text">{{ $item->created_at->format('d F Y') }}</p>
            <i class="bi bi-clock clock-tab"></i>
            <p class="clock-text">{{ $item->created_at->format('H:i:s') }}</p>
        </div>
    </div>
@endforeach
<nav aria-label="content">
    <ul class="pagination d-flex justify-content-center" id="pagination-information">
        @if ($postInformation->onFirstPage())
            <li class="page-item disabled">
                <span class="page-link">Previous</span>
            </li>
        @else
            <li class="page-item">
                <a class="page-link" href="{{ $postInformation->previousPageUrl() }}" rel="prev">Previous</a>
            </li>
        @endif

        @for ($i = 1; $i <= $postInformation->lastPage(); $i++)
            <li class="page-item {{ $postInformation->currentPage() == $i ? 'active' : '' }}">
                <a class="page-link" href="{{ $postInformation->url($i) }}">{{ $i }}</a>
            </li>
        @endfor

        @if ($postInformation->hasMorePages())
            <li class="page-item">
                <a class="page-link" href="{{ $postInformation->nextPageUrl() }}" rel="next">Next</a>
            </li>
        @else
            <li class="page-item disabled">
                <span class="page-link">Next</span>
            </li>
        @endif
    </ul>
</nav>
