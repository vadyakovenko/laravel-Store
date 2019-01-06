<?php

namespace App\Entity\Store\Characteristics;

use Illuminate\Database\Eloquent\Model;
use App\Entity\Store\Product\Size as ParserSize;

class Size extends Model
{
    protected $fillable = ['value', 'sort'];

    public $timestamps = false;

    protected $table = 'products_sizes';

    public function parserSize()
    {
        return $this->belongsTo(ParserSize::class);
    }
}