<?php

namespace App\Http\Controllers;

use App\Models\Resource;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    public function index(Request $request)
    {
        $query = Resource::query();

        // Filter by topic if it's provided
        if ($request->has('topic') && $request->topic) {
            $query->where('topic', $request->topic);
        }

        // Filter by search term if it's provided
        if ($request->has('search') && $request->search) {
            $query->where('title', 'LIKE', '%' . $request->search . '%');
        }

        // Get the results
        $resources = $query->get();

        return response()->json($resources);
    }

    // New method for fetching top 3 most read resources
    public function mostRead()
    {
        // For simplicity, just limit to the top 3 resources.
        // Replace 'reads' with your popularity metric if available
        $mostReadResources = Resource::orderBy('reads', 'desc')->limit(3)->get();

        return response()->json($mostReadResources);
    }
}
