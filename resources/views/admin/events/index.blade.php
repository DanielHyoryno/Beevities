@extends('admin.layouts.app')
@section('title', 'Daftar Event')

@section('content')
<div class="card p-4 bg-light text-dark">
    <h2 class="mb-4 text-primary">Daftar Event</h2>

    <a href="{{ route('admin.events.create') }}" class="btn btn-primary mb-3">Tambah Event</a>

    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th>Thumbnail</th>
                    <th>Judul</th>
                    <th>Deskripsi</th>
                    <th>Organisasi</th>
                    <th>Tanggal</th>
                    <th>Tiket</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-center">
                @foreach($events as $event)
                    <tr>
                        <td>
                            @if($event->image)
                                <img src="{{ $event->image }}" class="img-thumbnail" style="max-height: 60px;" alt="Thumbnail">
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td class="fw-bold">{{ $event->title }}</td>
                        <td style="max-width: 250px; text-align: left;">
                            {{ Str::limit(strip_tags($event->description), 80, '...') }}
                        </td>
                        <td>{{ $event->organization->name }}</td>
                        <td>{{ \Carbon\Carbon::parse($event->event_date)->format('d M Y, H:i') }}</td>
                        <td>
                            @if($event->ticket_price > 0)
                                Rp {{ number_format($event->ticket_price, 0, ',', '.') }}
                            @else
                                <span class="text-success">Gratis</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus event ini?');">
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
