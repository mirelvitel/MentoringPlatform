<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Faculty;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;

class CalendarController extends Controller
{
    public function index()
    {
        $userId = Auth::id();


        $events = Event::whereHas('users', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })
            ->orWhere('created_by', $userId)
            ->get();

        $users = User::all();
        $faculties = Faculty::all();

        return Inertia::render('Home/views/Calendar', [
            'events' => $events,
            'users' => $users,
            'faculties' => $faculties,
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
            'invitedUsers' => 'array',
        ]);

        $event = Event::create([
            'created_by' => Auth::id(),
            'title' => $request->title,
            'date' => $request->date,
            'start' => $request->start,
            'end' => $request->end,
            'description' => $request->description,
        ]);

        if ($request->has('invitedUsers')) {
            $event->users()->attach($request->invitedUsers);
        }

        return response()->json($event->load('users'), 201);
    }

    public function destroy($id)
    {
        $event = Event::findOrFail($id);

        if ($event->created_by !== auth()->id()) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $event->delete();

        return response()->json(null, 204);
    }

    public function update(Request $request)
    {
        $event = Event::find($request->id);

        if (!$event) {
            return response()->json(['error' => 'Event not found'], 404);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'date' => 'required|date',
            'start' => 'required|date_format:Y-m-d\TH:i:s',
            'end' => 'required|date_format:Y-m-d\TH:i:s|after_or_equal:start',
            'description' => 'nullable|string',
            'invitedUsers' => 'array',
        ]);

        $event->update([
            'title' => $request->title,
            'date' => $request->date,
            'start' => $request->start,
            'end' => $request->end,
            'description' => $request->description,
        ]);

        if ($request->has('invitedUsers')) {
            $event->users()->sync($request->invitedUsers);
        }

        return response()->json($event->load('users'), 200);
    }



}


