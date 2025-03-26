<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;

class PengeluaranController extends Controller
{
    public function index() {
        return response()->json(Pengeluaran::all());
    }

    public function store(Request $request) {
        $data = $request->validate([
            'keperluan' => 'required|string',
            'jumlah' => 'required|numeric',
            'keterangan' => 'nullable|string',
        ]);
        $pengeluaran = Pengeluaran::create($data);
        return response()->json($pengeluaran, 201);
    }

    public function show($id) {
        return response()->json(Pengeluaran::findOrFail($id));
    }

    public function update(Request $request, $id) {
        $pengeluaran = Pengeluaran::findOrFail($id);
        $data = $request->validate([
            'keperluan' => 'required|string',
            'jumlah' => 'required|numeric',
            'keterangan' => 'nullable|string',
        ]);
        $pengeluaran->update($data);
        return response()->json($pengeluaran);
    }

    public function destroy($id) {
        Pengeluaran::destroy($id);
        return response()->json(['message' => 'Deleted successfully']);
    }
}