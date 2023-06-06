<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    protected $table = 'FAVOURITE';
    protected $primaryKey = null;
    public $timestamps = true;

    protected $fillable = [
        'userId',
        'city',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }
}