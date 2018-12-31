<?php

namespace App\Entity\Store\Characteristics;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $fillable = ['value', 'sort'];

    public $timestamps = false;

    protected $table = 'products_sizes';
}