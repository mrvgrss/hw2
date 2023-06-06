<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    protected $table = 'FLIGHTS';
    protected $primaryKey = null;
    public $timestamps = true;
    public $incrementing = false;

    protected $fillable = [
        'offertId',
        'outbound',
        'duration',
    ];

    public function flightOffert()
    {
        return $this->belongsTo(FlightOffert::class, 'offertId');
    }
}