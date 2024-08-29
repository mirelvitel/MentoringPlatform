<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    public function index()
    {
        $events = Event::where('user_id', Auth::id())->get();

        return Inertia::render('Home/views/Calendar', [
            'events' => $events,
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'start' => 'required|date_format:Y-m-d\TH:i:s',
            'end' => 'required|date_format:Y-m-d\TH:i:s|after_or_equal:start',
            'description' => 'nullable|string',
        ]);

        Event::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'date' => $request->date,
            'start' => $request->start,
            'end' => $request->end,
            'description' => $request->description,
        ]);

        $event = Event::where('user_id', Auth::id())->latest()->first();

        return response()->json($event, 201);
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        if ($event->user_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $event->delete();

        return response()->json(null, 204);
    }

    public function update(Request $request, $id)
    {
        $event = Event::findOrFail($id);

        if ($event->user_id !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'start' => 'required|date_format:Y-m-d\TH:i:s',
            'end' => 'required|date_format:Y-m-d\TH:i:s|after_or_equal:start',
            'description' => 'nullable|string',
        ]);

        // Update the event
        $event->update([
            'title' => $request->title,
            'date' => $request->date,
            'start' => $request->start,
            'end' => $request->end,
            'description' => $request->description,
        ]);

        // Return the updated event
        return response()->json($event, 200);
    }
}


