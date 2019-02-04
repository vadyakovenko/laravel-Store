<?php

namespace App\Entity\Store\Provider\Import\Fields;

class SubstructorSeparatorField extends BaseField
{
    protected function __construct(Selector $main, Selector $cut)
    {
        $this->chunks['main_selector'] = $main->selector();
        $this->chunks['main_selector_type'] = $main->type();
        $this->chunks['main_selector_attribute'] = $main->attribute();
        $this->chunks['cut_selector'] = $cut->selector();
        $this->chunks['cut_selector_type'] = $cut->type();
        $this->chunks['cut_selector_attribute'] = $cut->attribute();

        $this->chunks['separator_type'] = 'substructor_separator';
    }

    public static function create(Selector $main, Selector $cut)
    {
        return new static($main, $cut);
    }
}