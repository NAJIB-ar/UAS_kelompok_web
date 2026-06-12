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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            // Relasi ke tabel users dan events
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('event_id')->constrained()->onDelete('cascade');
            
            $table->string('ticket_code')->unique(); // Kode unik e-tiket (misal: EVT-2026XXXX)
            $table->integer('quantity_purchased'); // Jumlah tiket yang dibeli
            $table->integer('total_price'); // quantity_purchased * price
            
            // Kolom krusial untuk Opsi 1
            $table->string('payment_proof')->nullable(); // Menyimpan path file foto bukti transfer
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
