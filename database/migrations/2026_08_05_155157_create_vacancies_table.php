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
        Schema::create('vacancies', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->boolean('published')->default(true);
            $table->string('deadline')->nullable();
            $table->string('title_en');
            $table->string('title_am');
            $table->string('title_aa');
            $table->longText('description_en');
            $table->longText('description_am');
            $table->longText('description_aa');
            $table->longText('requirements_en');
            $table->longText('requirements_am');
            $table->longText('requirements_aa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vacancies');
    }
};
