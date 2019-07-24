<?php

namespace App\Entity\Store\Characteristics;

use Illuminate\Database\Eloquent\Model;
use App\Entity\Store\Product\Size as ParserSize;
use App\Entity\Store\SortTrait;

class Size extends Model
{
    use SortTrait;
    
    protected $fillable = ['value', 'sort'];

    public $timestamps = false;

    protected $table = 'products_sizes';

    public function parserSize()
    {
        return $this->belongsTo(ParserSize::class);
    }
}