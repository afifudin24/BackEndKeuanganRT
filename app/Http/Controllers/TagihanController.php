<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use App\Http\Requests\StoreTagihanRequest;
use App\Http\Requests\UpdateTagihanRequest;
use Illuminate\Http\Request;

class TagihanController extends Controller
{
    public function index() {
        return response()->json(Tagihan::all());
    }

    public function store(Request $request) {
        $data = $request->validate([
            'warga_id' => 'required|exists:wargas,id',
            'jumlah' => 'required|numeric',
            'bulan' => 'required|string',
            'tahun' => 'required|integer',
            'status' => 'required|in:Belum Bayar,Sudah Bayar',
        ]);
        $tagihan = Tagihan::create($data);
        return response()->json($tagihan, 201);
    }

    public function show($id) {
        return response()->json(Tagihan::findOrFail($id));
    }

    public function update(Request $request, $id) {
        $tagihan = Tagihan::findOrFail($id);
        $data = $request->validate([
            'warga_id' => 'required|exists:wargas,id',
            'jumlah' => 'required|numeric',
            'bulan' => 'required|string',
            'tahun' => 'required|integer',
            'status' => 'required|in:Belum Bayar,Sudah Bayar',
        ]);
        $tagihan->update($data);
        return response()->json($tagihan);
    }

    public function destroy($id) {
        Tagihan::destroy($id);
        return response()->json(['message' => 'Deleted successfully']);
    }
}