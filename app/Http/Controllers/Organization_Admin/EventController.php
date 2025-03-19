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
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // ✅ Prepare form fields
        $eventData = $request->except(['image']);

        // ✅ Store image as binary if uploaded
        if ($request->hasFile('image')) {
            $eventData['image'] = file_get_contents($request->file('image')->getRealPath());
        }

        // ✅ Create Event with organization_id
        Event::create(array_merge($eventData, ['organization_id' => Auth::user()->organization_id]));

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
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // ✅ Prepare form fields except image
        $updateData = $request->except(['image']);

        // ✅ Update image if a new one is uploaded
        if ($request->hasFile('image')) {
            $updateData['image'] = file_get_contents($request->file('image')->getRealPath());
        }

        // ✅ Update event with the new data
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
