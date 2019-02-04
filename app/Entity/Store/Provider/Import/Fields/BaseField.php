<?php

namespace App\Entity\Store\Provider\Import\Fields;

class BaseField
{
    protected $chunks = [];

    protected function __construct(Selector $selector)
    {
        $this->chunks['selector'] = $selector->selector();
        $this->chunks['type'] = $selector->type();
        $this->chunks['attr'] = $selector->attribute();
    }

    public function list()
    {
        return $this->chunks;
    }
}