@extends('organization_admin.layouts.app')

@section('title', 'Manage Events')

@section('content')
    <div class="container">
        <h2 class="mb-4 text-center fw-bold">Event Management</h2>
        
        <div class="d-flex justify-content-between mb-3">
            <a href="{{ route('organization_admin.events.create') }}" class="btn btn-success">
                <i class="fas fa-plus"></i> Add New Event
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Date</th>
                        <th>Location</th>
                        <th>Zoom</th>
                        <th>Price</th>
                        <th>Form</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @forelse($events as $event)
                    <tr class="table-primary">
                        <td>
                            @if($event->image)
                                <img src="{{ $event->image }}" alt="Event Image" width="60" class="rounded shadow">
                            @else
                                <span class="text-muted">No Image</span>
                            @endif
                        </td>
                        <td class="fw-bold">{{ $event->title }}</td>
                        <td>{{ Str::limit($event->description, 50) }}</td>
                        <td>{{ \Carbon\Carbon::parse($event->event_date)->format('d M Y, H:i') }}</td>
                        <td>{{ $event->location ?? '-' }}</td>
                        <td>
                            @if($event->zoom_link)
                                <a href="{{ $event->zoom_link }}" target="_blank">Link</a>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>Rp{{ number_format($event->ticket_price, 0, ',', '.') }}</td>
                        <td>
                            @if($event->registration_link)
                                <a href="{{ $event->registration_link }}" target="_blank" class="btn btn-sm btn-outline-success">Open</a>
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-2 justify-content-center">
                                <a href="{{ route('organization_admin.events.edit', $event->id) }}" class="btn btn-warning btn-sm d-flex align-items-center gap-1">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('organization_admin.events.destroy', $event->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm d-flex align-items-center gap-1" onclick="return confirm('Delete this event?')">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </td>

                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted">No events found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
