<?php

namespace App\Entity\Store\Characteristics;

use Illuminate\Database\Eloquent\Model;
use App\Entity\Store\SortTrait;

class Color extends Model
{
    use SortTrait;

    protected $fillable = ['name', 'value', 'sort'];

    public $timestamps = false;

    protected $table = 'products_colors';

}