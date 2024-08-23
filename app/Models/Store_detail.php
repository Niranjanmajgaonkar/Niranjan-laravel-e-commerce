<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class StoreDetail extends Authenticatable
{
    use Notifiable;

    protected $table = 'store_details';

    protected $fillable = [
        'store_name',
        'email',
        'password',
        'mobile',     // Add this line
        'store_id',   // Add this line
    ];
    

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
