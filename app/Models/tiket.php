<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_tiket', 'nama_event', 'tanggal', 'waktu', 'harga', 'stok', 'kategori'
    ];

    protected $table = "tikets";

    public function reservasi()
    {
        return $this->hasMany(reservasi::class);
    }
}