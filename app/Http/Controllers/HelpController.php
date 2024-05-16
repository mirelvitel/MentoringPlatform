<?php

namespace App\Http\Controllers;

use App\Models\Help;
use Illuminate\Http\Request;
use Inertia\Inertia;
use function Termwind\render;

class HelpController extends Controller
{
    public function index()
    {
        return Inertia::render('Help/Index', [
            'items' => Help::all()
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required',
            'answer' => 'required',
        ]);

        if ($request->id) {
            $help = Help::find($request->id);
            $help->update($request->all());
            return response()->json($help, 200);
        } else {
            $help = Help::create($request->all());
            return response()->json($help, 201);
        }
    }


    public function destroy($id)
    {
        $help = Help::find($id);
        $help->delete();
        return response()->json(null, 204);
    }
}
