<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tempat_acara extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama','alamat','kapasitas','kontak','deskripsi'
    ];

    protected $table = "tempat_acaras";
}
