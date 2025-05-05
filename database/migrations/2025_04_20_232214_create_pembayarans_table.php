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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reservasi_id')->constrained()->onDelete('cascade');
            $table->enum('metode_pembayaran', ['transfer bank','cash','kartu kredit', 'ewallet']);
            $table->integer('jumlah_pembayaran');
            $table->enum('status_pembayaran', ['pending','lunas','gagal']);
            $table->dateTime('waktu_pembayaran')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
