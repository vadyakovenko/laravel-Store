<?php

namespace App\Entity\Store\Provider;

use Illuminate\Database\Eloquent\Model;
use App\Entity\Store\Provider\Category;
use App\Entity\Store\Product\Product;
use App\Entity\Store\Provider\Import\ImportSettings;

class Provider extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'url', 'xml_url', 'conditions', 'comment'];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function settings()
    {
        return $this->hasOne(ImportSettings::class);
    }
}
