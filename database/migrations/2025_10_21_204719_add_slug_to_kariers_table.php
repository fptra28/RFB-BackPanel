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
        Schema::table('kariers', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('posisi');
        });
        
        // Update slug untuk data yang sudah ada
        \App\Models\Karier::all()->each(function($karier) {
            $karier->update(['slug' => \Illuminate\Support\Str::slug($karier->nama_kota . ' ' . $karier->posisi)]);
        });
        
        Schema::table('kariers', function (Blueprint $table) {
            $table->string('slug')->nullable(false)->change();
            $table->unique('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kariers', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn('slug');
        });
    }
};
