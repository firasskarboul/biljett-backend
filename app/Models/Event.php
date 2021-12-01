<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $fillable = [
        'organiser_id',
        'category_id',
        'tickets_qty',
        'longitude',
        'latitude',
        'title',
        'description',
        'event_photo',
        'start_date',
        'end_date'
    ];
}
