<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    // Specify the table name
    protected $table = 'citys';

    // Specify the fillable attributes
    protected $fillable = ['city_state'];
}
