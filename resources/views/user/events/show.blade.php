@extends('user.layouts.app')
@section('title', $event->title)

@section('content')
<div class="container mt-4">
    <h1>{{ $event->title }}</h1>
    <p class="text-muted">{{ $event->event_date ? $event->event_date->format('d M Y') : '-' }}</p>
    <img src="{{ $event->image ?? asset('placeholder.png') }}" class="w-100 mb-3" style="max-height: 300px; object-fit: cover;" alt="{{ $event->title }}">
    <p>{{ $event->description }}</p>
</div>
@endsection
