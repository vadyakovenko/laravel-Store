<?php

namespace App\Entity\Store\Provider\Import\Fields;

class SelectorSeparatorField extends BaseField
{
    protected function __construct(Selector $selector)
    {
        parent::__construct($selector);
        $this->chunks['separator_type'] = 'selector_separator';
    }

    public static function create(Selector $selector)
    {
        return new static($selector);
    }
}