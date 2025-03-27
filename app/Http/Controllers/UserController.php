<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str; // Tambahkan ini untuk UUID
use App\Models\User;
use App\Models\Warga;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
class UserController extends Controller
{
    public function index()
    {

        $user = User::with('warga')->get();
        return response()->json($user);
    }

    // public function store(Request $request)
    // {

    //     $user = new User();
    //     $id = Str::uuid();
    //     $numericId = crc32($id); // Mengubah UUID menjadi angka unik
    //     $user->id = $numericId;
    //     $user->name = $request->name;
    //     $user->email = $request->email;
    //     $user->password = bcrypt($request->password);
    //     $user->role = $request->role;
    //     $userbaru = $user->save();
    //     if($user->role == 'User'){
    //         $warga = new Warga();
    //         $warga->user_id = $numericId;
    //         $warga->nama = $request->name;
    //         $warga->nik = $request->nik;
    //         $warga->alamat = $request->alamat;
    //         $warga->jenis_kelamin = $request->jenis_kelamin;
    //         $warga->pekerjaan = $request->pekerjaan;
    //         $warga->agama = $request->agama;
    //         $wargabaru = $warga->save();
    //           if ($wargabaru) {
    //         return response()->json([
    //             'success' => true,
    //             // return sebagai data tanpa created_at dan updated_at
    //             'data' => $user->only('id', 'name', 'email', 'role'),

    //             'message' => 'Berhasil Menambah User'
    //         ]);
    //     }
    //     }

    // }

    public function store(Request $request)
{
    try {
        DB::beginTransaction(); // Mulai transaksi

        $user = new User();
        $id = Str::uuid();
        $numericId = crc32($id); // Mengubah UUID menjadi angka unik
        $user->id = $numericId;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;
        $userbaru = $user->save();

        if ($userbaru && $user->role == 'User') {
            $warga = new Warga();
            $warga->user_id = $numericId;
            $warga->nama = $request->name;
            $warga->nik = $request->nik;
            $warga->tanggal_lahir = $request->tanggal_lahir;
            $warga->alamat = $request->alamat;
            $warga->jenis_kelamin = $request->jenis_kelamin;
            $warga->pekerjaan = $request->pekerjaan;
            $warga->agama = $request->agama;
            $wargabaru = $warga->save();

            if ($wargabaru) {
                DB::commit(); // Simpan transaksi
                return response()->json([
                    'success' => true,
                    'data' => $user->only('id', 'name', 'email', 'role'),
                    'message' => 'Berhasil Menambah User'
                ], 201);
            }
        }

        DB::rollBack(); // Batalkan transaksi jika ada yang gagal
        return response()->json([
            'success' => false,
            'message' => 'Gagal menyimpan data warga'
        ], 400);

    } catch (\Exception $e) {
        DB::rollBack(); // Pastikan rollback jika ada error

        Log::error('Error saat menyimpan user dan warga: ' . $e->getMessage());

        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan: ' . $e->getMessage()
        ], 500);
    }
}
}
