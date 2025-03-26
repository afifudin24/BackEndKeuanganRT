<?php

namespace App\Http\Controllers;

use App\Models\Pengeluaran;
use Illuminate\Http\Request;
use App\Models\SisaKas;

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

        // Kurangi sisa kas
        $sisaKas = SisaKas::first();
        $sisaKas->update(['total_kas' => $sisaKas->total_kas - $data['jumlah']]);

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

        $sisaKas = SisaKas::first();
        $selisih = $data['jumlah'] - $pengeluaran->jumlah; // Hitung selisih jumlah

        $pengeluaran->update($data);

        // Sesuaikan sisa kas dengan selisih jumlah
        $sisaKas->update(['total_kas' => $sisaKas->total_kas - $selisih]);

        return response()->json($pengeluaran);
    }

    public function destroy($id) {
        $pengeluaran = Pengeluaran::findOrFail($id);
        $sisaKas = SisaKas::first();

        // Kembalikan jumlah ke sisa kas sebelum dihapus
        $sisaKas->update(['total_kas' => $sisaKas->total_kas + $pengeluaran->jumlah]);

        $pengeluaran->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}