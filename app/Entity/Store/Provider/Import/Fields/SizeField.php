<?php

namespace App\Entity\Store\Provider\Import\Fields;

class SizeField extends BaseField
{
    protected function __construct(Selector $size, Selector $quantity)
    {
        $this->chunks['size_selector'] = $size->selector();
        $this->chunks['size_type'] = $size->type();
        $this->chunks['quantity_selector'] = $quantity->selector();
        $this->chunks['quantity_type'] = $quantity->type();
    }

    public static function create(Selector $size, Selector $quantity)
    {
        return new static($size, $quantity);
    }
}