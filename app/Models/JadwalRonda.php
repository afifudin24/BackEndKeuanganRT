<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JadwalRonda extends Model
{
    /** @use HasFactory<\Database\Factories\JadwalRondaFactory> */
    use HasFactory;
    protected $fillable = ['warga_id', 'tanggal', 'shift'];

    public function warga() {
        return $this->belongsTo(Warga::class);
    }
}