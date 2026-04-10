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
       Schema::create('organizational_structures', function (Blueprint $table) {
            $table->id();

            $table->string('unit'); // yayasan / smp / smk

            $table->string('position'); // jabatan
            $table->string('name')->nullable();

            $table->string('photo')->nullable();

            $table->unsignedBigInteger('parent_id')->nullable(); // relasi struktur

            $table->integer('order')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('organizational_structures');
    }
};
