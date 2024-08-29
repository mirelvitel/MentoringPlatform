<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class UsersController extends Controller
{
    public function index()
    {
        return Inertia::render('Home/views/Users', [
            'users' => User::all()
        ]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt('password25236')
        ]);

        return response()->json(User::find($user->id), 201);
    }


    public function uploadExcel(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls'
        ]);

        // get content of the excel file with phpoffice/phpspreadsheet
        $file = $request->file('file');
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
        $spreadsheet = $reader->load($file);
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray();

        $users = [];
        for ($i = 1; $i < count($rows); $i++) {
            $users[] = User::create([
                'name' => $rows[$i][0],
                'email' => $rows[$i][1],
                'role' => $rows[$i][2],
                'password' => bcrypt('password25236')
            ]);
        }

        return response()->json($users, 201);

    }

    public function updateStatus($userId)
    {
        $user = User::find($userId);
        $user->status = "active";
        $user->save();

        return response()->json($user, 200);
    }

    public function deleteUser($userId)
    {
        $user = User::find($userId);
        $user->delete();

        return response()->json(null, 204);
    }
}
