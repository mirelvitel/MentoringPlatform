<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Post; // Add this line to import the Post model
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    public function index()
    {
        return Inertia::render('Post/Index', [
            'items' => Post::all()
        ]);
    }

    public function storePost(Request $request)
    {

        $request->validate([
            'content' => 'required',
        ]);
       
        $post = Post::create([
            'user_id' => auth()->id(),
            'content' => $request->input('content'),
        ]);

        return response()->json($post);
    }
}
