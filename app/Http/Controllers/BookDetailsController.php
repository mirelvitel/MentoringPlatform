<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BookDetail;

class BookDetailsController extends Controller
{
    /**
     * Show extra details for the book matching a given resource_id.
     */
    public function show($resourceId)
    {
        // We assume 'resource_id' matches the 'id' in your 'resources' table
        $bookDetail = BookDetail::where('resource_id', $resourceId)->firstOrFail();

        return response()->json($bookDetail);
    }
}
