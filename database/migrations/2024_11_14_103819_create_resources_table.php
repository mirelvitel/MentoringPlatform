<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('resources', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('author')->nullable();
            $table->text('description')->nullable();
            $table->string('category'); // Example: Non-fiction, Reference, etc.
            $table->string('topic'); // Example: Science & Technology, Personal Development
            $table->string('cover_image')->nullable(); // Path to cover image
            $table->enum('type', ['book', 'document', 'article']); // Restrict type to specific values
            $table->timestamps();
        });

        // Insert data after creating the table
        DB::table('resources')->insert([
            [
                'title' => 'Introduction to Laravel',
                'author' => 'Taylor Otwell',
                'description' => 'A comprehensive guide to Laravel framework.',
                'category' => 'Reference',
                'topic' => 'Web Development',
                'cover_image' => 'assets/images/laravel.jpg',
                'type' => 'book',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Clean Code',
                'author' => 'Robert C. Martin',
                'description' => 'A handbook of agile software craftsmanship.',
                'category' => 'Non-fiction',
                'topic' => 'Software Development',
                'cover_image' => 'assets/images/clean_code.jpg',
                'type' => 'book',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('resources');
    }
}
