<?php

namespace App\Http\Controllers\Organization_Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::where('organization_id', Auth::user()->organization_id)->get();
        return view('organization_admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('organization_admin.events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'location' => 'nullable|string|max:255',
            'zoom_link' => 'nullable|url|max:255',
            'ticket_price' => 'required|numeric|min:0',
            'registration_link' => 'nullable|url|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $eventData = $request->except(['image']);
        $eventData['organization_id'] = Auth::user()->organization_id;

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $mime = $file->getMimeType();
            $base64 = base64_encode(file_get_contents($file));
            $eventData['image'] = "data:$mime;base64,$base64";
        }

        Event::create($eventData);

        return redirect()->route('organization_admin.events.index')->with('success', 'Event berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $event = Event::where('organization_id', Auth::user()->organization_id)->findOrFail($id);
        return view('organization_admin.events.edit', compact('event'));
    }

    public function update(Request $request, $id)
    {
        $event = Event::where('organization_id', Auth::user()->organization_id)->findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'location' => 'nullable|string|max:255',
            'zoom_link' => 'nullable|url|max:255',
            'ticket_price' => 'required|numeric|min:0',
            'registration_link' => 'nullable|url|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $updateData = $request->except(['image']);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $mime = $file->getMimeType();
            $base64 = base64_encode(file_get_contents($file));
            $updateData['image'] = "data:$mime;base64,$base64";
        }

        $event->update($updateData);

        return redirect()->route('organization_admin.events.index')->with('success', 'Event berhasil diperbarui.');
    }


    public function destroy($id)
    {
        $event = Event::where('organization_id', Auth::user()->organization_id)->findOrFail($id);
        $event->delete();

        return redirect()->route('organization_admin.events.index')->with('success', 'Event berhasil dihapus.');
    }
}
