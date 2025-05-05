<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reservasi extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','tiket_id','kode_reservasi','jumlah','total_harga'
    ];

    protected $table = "reservasis";

    public function tiket()
    {
        return $this->belongsTo(tiket::class);
    }

    public function user()
    {
        return $this->belongsTo(user::class);
    }

    public function pembayaran()
    {
        return $this->hasMany(pembayaran::class);
    }
}
