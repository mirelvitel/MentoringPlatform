<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\Resource;

class ResourcesController extends Controller
{
    /**
     * Return the Inertia page with all resources
     * (or filtered by request) - if you still use it for the /resources route.
     */
    public function index(Request $request)
    {
        $query = Resource::query();

        if ($request->has('topic') && $request->topic !== '') {
            $query->where('topic', $request->topic);
        }
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                    ->orWhere('author', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%");
            });
        }

        // Sort by updated_at just for the Inertia page
        $resources = $query->orderBy('created_at', 'desc')->get();

        return Inertia::render('Resources/Index', [
            'resources' => $resources,
        ]);
    }

    /**
     * API endpoint returning resources sorted by created_at DESC (JSON).
     */
    public function apiIndex(Request $request)
    {
        $query = Resource::query();

        // optional filters if you want them
        if ($request->has('topic') && $request->topic !== '') {
            $query->where('topic', $request->topic);
        }
        if ($request->has('search') && $request->search !== '') {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                    ->orWhere('author', 'like', "%$search%")
                    ->orWhere('description', 'like', "%$search%");
            });
        }

        // Sort by created_at descending
        $resources = $query->orderBy('created_at', 'desc')->get();

        return response()->json($resources, 200);
    }

    /**
     * Create/store a Resource
     */
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

        // Handle default or uploaded cover images
        if ($validatedData['type'] === 'article') {
            $validatedData['cover_image'] = 'https://www.thesaurus.com/e/wp-content/uploads/2021/11/20211104_articles_1000x562-790x310.png';
        } elseif ($validatedData['type'] === 'document') {
            $validatedData['cover_image'] = 'https://www.usatoday.com/gcdn/-mm-/e7158d03197455651fa5228552643ad388d4da51/c=0-212-1963-1316/local/-/media/2019/09/12/USATODAY/usatsports/digital-signature-concept.jpg?width=660&height=372&fit=crop&format=pjpg&auto=webp';
        } else {
            // It's a book, handle upload if provided
            if ($request->hasFile('cover_image')) {
                $file = $request->file('cover_image');
                $filename = uniqid() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('assets/images'), $filename);
                $validatedData['cover_image'] = 'assets/images/' . $filename;
            }
        }

        // Create resource
        $resource = Resource::create($validatedData);

        return response()->json([
            'message' => 'Resource created successfully',
            'resource' => $resource
        ], 201);
    }

    /**
     * (Optional) Returns top three most-read books, if you still need it
     */
    public function mostReadBooks()
    {
        $mostReadBooks = Resource::where('type', 'book')
            ->orderBy('read_count', 'desc')
            ->take(3)
            ->get();

        return response()->json($mostReadBooks, 200);
    }
}
