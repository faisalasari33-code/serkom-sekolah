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
        Schema::create('berita', function (Blueprint $table) {
            $table->uuid('id_berita')->primary();
            $table->string('judul');
            $table->text('isi');
            $table->date('tanggal');
            $table->string('foto')->nullable();
            $table->string('status')->default('publish');
            $table->uuid('id_user');
            $table->foreign('id_user')->references('id_user')->on('user')->onUpdate('cascade')->onDelete('restrict');
           
        });
    }

    /**
     * Reverse the migrations. 
     */
    public function down(): void
    {
        Schema::dropIfExists('berita');
    }
};
