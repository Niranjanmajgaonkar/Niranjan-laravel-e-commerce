<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',  // Add this line
        'store_id',    // Add this line
        'title',
        'price',
        'description',
        'category',
        'quantity',
        'image',
        'rating_rate',
        'rating_count',
    ];
}
