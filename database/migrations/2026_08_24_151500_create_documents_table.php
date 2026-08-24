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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->boolean('published')->default(true);
            $table->string('category')->nullable();
            $table->string('title_en');
            $table->string('title_am')->nullable();
            $table->string('title_aa')->nullable();
            $table->text('description_en')->nullable();
            $table->text('description_am')->nullable();
            $table->text('description_aa')->nullable();
            $table->string('file_name')->nullable();
            $table->string('file_url');
            $table->string('file_type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
