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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('tittle')->unique();
            $table->string('author');
            $table->string('isbn')->unique();
            $table->text('description')->nullable();
            $table->string('slug')->unique();
            $table->integer('quantity')->default(1);
            $table->integer('available')->default(1);
            $table->integer('pages')->nullable();
            $table->string('language')->nullable();
            $table->string('publisher')->nullable();
            $table->date('published_at')->nullable();
            $table->string('category')->nullable();
            $table->string('status')->default('available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
