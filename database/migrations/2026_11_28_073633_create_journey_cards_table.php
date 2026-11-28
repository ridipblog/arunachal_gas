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
        Schema::create('journey_cards', function (Blueprint $table) {
            $table->id();
            $table->string('title', 180);
            $table->string('description', 255);
            $table->string('image_path', 255);
            $table->string('image_alt', 180)->nullable();
            $table->integer('order')->default(1)->index();
            $table->string('link_url', 255)->nullable();
            $table->boolean('is_active')->default(true)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('journey_cards');
    }
};
