<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Registration extends Authenticatable
{ 
    public $timestamps = true;
    protected $fillable = [
        'name', 'email', 'number', 'password',
    ];

    protected $hidden = [
        'password',
    ];
}