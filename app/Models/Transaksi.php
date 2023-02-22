<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $fillable = ['user_id', 'sampah_id', 'nasabah_id', 'berat', 'total'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sampah()
    {
        return $this->belongsTo(Sampah::class);
    }

    public function nasabah()
    {
        return $this->belongsTo(User::class, 'nasabah_id')->where('type', 0);
    }
}
