<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;

    // Define the fillable fields to protect against mass-assignment vulnerabilities
    protected $fillable = [
        'title', 'author', 'description', 'category', 'topic', 'cover_image'
    ];
}
