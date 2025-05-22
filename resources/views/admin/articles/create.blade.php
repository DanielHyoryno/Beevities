@extends('admin.layouts.app')
@section('title', 'Tambah Artikel')

@section('content')
<div class="card p-4 bg-light text-dark">
    <h2 class="mb-4 text-primary">Tambah Artikel</h2>

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

    <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="form-label">Organisasi</label>
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
            <label class="form-label">Judul Artikel</label>
            <input type="text" name="title" class="form-control" required minlength="5" maxlength="255" placeholder="Judul artikel..." value="{{ old('title') }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi Artikel</label>
            <textarea name="description" class="form-control" rows="5" required placeholder="Tulis deskripsi lengkap...">{{ old('description') }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Gambar Artikel</label>
            <input type="file" name="image" class="form-control" accept="image/*" onchange="previewImage(event)">
            <img id="image-preview" class="img-fluid mt-2 rounded shadow-sm" style="max-height: 200px; display: none;">
        </div>

        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-primary">Tambah</button>
            <a href="{{ route('admin.articles.index') }}" class="btn btn-secondary">Batal</a>
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
