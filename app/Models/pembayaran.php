<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pembayaran extends Model
{
    protected $fillable = [
        'reservasi_id',
        'metode_pembayaran',
        'jumlah_pembayaran',
        'status_pembayaran',
        'waktu_pembayaran'
    ];
    protected $table = 'pembayarans';
    
    public function reservasi()
    {
        return $this->belongsTo(Reservasi::class, 'reservasi_id');
    }
}
