<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'USERS';
    protected $primaryKey = 'id';
    public $timestamps = true;

    // https://laravel.com/docs/10.x/eloquent#configuring-eloquent-strictness
    protected $fillable = [
        'email',
        'password',
        'name',
        'surname',
    ];

    protected $hidden = [
        'password',
    ];
}