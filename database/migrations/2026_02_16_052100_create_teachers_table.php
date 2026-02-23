<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('photo')->nullable();
            $table->string('subject')->nullable(); // Mata pelajaran utama

            $table->enum('unit', ['smp','smk']);
            $table->enum('type', ['guru','staff']);

            $table->enum('teacher_category', ['umum','produktif'])->nullable();
            // NULL jika staff

            $table->foreignId('major_id')
                  ->nullable()
                  ->constrained()
                  ->nullOnDelete();

            $table->foreignId('position_id')
                  ->nullable()
                  ->constrained()
                  ->nullOnDelete();

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
