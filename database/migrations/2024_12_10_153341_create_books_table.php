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
            $table->id(); // Primary Key
            $table->string('file_name'); // Name of the book file
            $table->string('file_path'); // Path to the file
            $table->string('type'); // File type (e.g., PDF, EPUB, etc.)
            $table->string('description')->nullable(); // Description of the book
            $table->string('title')->nullable(); // Title of the book
            $table->string('author')->nullable(); // Author of the book
            $table->string('category')->nullable(); // Category (e.g., Fiction, Non-fiction)
            $table->string('publisher')->nullable(); // Publisher name
            $table->date('published_date')->nullable(); // Date when the book was published
            $table->integer('pages')->nullable(); // Number of pages in the book
            $table->timestamps(); // Created at and Updated at timestamps
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
