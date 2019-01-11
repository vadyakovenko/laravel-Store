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

    protected $fillable = ['product_id', 'code', 'color_value', 'main_photo_id', 'price', 'original_url'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
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
}