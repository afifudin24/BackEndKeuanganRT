<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use App\Http\Requests\StoreWargaRequest;
use App\Http\Requests\UpdateWargaRequest;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    public function index() {
        return response()->json(Warga::all());
    }

    public function store(Request $request) {
        $data = $request->validate([
            'nama' => 'required|string',
            'nik' => 'required|string|unique:wargas,nik',
            'alamat' => 'required|string',
        ]);
        $warga = Warga::create($data);
        return response()->json($warga, 201);
    }

    public function show($id) {
        return response()->json(Warga::findOrFail($id));
    }

    public function update(Request $request, $id) {
        $warga = Warga::findOrFail($id);
        $data = $request->validate([
            'nama' => 'required|string',
            'nik' => 'required|string|unique:wargas,nik,' . $id,
            'alamat' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'pekerjaan' => 'required|string',
            'agama' => 'required|string',
            'jenis_kelamin' => 'required|string',
        ]);
        $warga->update($data);
        return response()->json($warga);
    }


    public function destroy($id) {
        Warga::destroy($id);
        // return message dan id nya
        return response()->json(['message' => 'Data berhasil dihapus', 'id' => $id]);
        // return response()->json(['message' => 'Deleted successfully']);
    }
}
