@extends('user.layouts.app')
@section('title', $organization->name)

@section('styles')
<style>
    .banner-wrapper {
        background-color: #fff;
        border-radius: 20px;
        padding: 2px;
        box-shadow: 0 9px 12px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
    }

    .banner-wrapper img {
        width: 100%;
        height: 56.25vh;
        object-fit: cover;
        border-radius: 16px;
    }

    .banner-separator {
        margin-top: 2rem;
        border-bottom: 1px solid #dee2e6;
    }

    .card {
        border-radius: 20px;
        overflow: hidden;
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: transform 0.4s ease, box-shadow 0.4s ease;
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.08);
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .card:hover {
        transform: scale(1.03);
        box-shadow: 0 16px 32px rgba(37, 99, 235, 0.25);
    }

    .card-img-top {
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
        height: 150px;
        object-fit: cover;
    }

    .card-body {
        display: flex;
        flex-direction: column;
        flex-grow: 1;
        padding: 1rem;
    }

    .card-text {
        flex-grow: 1;
        margin-bottom: 1rem;
    }

    .animated-card {
        animation: fadeSlideUp 1.2s ease forwards;
        opacity: 0;
        will-change: transform, opacity;
    }

    @keyframes fadeSlideUp {
        0% {
            opacity: 0;
            transform: translateY(15px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .view-details,
    .read-more,
    .AddToCart {
        background: linear-gradient(90deg, #3b82f6, #1d4ed8);
        color: #fff;
        width: 100%;
        border-radius: 10px;
        padding: 8px 0;
        text-align: center;
        border: none;
        font-weight: 500;
        box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        margin-top: auto;
        font-size: 0.9rem;
    }

    .view-details:hover,
    .read-more:hover,
    .AddToCart:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .ViewDetails,
    .ReadMore {
        text-decoration: none;
        display: block;
    }

    .form-control {
        border-radius: 12px;
        margin-bottom: 10px;
    }

    .text-muted {
        text-align: center;
    }

    .mb-3 {
        text-align: center;
        margin-top: 50px;
    }

    h2,
    h1 {
        font-weight: bold;
    }

    .row {
        margin-left: 0;
        margin-right: 0;
    }

    .col {
        padding: 0.75rem;
    }

    /* Smaller Card for Merchandise */
    .card.card-small {
        min-height: 240px;
        font-size: 0.8rem;
        padding: 0.5rem;
    }

    .card.card-small .card-img-top {
        height: 100px;
    }

    .card.card-small .card-title {
        font-size: 1rem;
    }

    .card.card-small .card-text {
        font-size: 0.85rem;
    }

    .card.card-small .card-body {
        padding: 0.75rem;
    }

    .card.card-small .AddToCart {
        font-size: 0.75rem;
        padding: 6px 0;
    }

    .card.card-small .form-control {
        font-size: 0.75rem;
    }
</style>
@endsection

@section('content')
<div class="container mt-4">

    <!-- Banner -->
    <div class="banner-wrapper">
        <img src="{{ $organization->banner_image ?? asset('placeholder.png') }}" alt="Banner">
    </div>
    <div class="banner-separator"></div>

    <!-- Info -->
    <h1 class="mb-3">{{ $organization->name }}</h1>
    <p class="text-muted">{{ $organization->description }}</p>

    <!-- Events -->
    <h2 class="mt-4">Events</h2>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach ($organization->events as $index => $event)
            <div class="col">
                <div class="card animated-card" style="animation-delay: {{ $index * 0.1 }}s;">
                    <img src="{{ $event->image ?? asset('placeholder.png') }}" class="card-img-top" alt="{{ $event->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $event->title }}</h5>
                        <p class="card-text">{{ Str::limit($event->description, 80) }}</p>
                        <a href="{{ route('events.show', $event->id) }}" class="ViewDetails">
                            <div class="view-details">View Details</div>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Articles -->
    <h2 class="mt-4">Articles</h2>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach ($organization->articles as $index => $article)
            <div class="col">
                <div class="card animated-card" style="animation-delay: {{ $index * 0.1 }}s;">
                    <img src="{{ $article->image ?? asset('placeholder.png') }}" class="card-img-top" alt="{{ $article->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $article->title }}</h5>
                        <p class="card-text">{{ Str::limit($article->description, 80) }}</p>
                        <a href="{{ route('articles.show', $article->id) }}" class="ReadMore">
                            <div class="read-more">Read More</div>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Merchandise -->
    <h2 class="mt-4">Merchandise</h2>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach ($organization->products as $index => $product)
            <div class="col">
                <div class="card card-small animated-card" style="animation-delay: {{ $index * 0.1 }}s;">
                    <img src="{{ $product->image ?? asset('placeholder.png') }}" class="card-img-top" alt="{{ $product->name }}">
                    <div class="card-body">
                        <h6 class="card-title">{{ $product->name }}</h6>
                        <p class="card-text">Rp. {{ number_format($product->price) }}</p>
                        <p class="card-text">Stock: {{ number_format($product->stock) }}</p>
                        <form method="POST" action="{{ route('user.cart.add', $product->id) }}">
                            @csrf
                            <input type="number" name="quantity" class="form-control form-control-sm" min="1" max="{{ $product->stock }}" value="1" required>
                            <button type="submit" class="AddToCart btn-sm mt-2">Add to Cart</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
