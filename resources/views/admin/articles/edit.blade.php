@extends('admin.layouts.app')
@section('title', 'Edit Artikel')

@section('content')
<div class="card p-4 bg-light text-dark">
    <h2 class="mb-4 text-primary">Edit Artikel</h2>

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

    <form action="{{ route('admin.articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Organisasi</label>
            <select name="organization_id" class="form-select" required>
                @foreach($organizations as $organization)
                    <option value="{{ $organization->id }}" {{ $article->organization_id == $organization->id ? 'selected' : '' }}>
                        {{ $organization->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Judul Artikel</label>
            <input type="text" name="title" class="form-control" required minlength="5" maxlength="255" value="{{ old('title', $article->title) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Deskripsi Artikel</label>
            <textarea name="description" class="form-control" rows="5" required>{{ old('description', $article->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Gambar Saat Ini</label><br>
            @if ($article->image)
                <img src="{{ $article->image }}" alt="Gambar artikel" class="img-fluid mb-2 rounded shadow-sm" style="max-height: 200px;">
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
