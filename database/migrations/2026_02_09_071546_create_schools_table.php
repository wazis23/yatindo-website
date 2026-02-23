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
        Schema::create('schools', function (Blueprint $table) {
        $table->id();
        $table->string('name'); // SMP Tinta Emas / SMK Tinta Emas
        $table->enum('type', ['smp', 'smk']);
        $table->text('description')->nullable();
        $table->string('accreditation_no')->nullable();
        $table->string('brochure_file')->nullable();
        $table->string('headmaster_name')->nullable();
        $table->string('headmaster_photo')->nullable();
        $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('schools');
    }
};
