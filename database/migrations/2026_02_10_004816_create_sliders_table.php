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
        Schema::create('sliders', function (Blueprint $table) {
        $table->id();
        $table->string('title')->nullable();
        $table->string('image');
        $table->enum('type', [
            'home_hero',
            'home_facility',
            'smp_visimisi',
            'smk_visimisi'
        ]);
        $table->integer('order_no')->default(0);
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sliders');
    }
};
