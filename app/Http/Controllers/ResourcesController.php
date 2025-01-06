<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Resource;
use Illuminate\Support\Facades\Storage;

class ResourcesController extends Controller
{
    public function index(Request $request)
    {
        $query = Resource::query();

        // If a topic was provided, filter by topic
        if ($request->has('topic') && $request->topic !== '') {
            $query->where('topic', $request->topic);
        }

        // If a search term was provided, filter by title/author/description
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                    ->orWhere('author', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%");
            });
        }

        // Order by updated_at descending
        $resources = $query->orderBy('updated_at', 'desc')->get();

        return Inertia::render('Resources/Index', [
            'resources' => $resources,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title'       => 'required|string|max:255',
            'author'      => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'category'    => 'required|string|max:255',
            'topic'       => 'required|string|max:255',
            'type'        => 'required|in:book,document,article',
            'cover_image' => 'nullable|image|max:2048',
        ]);

        // Set default cover image based on type
        if ($validatedData['type'] === 'article') {
            $validatedData['cover_image'] = 'https://www.thesaurus.com/e/wp-content/uploads/2021/11/20211104_articles_1000x562-790x310.png';
        } elseif ($validatedData['type'] === 'document') {
            $validatedData['cover_image'] = 'https://www.usatoday.com/gcdn/-mm-/e7158d03197455651fa5228552643ad388d4da51/c=0-212-1963-1316/local/-/media/2019/09/12/USATODAY/usatsports/digital-signature-concept.jpg?width=660&height=372&fit=crop&format=pjpg&auto=webp';
        } else {
            // If it's a book and a file was uploaded, store it
            if ($request->hasFile('cover_image')) {
                $file = $request->file('cover_image');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('assets/images'), $filename);
                $validatedData['cover_image'] = 'assets/images/' . $filename;
            }
        }

        $resource = Resource::create($validatedData);

        return response()->json([
            'message'  => 'Resource created successfully',
            'resource' => $resource
        ], 201);
    }
}
