<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Review extends Model
{
    protected $table = 'REVIEWS';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'userId',
        'title',
        'stars',
        'details',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }
}