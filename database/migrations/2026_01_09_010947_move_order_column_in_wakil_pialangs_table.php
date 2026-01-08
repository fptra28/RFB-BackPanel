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
        Schema::table('wakil_pialangs', function (Blueprint $table) {
            // Hapus kolom order yang ada
            $table->dropColumn('order');
            
            // Tambahkan kembali kolom order setelah id
            $table->integer('order')->default(0)->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('wakil_pialangs', function (Blueprint $table) {
            // Kembalikan ke posisi semula (setelah category_id)
            $table->dropColumn('order');
            $table->integer('order')->default(0)->after('category_id');
        });
    }
};
