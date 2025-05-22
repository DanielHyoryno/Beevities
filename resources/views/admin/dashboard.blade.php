@extends('admin.layouts.app')
@section('title', 'Dashboard Admin')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4 fw-semibold">Welcome, Admin</h2>

    <div class="row g-4">
        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h6 class="text-muted">Total Produk</h6>
                    <h3 class="fw-bold text-primary">{{ $total_products ?? 0 }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h6 class="text-muted">Total Pengguna</h6>
                    <h3 class="fw-bold text-success">{{ $total_users ?? 0 }}</h3>
                </div>
            </div>
        </div>

        {{-- Tambahan data lainnya jika perlu --}}
    </div>

    <div class="mt-5">
        <h5 class="mb-3">Quick Actions</h5>
        <div class="d-flex flex-wrap gap-3">
            <a href="{{ route('admin.products.index') }}" class="btn btn-primary">Kelola Produk</a>
            <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Kelola Kategori</a>
            <a href="{{ route('admin.organizations.index') }}" class="btn btn-info text-white">Kelola Organisasi</a>
            <a href="{{ route('admin.events.index') }}" class="btn btn-warning text-dark">Kelola Event</a>
            <a href="{{ route('admin.articles.index') }}" class="btn btn-danger">Kelola Artikel</a>
        </div>
    </div>
</div>
@endsection
