<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use Illuminate\Http\Request;

class PemasukanController extends Controller
{
    public function index() {
        return response()->json(Pemasukan::all());
    }

    public function store(Request $request) {
        $data = $request->validate([
            'sumber' => 'required|string',
            'jumlah' => 'required|numeric',
            'keterangan' => 'nullable|string',
        ]);
        $pemasukan = Pemasukan::create($data);
        return response()->json($pemasukan, 201);
    }

    public function show($id) {
        return response()->json(Pemasukan::findOrFail($id));
    }

    public function update(Request $request, $id) {
        $pemasukan = Pemasukan::findOrFail($id);
        $data = $request->validate([
            'sumber' => 'required|string',
            'jumlah' => 'required|numeric',
            'keterangan' => 'nullable|string',
        ]);
        $pemasukan->update($data);
        return response()->json($pemasukan);
    }

    public function destroy($id) {
        Pemasukan::destroy($id);
        return response()->json(['message' => 'Deleted successfully']);
    }
}