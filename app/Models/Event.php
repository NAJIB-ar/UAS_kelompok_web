<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'speaker', 'category', 'type', 
        'description', 'location', 'event_date', 
        'price', 'ticket_quantity', 'image'
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
