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
        Schema::create('galeris', function (Blueprint $table) {
            $table->id();
            $table->string('judul', 255);
            $table->text('keterangan')->nullable();
            $table->enum('kategori', ['foto', 'video'])->default('foto');
            $table->string('foto', 255)->nullable(); 
            $table->string('video', 255)->nullable(); 
            $table->enum('status', ['draft', 'publish'])->default('draft');
            $table->date('tanggal')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galeris');
    }
};