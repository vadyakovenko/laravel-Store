<?php

namespace App\Entity\Store\Characteristics;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $fillable = ['name', 'value', 'sort'];

    public $timestamps = false;

    protected $table = 'products_colors';
}