@extends('organization_admin.layouts.app')

@section('title', 'Dashboard Organization Admin')

@section('content')
<div class="container mt-4">
    <h2 class="fw-bold text-center">{{ Auth::user()->name }} Data</h2>
    <div class="mb-4">
        <a href="{{ route('organization_admin.profile.edit') }}" class="btn btn-primary">Edit Profil Organisasi</a>
    </div>
    
    <div class="row mt-4 g-3 text-center">
        <div class="col-md-3">
            <div class="card text-bg-primary shadow-sm p-3">
                <div class="card-header fw-bold">Total Events</div>
                <div class="card-body">
                    <h4 class="card-title display-6 fw-bold">{{ $totalEvents ?? 0 }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-success shadow-sm p-3">
                <div class="card-header fw-bold">Total Articles</div>
                <div class="card-body">
                    <h4 class="card-title display-6 fw-bold">{{ $totalArticles ?? 0 }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-warning shadow-sm p-3">
                <div class="card-header fw-bold">Total Produk</div>
                <div class="card-body">
                    <h4 class="card-title display-6 fw-bold">{{ $totalProducts ?? 0 }}</h4>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-bg-danger shadow-sm p-3">
                <div class="card-header fw-bold">Total Invoice</div>
                <div class="card-body">
                    <h4 class="card-title display-6 fw-bold">{{ $totalInvoices ?? 0 }}</h4>
                </div>
            </div>
        </div>
    </div>
    
    <div class="mt-4 d-flex flex-wrap justify-content-center gap-3">
        <a href="{{ route('organization_admin.events.index') }}" class="btn btn-primary px-4 py-2">Kelola Event</a>
        <a href="{{ route('organization_admin.articles.index') }}" class="btn btn-secondary px-4 py-2">Kelola Artikel</a>
        <a href="{{ route('organization_admin.products.index') }}" class="btn btn-warning px-4 py-2">Kelola Produk</a>
        <a href="{{ route('organization_admin.invoices.index') }}" class="btn btn-danger px-4 py-2" >Kelalo Invoice</a>
    </div>
</div>
@endsection