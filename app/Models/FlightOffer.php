<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlightOffer extends Model
{
    protected $table = 'FLIGHT_OFFERS';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'price',
        'base_price',
        'adults',
        'oneway',
        'source_offert',
        'last_ticketing_datetime',
        'bookedUserId',
        'destination',
        'origin',
        'departureDate',
        'returnDate',
    ];

    protected $dates = [
        'last_ticketing_datetime',
        'departureDate',
        'returnDate',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'bookedUserId');
    }

    public function flights()
    {
        return $this->hasMany(Flight::class, 'offertId');
    }
}