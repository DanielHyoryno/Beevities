@extends('admin.layouts.app')
@section('title', 'Edit Event')

@section('content')
<div class="card p-4 bg-light text-dark">
    <h2 class="mb-4 text-primary">Edit Event</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Terjadi kesalahan:</strong>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.events.update', $event->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="organization_id" class="form-label">Organisasi</label>
            <select name="organization_id" class="form-select" required>
                @foreach($organizations as $organization)
                    <option value="{{ $organization->id }}" {{ $event->organization_id == $organization->id ? 'selected' : '' }}>
                        {{ $organization->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="title" class="form-label">Nama Event</label>
            <input type="text" name="title" class="form-control" required value="{{ old('title', $event->title) }}">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi Event</label>
            <textarea name="description" class="form-control" rows="5" required>{{ old('description', $event->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label for="event_date" class="form-label">Tanggal & Waktu Event</label>
            <input type="datetime-local" name="event_date" class="form-control" required
                value="{{ \Carbon\Carbon::parse($event->event_date)->format('Y-m-d\TH:i') }}">
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Lokasi Event</label>
            <input type="text" name="location" class="form-control" value="{{ old('location', $event->location) }}">
        </div>

        <div class="mb-3">
            <label for="zoom_link" class="form-label">Link Zoom (opsional)</label>
            <input type="url" name="zoom_link" class="form-control" value="{{ old('zoom_link', $event->zoom_link) }}">
        </div>

        <div class="mb-3">
            <label for="ticket_price" class="form-label">Harga Tiket (Rp)</label>
            <input type="number" name="ticket_price" class="form-control" min="0" value="{{ old('ticket_price', $event->ticket_price) }}">
        </div>

        <div class="mb-3">
            <label for="registration_link" class="form-label">Link Pendaftaran</label>
            <input type="url" name="registration_link" class="form-control" value="{{ old('registration_link', $event->registration_link) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Gambar Saat Ini</label><br>
            @if ($event->image)
                <img src="{{ $event->image }}" alt="Event Image" class="img-fluid mb-2 rounded shadow-sm" style="max-height: 200px;">
            @else
                <p class="text-muted">Belum ada gambar</p>
            @endif
        </div>

        <div class="mb-3">
            <label class="form-label">Ganti Gambar</label>
            <input type="file" name="image" class="form-control" accept="image/*" onchange="previewImage(event)">
            <img id="image-preview" class="img-fluid mt-2 rounded shadow-sm" style="max-height: 200px; display: none;">
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Perbarui</button>
            <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">Batal</a>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function () {
            const output = document.getElementById('image-preview');
            output.src = reader.result;
            output.style.display = 'block';
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
@endsection
