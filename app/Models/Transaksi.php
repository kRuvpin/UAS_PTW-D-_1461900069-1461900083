<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = "transaksi";
    protected $fillable = [
        'userid',
        'kodebaju',
        'kodepembayaran',
        'kodebaju',
        'jumlah',
        'biaya',
        'status',
        'tanggal',
    ];
}
