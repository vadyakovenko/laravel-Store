<?php

namespace App\Entity\Store\Provider\Import\Fields;

class PriceField extends BaseField
{
    protected function __construct(Selector $selector, int $markup)
    {
        parent::__construct($selector);
        $this->chunks['markup'] = $markup;
    }

    public static function create(Selector $selector, int $markup)
    {
        return new static($selector, $markup);
    }

}