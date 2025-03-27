<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Warga extends Model
{
    /** @use HasFactory<\Database\Factories\WargaFactory> */
    use HasFactory;

    protected $fillable = ['nama', 'nik', 'alamat'];

    public function iuran()
    {
        return $this->hasMany(IuranWarga::class);
    }

    public function tagihan()
    {
        return $this->hasMany(Tagihan::class);
    }

    public function jadwalRonda()
    {
        return $this->hasMany(JadwalRonda::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}