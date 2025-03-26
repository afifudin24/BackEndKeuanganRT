<?php

namespace App\Http\Controllers;

use App\Models\JadwalRonda;
use App\Http\Requests\StoreJadwalRondaRequest;
use App\Http\Requests\UpdateJadwalRondaRequest;

class JadwalRondaController extends Controller
{
    public function index() {
        return response()->json(JadwalRonda::all());
    }

    public function store(Request $request) {
        $data = $request->validate([
            'warga_id' => 'required|exists:wargas,id',
            'tanggal' => 'required|date',
            'shift' => 'required|string',
        ]);
        $jadwal = JadwalRonda::create($data);
        return response()->json($jadwal, 201);
    }

    public function show($id) {
        return response()->json(JadwalRonda::findOrFail($id));
    }

    public function update(Request $request, $id) {
        $jadwal = JadwalRonda::findOrFail($id);
        $data = $request->validate([
            'warga_id' => 'required|exists:wargas,id',
            'tanggal' => 'required|date',
            'shift' => 'required|string',
        ]);
        $jadwal->update($data);
        return response()->json($jadwal);
    }

    public function destroy($id) {
        JadwalRonda::destroy($id);
        return response()->json(['message' => 'Deleted successfully']);
    }
}