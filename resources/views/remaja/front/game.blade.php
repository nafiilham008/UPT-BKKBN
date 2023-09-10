@extends('layouts.remaja.front.app')

@section('title', __('game'))

@section('content')
    <livewire:remaja.landing.home-livewire :dataQuestion="$question" />
@endsection
