<?php 

namespace App\Entity\Store\Provider\Import\Fields;

class SimpleField extends BaseField
{
    protected function __construct(Selector $selector)
    {
        $this->chunks['selector'] = $selector->selector();
        $this->chunks['type'] = $selector->type();
    }

    public static function create(Selector $selector)
    {
        return new static($selector);
    }

}