<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IuranWarga extends Model
{
    /** @use HasFactory<\Database\Factories\IuranWargaFactory> */
    use HasFactory;

    protected $fillable = ['warga_id', 'jumlah', 'bulan', 'tahun', 'status'];

    public function warga() {
        return $this->belongsTo(Warga::class);
    }
}