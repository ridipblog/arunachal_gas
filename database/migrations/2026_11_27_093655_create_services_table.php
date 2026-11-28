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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('number_label', 10);
            $table->string('title', 120);
            $table->string('slug', 150)->unique();
            $table->text('card_heading');
            $table->json('badges')->nullable();
            $table->string('image_path', 255);
            $table->string('image_alt', 150)->nullable();
            $table->text('description');
            $table->string('button_text', 60)->default('Know More');
            $table->string('button_url', 255)->default('#contact');
            $table->integer('order')->default(0)->index();
            $table->boolean('is_active')->default(true)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
