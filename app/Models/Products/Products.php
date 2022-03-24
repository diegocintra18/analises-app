<?php

namespace App\Models\Products;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'sku', 
        'name',
        'price',
        'coast_price',
        'image_url',
        'status',
        'type',
    ];

    public function stocks(){
        return $this->hasMany(Stock::class, 'product_id');
    }
}
