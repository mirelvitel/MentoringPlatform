<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    //protected $fillable = ['file_name', 'file_path', 'type', 'description', 'title', 'author', 'category', 'publisher', 'published_date', 'pages'];
    use HasFactory;

    // Define fillable fields for mass assignment
    protected $fillable = [
        'title',
        'file_name',
        'file_path',
        'type',
        'description',
        'author',
        'category',
        'publisher',
        'published_date',
        'pages',
    ];

    
}
