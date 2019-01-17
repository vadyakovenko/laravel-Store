<?php

namespace App\Entity\Store\Product;

use Illuminate\Database\Eloquent\Model;
use App\Entity\Store\Product\Product;
use App\Entity\Store\Product\Photo;
use App\Entity\Store\Product\Size;
use App\Entity\Store\Characteristics\Color;

class ProductVariant extends Model
{
    protected $table = "products_variations";

    protected $fillable = ['product_id', 'code', 'description', 'color_value', 'color_id', 'main_photo_id', 'price', 'parser_price', 'original_url'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class, 'variation_id', 'id');
    }

    public function mainPhoto()
    {
        return $this->belongsTo(Photo::class, 'main_photo_id', 'id');
    }

    public function sizes()
    {
        return $this->hasMany(Size::class, 'variation_id');
    }

    public function color()
    {
        return $this->belongsTo(Color::class, 'color_id');
    }

    public function getPriceAttribute($value)
    {
        return explode('.', $value)[0];
    }
}