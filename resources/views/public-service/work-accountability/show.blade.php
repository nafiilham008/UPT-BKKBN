@extends('layouts.app')

@section('title', __('Detail Work Accountability'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('Work Accountability') }}</h3>
                    <p class="text-subtitle text-muted">
                        {{ __('Detail work accountability content.') }}
                    </p>
                </div>

                <x-breadcrumb>
                    <li class="breadcrumb-item">
                        <a href="{{ url('dashboard') }}">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('work-accountabilities.index') }}">{{ __('Work Accountability') }}</a>
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
                                        <td class="fw-bold">{{ __('Year') }}</td>
                                        <td><span class="badge bg-success">{{ $workAccountability->year }}</span></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Link') }}</td>
                                        <td>{{ $workAccountability->link }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Additional') }}</td>
                                        <td>{{ isset($workAccountability->additional) ? $workAccountability->additional : '-' }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Created at') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($workAccountability->created_at)->format('j F, Y H:i') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Updated at') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($workAccountability->updated_at)->format('j F, Y H:i') }}
                                        </td>
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
