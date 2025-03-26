<?php

namespace App\Http\Controllers;

use App\Models\Pemasukan;
use App\Models\SisaKas;
use Illuminate\Http\Request;

class PemasukanController extends Controller {
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
    
        // Cek apakah SisaKas sudah ada, kalau belum buat baru
        $sisaKas = SisaKas::first();
        if (!$sisaKas) {
            $sisaKas = SisaKas::create(['total_kas' => 0]);
        }
    
        // Tambahkan ke sisa kas
        $sisaKas->update(['total_kas' => $sisaKas->total_kas + $data['jumlah']]);
    
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

        $sisaKas = SisaKas::first();
        $selisih = $data['jumlah'] - $pemasukan->jumlah; // Hitung perubahan jumlah

        $pemasukan->update($data);

        // Update sisa kas sesuai perubahan jumlah pemasukan
        $sisaKas->update(['total_kas' => $sisaKas->total_kas + $selisih]);

        return response()->json($pemasukan);
    }

    public function destroy($id) {
        $pemasukan = Pemasukan::findOrFail($id);
        $sisaKas = SisaKas::first();

        // Kurangi jumlah pemasukan dari sisa kas sebelum dihapus
        $sisaKas->update(['total_kas' => $sisaKas->total_kas - $pemasukan->jumlah]);

        $pemasukan->delete();
        return response()->json(['message' => 'Deleted successfully']);
    }
}