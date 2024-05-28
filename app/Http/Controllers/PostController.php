<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Post; // Add this line to import the Post model

class PostController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Home/Index', [
            'items' => Post::with('user:id,name')->orderBy('created_at', 'desc')->get(),
        ]);
    }

    public function store(Request $request)
    {

        $request->validate([
            'content' => 'required',
            'title' => 'required',
        ]);

        $post = Post::create([
            'user_id' => auth()->id(),
            'content' => $request->input('content'),
            'title' => $request->input('title'),
        ]);

        return response()->json(Post::whereId($post->id)->with('user:id,name')->first(), 201);
    }
}
