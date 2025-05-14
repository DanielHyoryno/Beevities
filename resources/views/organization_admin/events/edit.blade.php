@extends('organization_admin.layouts.app')

@section('title', 'Edit Event')

@section('content')
<div class="container mt-4 d-flex justify-content-center">
    <div class="w-100" style="max-width: 600px;">
        <h2 class="mb-4 text-center">Edit Event</h2>

        <form action="{{ route('organization_admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data" class="shadow p-4 bg-light rounded">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="m-1 text-secondary form-label fw-bold">Nama Event</label>
                <input type="text" name="title" class="form-control" value="{{ $event->title }}" required>
            </div>

            <div class="mb-3">
                <label class=" m-1 text-secondary form-label fw-bold">Deskripsi</label>
                <textarea name="description" class="form-control" rows="4" required>{{ $event->description }}</textarea>
            </div>

            <div class="mb-3">
                <label class="m-1 text-secondary form-label fw-bold">Tanggal Event</label>
                <input type="datetime-local" name="event_date" class="form-control" value="{{ $event->event_date }}" required>
            </div>

            <div class="mb-3">
                <label for="location" class="m-1 text-secondary form-label fw-bold">Lokasi</label>
                <input type="text" name="location" class="form-control" value="{{ $event->location }}">
            </div>

            <div class="mb-3">
                <label for="zoom_link" class="m-1 text-secondary form-label fw-bold">Zoom Link</label>
                <input type="url" name="zoom_link" class="form-control" value="{{ $event->zoom_link }}">
            </div>

            <div class="mb-3">
                <label for="ticket_price" class="m-1 text-secondary form-label fw-bold">Harga Tiket (Rp)</label>
                <input type="number" name="ticket_price" class="form-control" min="0" value="{{ $event->ticket_price }}">
            </div>

            <div class="mb-3">
                <label for="registration_link" class="m-1 text-secondary form-label fw-bold">Link Form Pendaftaran</label>
                <input type="url" name="registration_link" class="form-control"
                    value="{{ $event->registration_link }}">
            </div>


            <div class="mb-3">
                <label class="m-1 text-secondary form-label fw-bold">Gambar Event</label>
                @if($event->image)
                    <div class="mb-2 text-center">
                        <img src="{{ $event->image }}" alt="{{ $event->title }}" width="150" class="rounded shadow">
                    </div>
                @endif
                <input type="file" name="image" class="form-control">
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success px-4 py-2">Update Event</button>
                <a href="{{ route('organization_admin.events.index') }}" class="btn btn-secondary px-4 py-2">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection