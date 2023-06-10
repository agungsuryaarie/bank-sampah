<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $fillable = ['petugas_id', 'sampah_id', 'nasabah_id', 'berat', 'nilai', 'status', 'penarikan_id', 'created_at'];

    protected function stauts(): Attribute
    {
        return new Attribute(
            get: fn ($value) =>  ['debit', 'kredit'][$value],
        );
    }

    public function petugas()
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

    public function penarikan()
    {
        return $this->belongsTo(Penarikan::class);
    }
}
