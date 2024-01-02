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
        Schema::create('table_alternatif', function (Blueprint $table) {
            $table->id();
            $table->string('kode_alternatif', 50)->nullable();
            $table->string('no_sk', 50)->nullable();
            $table->string('nama_alternatif', 50)->nullable();
            $table->integer('luas_tanah', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_alternatif');
    }
};
