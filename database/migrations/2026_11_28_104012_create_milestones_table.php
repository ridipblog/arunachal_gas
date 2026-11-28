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
        Schema::create('milestones', function (Blueprint $table) {
            $table->id();
            $table->string('period', 60);
            $table->string('title', 255);
            $table->string('icon', 60)->default('document');
            $table->string('custom_icon_path', 255)->nullable();
            $table->boolean('is_highlighted')->default(false)->index();
            $table->integer('order')->default(1)->index();
            $table->boolean('is_active')->default(true)->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('milestones');
    }
};
