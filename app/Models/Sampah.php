<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sampah extends Model
{
    use HasFactory;

    protected $table = 'sampah';

    protected $fillable = ['jenis', 'harga_nasabah', 'harga_pengepul', 'berat', 'gambar'];

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }
}
