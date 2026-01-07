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
            $table->integer('order')->default(0)->after('id');
        });

        // Set order untuk data yang sudah ada
        \App\Models\Karier::query()->update(['order' => 0]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kariers', function (Blueprint $table) {
            $table->dropColumn('order');
        });
    }
};
