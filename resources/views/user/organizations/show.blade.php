@extends('user.layouts.app')
@section('content')

<div class="container mt-4">
    <!-- Organization Banner -->
    <div class="mb-4">
        @if($organization->banner_image)
            <img src="{{$organization->banner_image}}" alt="Banner" class="w-100" style="height: 200px; object-fit: cover; border-radius: 10px;">
        @else
            <img src="{{ asset('placeholder.png') }}" alt="Placeholder" class="w-100" style="height: 200px; object-fit: cover; border-radius: 10px;">
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
                    <a href="{{ route('events.show', $event->id) }}" class="btn btn-primary btn-sm">View Details</a>
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
                    <a href="{{ route('articles.show', $article->id) }}" class="btn btn-secondary btn-sm">Read More</a>
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
                        <button type="submit" class="btn btn-success btn-sm">Add to Cart</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
