<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $table = 'events';

    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class, 'shared_events', 'event_id', 'user_id');
    }
}
