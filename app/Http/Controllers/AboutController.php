<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AboutController extends Controller
{
    public function index()
    {
        $posts = Post::all();

        return Inertia::render('About/Index', [
            'posts' => $posts
        ]);
    }
}
