@extends('layouts.remaja.front.app')

@section('title', __('Game'))

@section('content')
    <livewire:remaja.landing.home-livewire :dataQuestion="$question" />
@endsection
