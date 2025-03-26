<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    // use HasFactory;
    
    protected $fillable = ['keperluan', 'jumlah', 'keterangan'];
}