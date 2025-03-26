<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SisaKas extends Model
{
    /** @use HasFactory<\Database\Factories\SisaKasFactory> */
    use HasFactory;

    protected $table = 'sisa_kas';
    protected $fillable = ['total_kas'];
}