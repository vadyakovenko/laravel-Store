<?php

namespace App\Entity\Store\Product;

use Illuminate\Database\Eloquent\Model;
use App\Entity\Store\Provider\Provider;
use App\Entity\Store\Product\ProductVariant;
use App\Entity\Store\Product\Photo;

class Product extends Model
{

    protected $fillable = ['name', 'description', 'code', 'slug', 'provider_id', 'category_id', 'original_url'];

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }
}