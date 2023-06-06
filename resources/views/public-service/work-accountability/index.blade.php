@extends('layouts.app')

@section('title', __('Work Accountability'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('Work Accountability') }}</h3>
                    <p class="text-subtitle text-muted">
                        {{ __('Below is a list of work accountability.') }}
                    </p>
                </div>
                <x-breadcrumb>
                    <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Work Accountability') }}</li>
                </x-breadcrumb>
            </div>
        </div>

        <section class="section">
            <x-alert></x-alert>

            @can('work-accountability create')
                <div class="d-flex justify-content-end">
                    <a href="{{ route('work-accountabilities.create') }}" class="btn btn-primary mb-3">
                        <i class="fas fa-plus"></i>
                        {{ __('Add work accountability') }}
                    </a>
                </div>
            @endcan

            <div class="row">
                <div class="col-md-12">
                    <div class="section">
                        <div class="card">
                            <div class="card-body">

                                <table class="table table-striped" id="table1">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Additional</th>
                                            <th>Link</th>
                                            <th>Created At</th>
                                            <th>Updated At</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($workAccountability as $item)
                                            <tr>
                                                <td><span class="badge bg-success">{{ $item->year }}</span></td>
                                                <td>{{ isset($item->additional) ? $item->additional : '-' }}</td>
                                                <td>{{ $item->link }}</td>
                                                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('j F, Y H:i') }}
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($item->updated_at)->format('j F, Y H:i') }}
                                                </td>
                                                @include('public-service.work-accountability.include.action')
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
