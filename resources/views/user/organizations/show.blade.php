@extends('user.layouts.app')
@section('content')

@section('styles')
<style>
    .AddToCart{
        background-color: rgb(45, 58, 236);
        color: rgb(240, 231, 231);
        width: 100%;
        height: auto;
        border-radius: 12px;
        border-style: none;
        margin-top: 10px;
        padding-top: 5px;
        padding-bottom: 5px;
        transition: all 0.3s ease;
    }

    .AddToCart:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .w-100{
        width: 100vh;
        height: 56.25vh;
        border-radius: 16px;
    }

    .view-details, .read-more{
        background-color: rgb(45, 58, 236);
        color: rgb(240, 231, 231);
        width: 300px;
        height: auto;
        border-radius: 12px;
        border-style: none;
        margin-top: 10px;
        padding-top: 5px;
        padding-bottom: 5px;
        text-decoration: none;
        text-align: center;
        transition: all 0.3s ease;
    }

    .view-details:hover, .read-more:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    .ViewDetails, .ReadMore{
        text-decoration: none;
    }

    .mb-3 {
        text-align: center;
        margin-top: 50px;
    }

    .text-muted{
        text-align: center;
    }

    h2, h1{
        font-weight: bold;
    }

    .card {
        border-radius: 16px;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }

    .card-img-top {
        border-top-left-radius: 16px;
        border-top-right-radius: 16px;
    }

    .form-control {
        border-radius: 12px;
        margin-bottom: 10px;
    }
</style>
@endsection
    

<div class="container mt-4">
    <!-- Organization Banner -->
    <div class="mb-4">
        @if($organization->banner_image)
            <img src="{{$organization->banner_image}}" alt="Banner" class="w-100" >
        @else
            <img src="{{ asset('placeholder.png') }}" alt="Placeholder" class="w-100">
        @endif
    </div>

    <!-- Organization Info -->
    <h1 class="mb-3">{{ $organization->name }}</h1>
    <p class="text-muted">{{ $organization->description }}</p>

    <!-- Events Section -->
    <h2 class="mt-4">Events</h2>
    <div class="d-flex overflow-auto gap-3 pb-3">
        @foreach ($organization->events as $event)
            <div class="card shadow-sm" style="min-width: 300px;">
                @if($event->image)
                    <img src="{{ $event->image }}" class="card-img-top" alt="{{ $event->title }}" style="height: 150px; object-fit: cover;">
                @else
                    <img src="{{ asset('placeholder.png') }}" class="card-img-top" alt="Placeholder" style="height: 150px; object-fit: cover;">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $event->title }}</h5>
                    <p class="card-text">{{ Str::limit($event->description, 80) }}</p>
                    <a href="{{ route('events.show', $event->id) }}" class="ViewDetails"><div class = "view-details">View Details</div></a>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Articles Section -->
    <h2 class="mt-4">Articles</h2>
    <div class="d-flex overflow-auto gap-3 pb-3">
        @foreach ($organization->articles as $article)
            <div class="card shadow-sm" style="min-width: 300px;">
                @if($article->image)
                    <img src="{{ $article->image }}" class="card-img-top" alt="{{ $article->title }}" style="height: 150px; object-fit: cover;">
                @else
                    <img src="{{ asset('placeholder.png') }}" class="card-img-top" alt="Placeholder" style="height: 150px; object-fit: cover;">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $article->title }}</h5>
                    <p class="card-text">{{ Str::limit($article->description, 80) }}</p>
                    <a href="{{ route('articles.show', $article->id) }}" class="ReadMore"><div class = "read-more">Read More</div></a>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Merchandise Section -->
    <h2 class="mt-4">Merchandise</h2>
    <div class="d-flex overflow-auto gap-3 pb-3">
        @foreach ($organization->products as $product)
            <div class="card shadow-sm" style="min-width: 300px;">
                @if($product->image)
                    <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->name }}" style="height: 150px; object-fit: cover;">
                @else
                    <img src="{{ asset('placeholder.png') }}" class="card-img-top" alt="Placeholder" style="height: 150px; object-fit: cover;">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $product->name }}</h5>
                    <p class="card-text">Rp. {{ number_format($product->price) }}</p>
                    <form method="POST" action="{{ route('user.cart.add', $product->id) }}">
                        @csrf
                        <input type="number" name="quantity" class="form-control" min="1" max="{{ $product->stock }}" value="1" required>
                        <button type="submit" class="AddToCart">Add to Cart</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
