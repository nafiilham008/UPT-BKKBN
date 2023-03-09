@extends('layouts.app')

@section('title', __('Detail Post'))

@section('content')
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-8 order-md-1 order-last">
                    <h3>{{ __('Post') }}</h3>
                    <p class="text-subtitle text-muted">
                        {{ __('Detail post content information.') }}
                    </p>
                </div>

                <x-breadcrumb>
                    <li class="breadcrumb-item">
                        <a href="/">{{ __('Dashboard') }}</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('highlights.index') }}">{{ __('Highlight') }}</a>
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
                        <form action="{{ route('highlights.update', $post->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-striped">
                                        <tr>
                                            <td colspan="2" class="text-center">
                                                <img src="{{ asset('uploads/images/content/thumbnail/' . $post->thumbnail) }}"
                                                    alt="Avatar">
                                                {{-- <div class="avatar avatar-xl">
                                            </div> --}}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">{{ __('Title Content') }}</td>
                                            <td>{{ $post->title }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">{{ __('Description') }}</td>
                                            <td>{!! $post->description !!}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">{{ __('Status') }}</td>
                                            <td><span
                                                    class="badge bg-info">{{ $post->status == 1 ? 'Tampilkan' : 'Sembunyikan' }}</span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="fw-bold">{{ __('Created at') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($post->created_at)->format('j F, Y H:i') }}</td>
                                        </tr>
                                        <tr>
                                            <td class="fw-bold">{{ __('Updated at') }}</td>
                                            <td>{{ \Carbon\Carbon::parse($post->updated_at)->format('j F, Y H:i') }}</td>
                                        </tr>
                                        <tr>

                                            <td class="fw-bold">{{ __('Banner') }}</td>
                                            <td>
                                                <fieldset
                                                    class="form-group {{ $errors->has('highlight') ? ' has-error' : '' }}">
                                                    <select class="form-select" id="highlight" name="highlight">
                                                        <option value="1"
                                                            {{ $post->highlight == 1 ? 'selected' : '' }}>
                                                            Aktif</option>
                                                        <option value="0"
                                                            {{ $post->highlight == 0 ? 'selected' : '' }}>
                                                            Tidak Aktif</option>
                                                    </select>
                                                </fieldset>
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                                <a href="{{ url()->previous() }}" class="btn btn-secondary">{{ __('Back') }}</a>
                                <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
