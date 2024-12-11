<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Resource; // Ensure this line is present
use Illuminate\Support\Facades\Storage;
class ResourcesController extends Controller
{
    public function index()
    {
        return Inertia::render('Resources/Index');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string|max:255',
            'topic' => 'required|string|max:255',
            'cover_image' => 'nullable|image|max:2048', // Validate the uploaded image
        ]);
    
     // Handle the file upload
     if ($request->hasFile('cover_image')) {
        // Store the file in 'public/assets/images'
        $file = $request->file('cover_image');
        $filename = uniqid() . '.' . $file->getClientOriginalExtension();
        $path = $file->move(public_path('assets/images'), $filename);

        // Set the path to be stored in the database
        $validatedData['cover_image'] = 'assets/images/' . $filename;
    }
    
        $resource = Resource::create($validatedData);
    
        return response()->json(['message' => 'Resource created successfully', 'resource' => $resource], 201);
    }

}
