<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable =
    [
        'cate-id',
        'car_name',
        'car_type',
        'car_description',
        'car_image',
        'car_price',
        'car_qty',
        'car_status',
        'car_trending',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'cate_id','id');
    }
}
