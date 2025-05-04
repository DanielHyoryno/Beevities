@extends('user.layouts.app')
@section('title', $article->title)

@section('content')
<div class="container mt-4">
    <h1>{{ $article->title }}</h1>
    <p class="text-muted">{{ $article->created_at->format('d M Y') }}</p>
    <img src="{{ $article->image ?? asset('placeholder.png') }}" class="w-100 mb-3" style="max-height: 300px; object-fit: cover;" alt="{{ $article->title }}">
    <p>{{ $article->content }}</p>
</div>
@endsection
