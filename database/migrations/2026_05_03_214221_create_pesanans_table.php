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
        Schema::create('pesanans', function (Blueprint $table) {
            $table->id('id_pesanan');
            $table->foreignId('id_meja')->constrained('mejas', 'id_meja')->restrictOnDelete();
            $table->foreignId('id_user')->nullable()->constrained('users', 'id_user')->nullOnDelete();
            $table->string('nomor_pesanan', 20)->unique();
            $table->decimal('total_harga', 12, 2)->default(0);
            $table->enum('metode_pembayaran', ['tunai', 'qris'])->default('tunai');
            $table->enum('status_pembayaran', ['belum_bayar', 'lunas'])->default('belum_bayar');
            $table->enum('status_pesanan', ['menunggu', 'diproses', 'siap_diambil', 'selesai', 'dibatalkan'])->default('menunggu');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pesanans');
    }
};
