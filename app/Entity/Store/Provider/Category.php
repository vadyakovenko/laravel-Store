<?php

namespace App\Entity\Store\Provider;

use Illuminate\Database\Eloquent\Model;
use App\Entity\Store\Provider\Provider;
use App\Entity\Store\Category as StoreCategory;

class Category extends Model
{
    protected $table = 'providers_categories';

    protected $fillable = ['provider_id', 'category_id', 'parent_category_id', 'value', 'store_category_id'];

    public $timestamps = false;

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function storeCategory()
    {
        return $this->belongsTo(StoreCategory::class, 'store_category_id', 'id' );
    }

    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_category_id', 'category_id');
    }

    public function tree()
    {
        return ($this->parent ? $this->parent->tree() . ' | ' : '') . $this->value;
    }

}
