<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Organization;

class AdminEventController extends Controller
{
    public function index()
    {
        $events = Event::with('organization')->get();
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        $organizations = Organization::all();
        return view('admin.events.create', compact('organizations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'organization_id' => 'required|exists:organizations,id',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'location' => 'nullable|string|max:255',
            'zoom_link' => 'nullable|url|max:255',
            'ticket_price' => 'required|numeric|min:0',
            'registration_link' => 'nullable|url|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $eventData = $request->except('image');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $mime = $file->getMimeType();
            $base64 = base64_encode(file_get_contents($file));
            $eventData['image'] = "data:$mime;base64,$base64";
        }

        Event::create($eventData);

        return redirect()->route('admin.events.index')->with('success', 'Event berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $event = Event::findOrFail($id);
        $organizations = Organization::all();
        return view('admin.events.edit', compact('event', 'organizations'));
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'organization_id' => 'required|exists:organizations,id',
            'description' => 'required|string',
            'event_date' => 'required|date',
            'location' => 'nullable|string|max:255',
            'zoom_link' => 'nullable|url|max:255',
            'ticket_price' => 'required|numeric|min:0',
            'registration_link' => 'nullable|url|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $updateData = $request->except('image');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $mime = $file->getMimeType();
            $base64 = base64_encode(file_get_contents($file));
            $updateData['image'] = "data:$mime;base64,$base64";
        }

        $event->update($updateData);

        return redirect()->route('admin.events.index')->with('success', 'Event berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return redirect()->route('admin.events.index')->with('success', 'Event berhasil dihapus.');
    }
}
