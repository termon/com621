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
        Schema::create('author_book', function (Blueprint $table) {
            $table->id();
            $table->foreignId('author_id')->constrained()->unique();
            $table->foreignId('book_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('author_book');
    }
};

/**
 *  Prevent duplicate authors being added to a book
 *  if (! $book->authors->contains($author->id)) {
 *     $book->authors()->save($author);
 *  }
 */
