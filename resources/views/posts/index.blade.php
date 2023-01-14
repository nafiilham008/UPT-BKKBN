@extends('layouts.app')

@section('title', __('Content'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('Posts') }}</h3>
                    <p class="text-subtitle text-muted">
                        {{ __('Below is a list of all Posts.') }}
                    </p>
                </div>
                <x-breadcrumb>
                    <li class="breadcrumb-item"><a href="/">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Content') }}</li>
                </x-breadcrumb>
            </div>
        </div>

        <section class="section">
            <x-alert></x-alert>

            @can('content create')
                <div class="d-flex justify-content-end">
                    <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">
                        <i class="fas fa-plus"></i>
                        {{ __('Create a new posts') }}
                    </a>
                </div>
            @endcan

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">

                            <table class="table" id="table1">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Category</th>
                                        <th>Status</th>
                                        <th>Uploaded By</th>
                                        <th>Created At</th>
                                        <th>Updated At</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($content as $item)
                                        <tr>
                                            <td>{{ $item->title }}</td>
                                            <td><span class="badge bg-success">{{ $item->categories->label }}</span></td>
                                            <td><span class="badge bg-info">{{ $item->status == 1 ? 'Tampilkan' : 'Sembunyikan' }}</span></td>
                                            <td>{{ $item->users->name }}</td>
                                            <td>{{ $item->created_at->format('d/m/Y H:i') }}</td>
                                            <td>{{ $item->updated_at->format('d/m/Y H:i') }}</td>
                                            @include('posts.include.action')
{{-- 
                                            <td>
                                                <span class="badge bg-success">Active</span>
                                            </td> --}}
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('css')
    {{-- <link rel="stylesheet" href="{{ asset('mazer') }}/css/pages/fontawesome.css"> --}}
    <link rel="stylesheet" href="{{ asset('mazer') }}/extensions/datatables.net-bs5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="{{ asset('mazer') }}/css/pages/datatables.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />

@endpush

@push('js')
    <script src="{{ asset('mazer') }}/extensions/jquery/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="{{ asset('mazer') }}/js/pages/datatables.js"></script>
@endpush
