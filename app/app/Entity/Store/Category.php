<?php

namespace App\Entity\Store;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;
use App\Entity\Store\MetaData;

class Category extends Model
{
    use NodeTrait;

    public $timestamps = false;

    protected $fillable = ['name', 'slug', 'is_active', 'parent_id', 'seo_json'];

    public function scopeTreeWithDepth($query)
    {
        return $query->defaultOrder()->withDepth()->get();
    }

    public function setMetaData(MetaData $data)
    {
        $this->seo_json = $data->serialize();
    }

    public function getMetaAttribute()
    {
        return MetaData::unserialize($this->seo_json);
    }

    public function path()
    {
        return ($this->parent ? $this->parent->path() . '/' : '') . $this->name; 
    }
}