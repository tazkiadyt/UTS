<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tikets', function (Blueprint $table) {
            $table->id();
            $table->string('kode_tiket', 50)->unique();
            $table->string('nama_event', 100);
            $table->date('tanggal');
            $table->time('waktu');
            $table->integer('harga');
            $table->integer('stok');
            $table->enum('kategori', ['VIP', 'Reguler', 'Ekonomi'])->default('Reguler');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tiket');
    }
};
