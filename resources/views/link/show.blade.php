@extends('layouts.app')

@section('title', __('Detail Link'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('Link') }}</h3>
                    <p class="text-subtitle text-muted">
                        {{ __('Detail link content information.') }}
                    </p>
                </div>

                <x-breadcrumb>
                    <li class="breadcrumb-item">
                        <a href="{{ url('dashboard') }}">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard.links.index') }}">{{ __('Link') }}</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">
                        {{ __('Detail') }}
                    </li>
                </x-breadcrumb>
            </div>
        </div>

        <section class="section">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover table-striped">
                                    <tr>
                                        <td colspan="2" class="text-center">
                                            <div class="avatar avatar-xl">
                                                <img src="{{ asset('storage/' . $link->photo) }}"
                                                    alt="Avatar">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Title') }}</td>
                                        <td>{{ $link->title }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Type') }}</td>
                                        <td><span class="badge bg-success">{{ $link->type }}</span></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Link') }}</td>
                                        <td>{{ $link->link }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Created at') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($link->created_at)->format('j F, Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Updated at') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($link->updated_at)->format('j F, Y H:i') }}</td>
                                    </tr>
                                </table>
                            </div>

                            <a href="{{ url()->previous() }}" class="btn btn-secondary">{{ __('Back') }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
