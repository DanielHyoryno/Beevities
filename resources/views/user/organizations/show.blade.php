@extends('user.layouts.app')
@section('title', $organization->name)

@section('styles')
<style>

    .banner-wrapper {
        background-color: #fff;
        padding: 0px;
        box-shadow: 0 9px 12px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
    }

    .banner-wrapper img {
        width: 100%;
        height: 56.25vh;
        object-fit: cover;
    }

    .section-title {
        border-top: 3px solid #ccc;
        border-bottom: 3px solid #ccc;
        padding: 0.5rem;
        text-align: center;
        font-weight: bold;
        font-size: 1.5rem;
        margin: 2rem 0 1rem;
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

    .btn-action {
        display: block;
        width: 100%;
        text-align: center;
        padding: 0.5rem;
        background: #2563eb;
        color: #fff;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
        margin-top: 0.5rem;
        transition: background-color 0.2s ease;
        border: none;
    }

    .btn-action:hover {
        background-color: #1e40af;
    }

    .merch-group {
        display: flex;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .merch-label-box {
        width: 550px;
        background-color: #2563eb;
        color: white;
        font-weight: bold;
        font-size: 1.7rem;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        text-align: center;
    }

    .merch-row {
        display: grid;
        margin: 10px;
        flex: 1;
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 3rem;
    }

    @media (max-width: 768px) {
        .container {
            padding-left: 1rem;
            padding-right: 1rem;
        }
        .merch-group {
            flex-direction: column;
        }
        .merch-label-box {
            width: 100%;
        }
        .merch-row {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')

    <!-- Banner -->
    <div class="banner-wrapper">
        <img src="{{ ResolveImage($organization->banner_image) }}" alt="Banner">
    </div>

<div class="container mt-4">

    <!-- Info -->
    <h1 class="mt-4 mb-2">{{ $organization->name }}</h1>
    <p class="text-muted">{{ $organization->description }}</p>

    <!-- Events -->
    <div class="section-title">EVENTS</div>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach ($organization->events as $event)
            <div class="col">
                <div class="card">
                    <img src="{{ ResolveImage($event->image) }}" class="card-img-top" alt="{{ $event->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $event->title }}</h5>
                        <p class="card-text">{{ Str::limit($event->description, 80) }}</p>
                        <a href="{{ route('events.show', $event->id) }}" class="btn-action">View Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Articles -->
    <div class="section-title">ARTICLES</div>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        @foreach ($organization->articles as $article)
            <div class="col">
                <div class="card">
                    <img src="{{ ResolveImage($article->image) }}" class="card-img-top" alt="{{ $article->title }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $article->title }}</h5>
                        <p class="card-text">{{ Str::limit($article->description, 80) }}</p>
                        <a href="{{ route('articles.show', $article->id) }}" class="btn-action">Read More</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Merchandise -->
    <div class="section-title">MERCHANDISE</div>

    <!-- First row with label -->
    <div class="merch-group">
        <div class="merch-label-box">Featured Products from {{ $organization->name }}</div>
        <div class="merch-row">
    @foreach ($organization->products->take(4) as $product)
        <div class="card">
            <img src="{{ ResolveImage($product->image) }}" class="card-img-top" alt="{{ $product->name }}">
            <div class="card-body">
                <h6 class="card-title">{{ $product->name }}</h6>
                <p class="card-text">Rp. {{ number_format($product->price) }}</p>
                <p class="card-text">Stock: {{ number_format($product->stock) }}</p>
                <form method="POST" action="{{ route('user.cart.add', $product->id) }}">
                    @csrf
                    <input type="number" name="quantity" class="form-control" min="1" max="{{ $product->stock }}" value="1" required>
                    <button type="submit" class="btn-action mt-2">Add to Cart</button>
                </form>
            </div>
        </div>
    @endforeach
        </div>
    </div>


    <div class="merch-group">
        <div class="merch-row">
    @foreach ($organization->products->skip(4) as $product)
        <div class="card">
            <img src="{{ ResolveImage($product->image) }}" class="card-img-top" alt="{{ $product->name }}">
            <div class="card-body">
                <h6 class="card-title">{{ $product->name }}</h6>
                <p class="card-text">Rp. {{ number_format($product->price) }}</p>
                <p class="card-text">Stock: {{ number_format($product->stock) }}</p>
                <form method="POST" action="{{ route('user.cart.add', $product->id) }}">
                    @csrf
                    <input type="number" name="quantity" class="form-control" min="1" max="{{ $product->stock }}" value="1" required>
                    <button type="submit" class="btn-action mt-2">Add to Cart</button>
                </form>
            </div>
        </div>
    @endforeach
        </div>
    </div>
</div>
@endsection
