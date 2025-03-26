<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use App\Http\Requests\StorePengumumanRequest;
use App\Http\Requests\UpdatePengumumanRequest;

class PengumumanController extends Controller
{
    public function index() {
        return response()->json(Pengumuman::all());
    }

    public function store(Request $request) {
        $data = $request->validate([
            'judul' => 'required|string',
            'isi' => 'required|string',
            'tanggal' => 'required|date',
        ]);
        $pengumuman = Pengumuman::create($data);
        return response()->json($pengumuman, 201);
    }

    public function show($id) {
        return response()->json(Pengumuman::findOrFail($id));
    }

    public function update(Request $request, $id) {
        $pengumuman = Pengumuman::findOrFail($id);
        $data = $request->validate([
            'judul' => 'required|string',
            'isi' => 'required|string',
            'tanggal' => 'required|date',
        ]);
        $pengumuman->update($data);
        return response()->json($pengumuman);
    }

    public function destroy($id) {
        Pengumuman::destroy($id);
        return response()->json(['message' => 'Deleted successfully']);
    }

}