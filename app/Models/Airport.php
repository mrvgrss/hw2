<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Airport extends Model
{
    protected $table = 'AIRPORTS';
    protected $primaryKey = 'iata';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = true;

    // https://laravel.com/docs/10.x/eloquent#inserts 
    protected $fillable = [
        'iata',
        'city',
        'term',
        'country',
    ];
}