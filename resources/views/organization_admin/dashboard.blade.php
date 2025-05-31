@extends('organization_admin.layouts.app')

@section('title', 'Dashboard Organization Admin')

@section('styles')

<style>
    body {
        background: linear-gradient(to right, #0f2027, #203a43, #2c5364);
        color: white;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .glass-card {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 16px;
        backdrop-filter: blur(10px);
        box-shadow: 0 0 20px rgba(0, 255, 255, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .glass-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px var(--card-color);
    }

    .nav-btn {
        background-color: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.1);
        padding: 12px 24px;
        color: #ffffff;
        text-decoration: none;
        border-radius: 10px;
        font-weight: 500;
        transition: background 0.3s, transform 0.2s;
    }

    .nav-btn:hover {
        background-color: rgba(255, 255, 255, 0.15);
        transform: scale(1.05);
        box-shadow: 0 0 20px rgba(0, 255, 255, 0.1);

    }
</style>


@endsection

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold mb-1" style="letter-spacing: 0.5px; color: #00e5ff;">{{ Auth::user()->name }}</h2>
        <p class="">Admin of <strong>{{ Auth::user()->organization->name ?? 'Unknown Organization' }}</strong></p>
        <a href="{{ route('organization_admin.profile.edit') }}" class="btn btn-outline-light mt-2 px-4 rounded-pill">
            <i class="fas fa-user-cog me-2"></i>Edit Organization Profile
        </a>
    </div>

    <!-- Stat Cards -->
    <div class="row g-4 mb-5">
        @php
            $stats = [
                ['label' => 'Events', 'value' => $totalEvents ?? 0, 'color' => '#00bcd4'],
                ['label' => 'Articles', 'value' => $totalArticles ?? 0, 'color' => '#9c27b0'],
                ['label' => 'Products', 'value' => $totalProducts ?? 0, 'color' => '#ffc107'],
                ['label' => 'Invoices', 'value' => $totalInvoices ?? 0, 'color' => '#f44336'],
            ];
        @endphp

        @foreach ($stats as $stat)
        <div class="col-6 col-md-3">
            <div class="glass-card p-4 text-center" style="--card-color: {{ $stat['color'] }};">
                <small class="text-uppercase" style="letter-spacing: 1px; color: #ddd;">{{ $stat['label'] }}</small>
                <h2 class="fw-bold mt-2" style="color: white;">{{ $stat['value'] }}</h2>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Navigation Buttons -->
    <div class="d-flex flex-wrap justify-content-center gap-3">
        <a href="{{ route('organization_admin.events.index') }}" class="nav-btn">Manage Events</a>
        <a href="{{ route('organization_admin.articles.index') }}" class="nav-btn">Manage Articles</a>
        <a href="{{ route('organization_admin.products.index') }}" class="nav-btn">Manage Products</a>
        <a href="{{ route('organization_admin.invoices.index') }}" class="nav-btn">Manage Invoices</a>
    </div>
</div>
@endsection