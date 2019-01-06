<?php

namespace App\Entity\Store\Product;

use Illuminate\Database\Eloquent\Model;

use App\Entity\Store\Characteristics\Size as StoreSize;

class Size extends Model
{
    public $timestamps = false;

    protected $table = 'sizes_product_variations';

    protected $fillable = ['variation_id', 'size_id', 'parser_value', 'quantity'];

    public function storeSize()
    {
        return $this->belongsTo(StoreSize::class, 'size_id', 'id');
    }
}