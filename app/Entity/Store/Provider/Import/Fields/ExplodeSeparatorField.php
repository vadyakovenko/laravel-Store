<?php

namespace App\Entity\Store\Provider\Import\Fields;

class ExplodeSeparatorField extends BaseField
{
    protected function __construct(Selector $selector, string $delimiter, int $limit)
    {
        parent::__construct($selector);
        $this->chunks['delimiter'] = $delimiter;
        $this->chunks['limit'] = $limit;
        $this->chunks['separator_type'] = 'explode_separator';
    }

    public static function create(Selector $name, string $delimiter, int $limit)
    {
        return new static($name, $delimiter, $limit);
    }
}