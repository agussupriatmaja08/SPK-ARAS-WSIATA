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
        Schema::create('wisatas', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('name', 50);
            $table->text('description');
            $table->string('waktu_operasional', 50);
            $table->string('lokasi', 50);
            $table->float('aksesibilitas', 5, 2)->nullable();
            $table->float('kondisi_alam', 5, 2)->nullable();
            $table->float('budaya', 5, 2)->nullable();
            $table->float('infrastruktur', 5, 2)->nullable();
            $table->float('jarak_terdekat', 5, 2)->nullable();
            $table->float('keamanan', 5, 2)->nullable();
            $table->integer('biaya')->nullable();
            $table->timestamps(); // Menambahkan kolom created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wisatas');
    }
};
