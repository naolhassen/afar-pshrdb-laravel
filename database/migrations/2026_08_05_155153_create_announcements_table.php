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
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->string('date');
            $table->enum('type', ['tender', 'other']);
            $table->boolean('published')->default(true);
            $table->string('title_en');
            $table->string('title_am');
            $table->string('title_aa');
            $table->longText('body_en');
            $table->longText('body_am');
            $table->longText('body_aa');
            $table->string('image_url')->nullable();
            $table->string('video_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};
