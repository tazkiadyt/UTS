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
<<<<<<< HEAD

    public function pembayaran()
    {
        return $this->hasMany(pembayaran::class);
    }
=======
>>>>>>> 1f555367fdc494c87f507ad34a30bceb9fcff838
}
