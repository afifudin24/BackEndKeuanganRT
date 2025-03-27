<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str; // Tambahkan ini untuk UUID
use App\Models\User;
use App\Models\Warga;
class UserController extends Controller
{
    public function index()
    {

        $user = User::with('warga')->get();
        return response()->json($user);
    }

    public function store(Request $request)
    {
        $user = new User();
        $id = Str::uuid();
        $numericId = crc32($id); // Mengubah UUID menjadi angka unik
        $user->id = $numericId;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;
        $userbaru = $user->save();
        if ($userbaru) {
            return response()->json([
                'success' => true,
                // return sebagai data tanpa created_at dan updated_at
                'data' => $user->only('id', 'name', 'email', 'role'),

                'message' => 'Berhasil Menambah User'
            ]);
        }
    }
}
