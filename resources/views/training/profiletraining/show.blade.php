@extends('layouts.app')

@section('title', __('Detail Profile Training'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('Profile Training') }}</h3>
                    <p class="text-subtitle text-muted">
                        {{ __('Detail profile training content information.') }}
                    </p>
                </div>

                <x-breadcrumb>
                    <li class="breadcrumb-item">
                        <a href="{{ url('dashboard') }}">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('dashboard.profiletrainings.index') }}">{{ __('Profile Training') }}</a>
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
                                        <td class="fw-bold">{{ __('Type') }}</td>
                                        <td><span class="badge bg-success">{{ $profileTraining->type }}</span></td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Model') }}</td>
                                        <td>{{ $profileTraining->model }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Training Name') }}</td>
                                        <td>{{ $profileTraining->training_name }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Description') }}</td>
                                        <td>{{ $profileTraining->description }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Training Goal') }}</td>
                                        <td>{{ $profileTraining->training_goal }}</td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Created at') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($profileTraining->created_at)->format('j F, Y H:i') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="fw-bold">{{ __('Updated at') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($profileTraining->updated_at)->format('j F, Y H:i') }}
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
