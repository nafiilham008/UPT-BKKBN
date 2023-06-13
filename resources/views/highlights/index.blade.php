@extends('layouts.app')

@section('title', __('Highlight Content'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('Highlight') }}</h3>
                    <p class="text-subtitle text-muted">
                        {{ __('Below is a list of all Posts Highlight.') }}
                    </p>
                </div>
                <x-breadcrumb>
                    <li class="breadcrumb-item"><a href="/">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Highlight') }}</li>
                </x-breadcrumb>
            </div>
        </div>

        <section class="section">
            <x-alert></x-alert>
            <div class="row">
                <div class="col-md-12">
                    <div class="section">
                        <div class="card">
                            <div class="card-body">
                                <h5>{{ __('Highlights Content') }}</h5>
                                <table class="table table-striped" id="table1">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Title') }}</th>
                                            <th>{{ __('Thumbnail') }}</th>
                                            <th>{{ __('Category') }}</th>
                                            <th>{{ __('Updated At') }}</th>
                                            <th>{{ __('Banner') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($content as $item)
                                            <tr>
                                                <td>{{ $item->title }}</td>
                                                <td><img class="avatar avatar-xl"
                                                        src="{{ asset('uploads/images/content/thumbnail/' . $item->thumbnail) }}"
                                                        alt="avatar" style="height: 50px; width: 50px;"></td>
                                                <td><span class="badge bg-success">{{ $item->categories->label }}</span>
                                                </td>
                                                <td>
                                                    {{ \Carbon\Carbon::parse($item->updated_at)->format('j F, Y H:i') }}
                                                </td>
                                                <td>
                                                    <span
                                                        class="badge {{ $item->highlight == 1 ? 'bg-info' : 'bg-danger' }}">{{ $item->highlight == 1 ? 'Aktif' : 'Tidak Aktif' }}</span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('dashboard.highlights.show', $item->id) }}"
                                                        class="btn btn-outline-success btn-sm">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('mazer') }}/extensions/simple-datatables/style.css">
    <link rel="stylesheet" href="{{ asset('mazer') }}/css/pages/simple-datatables.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
        integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush

@push('js')
    <script src="{{ asset('mazer') }}/extensions/jquery/jquery.min.js"></script>
    <script src="{{ asset('mazer') }}/extensions/simple-datatables/umd/simple-datatables.js"></script>
    <script src="{{ asset('mazer') }}/js/pages/simple-datatables.js"></script>
@endpush
