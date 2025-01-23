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
        Schema::create('media_kontens', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('name', 50);
            $table->unsignedBigInteger('wisata_id'); // Foreign key untuk wisata
            $table->timestamps(); // Menambahkan kolom created_at dan updated_at

            // Definisikan foreign key
            $table->foreign('wisata_id')->references('id')->on('wisatas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media_kontens');
    }
};
