@extends('user.layouts.app')
@section('title', $event->title)

@section('content')
<div class="container mt-4 mb-5">
    <div class="card shadow p-4">
        {{-- Judul dan Tanggal --}}
        <h1 class="fw-bold">{{ $event->title }}</h1>
        <p class="text-muted mb-3">
            📅 {{ $event->event_date ? $event->event_date->format('d M Y, H:i') : '-' }}
        </p>

        {{-- Gambar Event --}}
        <img src="{{ $event->image ?? asset('placeholder.png') }}"
             class="w-100 rounded mb-4"
             style="max-height: 350px; object-fit: cover;"
             alt="{{ $event->title }}">

        {{-- Deskripsi --}}
        <div class="mb-4">
            <h5 class="fw-semibold">Deskripsi</h5>
            <p>{{ $event->description }}</p>
        </div>

        {{-- Info Tambahan --}}
        <div class="row">
            <div class="col-md-4 mb-3">
                <h6 class="fw-semibold">📍 Lokasi</h6>
                <p>{{ $event->location ?? '-' }}</p>
            </div>
            <div class="col-md-4 mb-3">
                <h6 class="fw-semibold">🔗 Zoom Link</h6>
                @if($event->zoom_link)
                    <a href="{{ $event->zoom_link }}" target="_blank" class="btn btn-sm btn-outline-primary">
                        Buka Zoom
                    </a>
                @else
                    <p class="text-muted">Tidak tersedia</p>
                @endif
            </div>
            
            <div class="col-md-4 mb-3">
                <h6 class="fw-semibold">💵 Harga Tiket</h6>
                <p class="{{ $event->ticket_price == 0 ? 'text-success' : '' }}">
                    {{ $event->ticket_price == 0 ? 'Gratis' : 'Rp' . number_format($event->ticket_price, 0, ',', '.') }}
                </p>
            </div>

            <div class="col-md-12 mt-4 text-center">
                @if($event->registration_link)
                    <a href="{{ $event->registration_link }}" target="_blank" class="btn btn-success px-4 py-2">
                        📝 Daftar Sekarang
                    </a>
                @else
                    <p class="text-muted">Form pendaftaran belum tersedia.</p>
                @endif
            </div>

        </div>
    </div>
</div>
@endsection
