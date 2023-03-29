<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penarikan extends Model
{
    use HasFactory;

    protected $table = 'Penarikan';

    protected $fillable = ['nasabah_id', 'nilai', 'status', 'keterangan'];

    public function nasabah()
    {
        return $this->belongsTo(User::class, 'nasabah_id')->where('type', 0);
    }
}