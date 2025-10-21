<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('custom_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('produk_id')->nullable()->constrained('products')->onDelete('set null');
            $table->string('foto_referensi')->nullable(); // upload referensi dari pelanggan
            $table->string('foto_request')->nullable();   // hasil desain / request yang dikirim
            $table->text('keterangan')->nullable();       // catatan tambahan dari pelanggan
            $table->enum('status', ['pending','approved','rejected','in_progress','done'])->default('pending');
            $table->decimal('harga_estimasi', 10, 2)->default(0.00);
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('custom_requests');
    }
};
