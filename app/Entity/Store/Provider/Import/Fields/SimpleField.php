<?php 

namespace App\Entity\Store\Provider\Import\Fields;

class SimpleField extends BaseField
{
    public static function create(Selector $selector)
    {
        return new static($selector);
    }

}