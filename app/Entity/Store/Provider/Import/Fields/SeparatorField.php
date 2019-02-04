<?php

namespace App\Entity\Store\Provider\Import\Fields;

class SeparatorField 
{
    public static function createField(string $type, array $arguments)
    {
        if(preg_match( '#separator_explode$#', $type)) {
            return ExplodeSeparatorField::create(new Selector($arguments[$type . '_selector'], $arguments[$type . '_selector_type'], $arguments[$type . '_selector_attr']), $arguments[$type . '_delimiter'], (int) $arguments[$type . '_limit']);
        }

        if(preg_match( '#separator_selector$#', $type)) {
            return SelectorSeparatorField::create(new Selector($arguments[$type . '_selector'], $arguments[$type . '_selector_type'], $arguments[$type . '_selector_attr']));
        }

        if(preg_match( '#separator_substractor$#', $type)) {
            return SubstructorSeparatorField::create(
                                                        new Selector($arguments[$type . '_main_selector'], $arguments[$type . '_main_selector_type'], $arguments[$type . '_main_selector_attr']), 
                                                        new Selector($arguments[$type . '_cut_selector'], $arguments[$type . '_cut_selector_type'], $arguments[$type . '_cut_selector'])
                                                    );
        }

        throw new \DomainException('Unexpected separator type:' . $type);
    }

}