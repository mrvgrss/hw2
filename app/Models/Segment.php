<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Segment extends Model
{
    protected $table = 'SEGMENTS';
    protected $primaryKey = null; 
    public $timestamps = true;
    public $incrementing = false;

    protected $fillable = [
        'offertId',
        'outbound',
        'segment_n',
        'duration',
        'departure_airport',
        'departure_terminal',
        'departure_datetime',
        'arrival_airport',
        'arrival_datetime',
        'company_name',
        'aircraft',
    ];

    protected $casts = [
        'outbound' => 'boolean',
        'departure_datetime' => 'datetime',
        'arrival_datetime' => 'datetime',
    ];

    public function flightOffer()
    {
        return $this->belongsTo(FlightOffer::class, 'offertId');
    }
}