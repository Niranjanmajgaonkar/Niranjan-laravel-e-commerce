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
        'mobile',
        'store_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Define the relationship with the Product model
    public function products()
    {
        return $this->hasMany(Product::class, 'store_id', 'store_id');
    }
}
