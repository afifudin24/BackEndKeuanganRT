<?php

namespace App\Http\Controllers;

use App\Models\IuranWarga;
use App\Http\Requests\StoreIuranWargaRequest;
use App\Http\Requests\UpdateIuranWargaRequest;
use Illuminate\Http\Request;

class IuranWargaController extends Controller
{
    public function index() {
        return response()->json(IuranWarga::all());
    }

    public function store(Request $request) {
        $data = $request->validate([
            'warga_id' => 'required|exists:wargas,id',
            'jumlah' => 'required|numeric',
            'bulan' => 'required|string',
            'tahun' => 'required|integer',
            'status' => 'required|in:Belum Bayar,Sudah Bayar',
        ]);
        $iuran = IuranWarga::create($data);
        return response()->json($iuran, 201);
    }

    public function show($id) {
        return response()->json(IuranWarga::findOrFail($id));
    }

    public function update(Request $request, $id) {
        $iuran = IuranWarga::findOrFail($id);
        $data = $request->validate([
            'warga_id' => 'required|exists:wargas,id',
            'jumlah' => 'required|numeric',
            'bulan' => 'required|string',
            'tahun' => 'required|integer',
            'status' => 'required|in:Belum Bayar,Sudah Bayar',
        ]);
        $iuran->update($data);
        return response()->json($iuran);
    }

    public function destroy($id) {
        IuranWarga::destroy($id);
        return response()->json(['message' => 'Deleted successfully']);
    }
}