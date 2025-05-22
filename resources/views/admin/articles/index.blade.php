@extends('admin.layouts.app')
@section('title', 'Daftar Artikel')

@section('content')
<div class="card p-4 bg-light text-dark">
    <h2 class="mb-4 text-primary">Daftar Artikel</h2>

    <a href="{{ route('admin.articles.create') }}" class="btn btn-primary mb-3">Tambah Artikel</a>

    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>Thumbnail</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Organisasi</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach($articles as $article)
                    <tr>
                        <td>
                            @if($article->image)
                                <img src="{{ $article->image }}" alt="Thumbnail" class="img-thumbnail" style="max-height: 60px;">
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td class="fw-bold">{{ $article->title }}</td>
                        <td style="max-width: 300px; text-align: left;">
                            {{ Str::limit(strip_tags($article->description), 80, '...') }}
                        </td>
                        <td>{{ $article->organization->name }}</td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('admin.articles.edit', $article->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.articles.destroy', $article->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
