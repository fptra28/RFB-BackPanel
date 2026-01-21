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
        if (!Schema::hasColumn('kategori_wakil_pialang', 'order')) {
            return;
        }

        Schema::table('kategori_wakil_pialang', function (Blueprint $table) {
            $table->dropColumn('order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('kategori_wakil_pialang', 'order')) {
            return;
        }

        Schema::table('kategori_wakil_pialang', function (Blueprint $table) {
            $table->integer('order')->default(0)->after('nama_kategori');
        });
    }
};
