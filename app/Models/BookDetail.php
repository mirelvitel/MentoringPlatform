<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookDetail extends Model
{
    use HasFactory;

    protected $table = 'book_details';

    protected $fillable = [
        'resource_id',
        'rating',
        'reviews_count',
        'short_description',
        'long_description',
    ];
}
