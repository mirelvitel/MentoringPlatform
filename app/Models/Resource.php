<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    use HasFactory;

    /**
     * By using $guarded = [], you permit mass assignment of all fields.
     * If you want to restrict which fields can be mass-assigned,
     * you can either replace this with $fillable = [ ... ]
     * or selectively guard fields you don’t want mass-assigned.
     */
    protected $guarded = [];

    /**
     * If you need a relationship to a User model
     * (assuming you have a corresponding 'users' table),
     * you can include it like so:
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
