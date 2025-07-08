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
        Schema::create('wakil_pialangs', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->text('nomor_izin'); // Gunakan string jika panjangnya terbatas
            $table->enum('status', ['aktif', 'non-aktif']); // status bisa aktif atau non-aktif
            $table->unsignedBigInteger('category_id');
            $table->timestamps();

            // Foreign Key
            $table->foreign('category_id')->references('id')->on('kategori_wakil_pialang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wakil_pialangs');
    }
};
