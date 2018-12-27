<?php

namespace App\Entity;

use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
    use NodeTrait;

    public $timestamps = false;

    protected $fillable =  ['name', 'slug', 'is_active', 'parent_id'];

    public function scopeTreeWithDepth($query)
    {
        return $query->defaultOrder()->withDepth()->get();
    }
}
