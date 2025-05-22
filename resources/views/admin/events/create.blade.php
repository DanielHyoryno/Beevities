@extends('admin.layouts.app')
@section('title', 'Tambah Event')

@section('content')
<div class="card p-4 bg-light text-dark">
    <h2 class="mb-4 text-primary">Tambah Event</h2>

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

    <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="organization_id" class="form-label">Organisasi</label>
            <select name="organization_id" class="form-select" required>
                <option value="" disabled selected>-- Pilih Organisasi --</option>
                @foreach($organizations as $organization)
                    <option value="{{ $organization->id }}" {{ old('organization_id') == $organization->id ? 'selected' : '' }}>
                        {{ $organization->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="title" class="form-label">Nama Event</label>
            <input type="text" name="title" class="form-control" required value="{{ old('title') }}">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi Event</label>
            <textarea name="description" class="form-control" rows="5" required>{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label for="event_date" class="form-label">Tanggal & Waktu Event</label>
            <input type="datetime-local" name="event_date" class="form-control" required value="{{ old('event_date') }}">
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Lokasi Event</label>
            <input type="text" name="location" class="form-control" placeholder="Contoh: Kampus Anggrek, Aula 401" value="{{ old('location') }}">
        </div>

        <div class="mb-3">
            <label for="zoom_link" class="form-label">Link Zoom (jika online)</label>
            <input type="url" name="zoom_link" class="form-control" placeholder="https://zoom.us/..." value="{{ old('zoom_link') }}">
        </div>

        <div class="mb-3">
            <label for="ticket_price" class="form-label">Harga Tiket (Rp)</label>
            <input type="number" name="ticket_price" class="form-control" min="0" required value="{{ old('ticket_price') }}">
        </div>

        <div class="mb-3">
            <label for="registration_link" class="form-label">Link Pendaftaran</label>
            <input type="url" name="registration_link" class="form-control" placeholder="https://..." value="{{ old('registration_link') }}">
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Gambar Event</label>
            <input type="file" name="image" class="form-control" accept="image/*" onchange="previewImage(event)">
            <img id="image-preview" class="img-fluid mt-2 rounded shadow-sm" style="max-height: 200px; display: none;">
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Tambah</button>
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
