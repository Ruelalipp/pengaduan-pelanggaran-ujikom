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
       Schema::create('aspirasi', function (Blueprint $table) {
    $table->id();

    $table->foreignId('input_aspirasi_id')->constrained('input_aspirasi');
    $table->foreignId('admin_id')->constrained('admin');

    $table->enum('status',['Menunggu','Proses','Selesai'])->default('Menunggu');
    $table->string('gambar')->nullable();
    $table->text('feedback')->nullable();
    $table->timestamps();
    });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aspirasi');
    }
};
