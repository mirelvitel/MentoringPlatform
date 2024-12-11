<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Book;

class BookController extends Controller
{
    /**
     * Store a newly uploaded book in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,epub|max:5120', // Accept only PDF and EPUB files (max 5MB)
            'description' => 'nullable|string',
            'type' => 'required|string|max:50',
            'author' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'publisher' => 'nullable|string|max:255',
            'published_date' => 'nullable|date',
            'pages' => 'nullable|integer',
        ]);

        // Handle file upload
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('public/books');
            $validatedData['file_path'] = Storage::url($filePath);
            $validatedData['file_name'] = $request->file('file')->getClientOriginalName();
        }

        // Create the book entry in the database
        $book = Book::create($validatedData);

        return response()->json([
            'message' => 'Book uploaded successfully',
            'book' => $book,
        ]);
    }


    
    /**
     * Fetch all books from the database.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        // Retrieve all books
        $books = Book::all();

        return response()->json([
            'message' => 'Books retrieved successfully',
            'books' => $books,
        ]);
    }
}
