<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('name', 50);
            $table->string('username', 50)->unique(); // Username harus unik
            $table->string('password', 255); // Panjang lebih untuk menyimpan hash password
            $table->timestamps(); // Menambahkan kolom created_at dan updated_at

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admins');
    }
};
