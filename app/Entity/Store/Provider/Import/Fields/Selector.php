<?php

namespace App\Entity\Store\Provider\Import\Fields;

class Selector
{
    public const TAG_TYPE = 'tag';
    public const ATTR_TYPE = 'attr';

    private $selector;
    private $attribute;
    private $type;

    public function __construct(string $selector, string $type = self::TAG_TYPE, $attr = null)
    {
        $this->selector = $selector;

        if ( $type == self::TAG_TYPE ) {
            $this->type = $type;
            $this->attribute = null;
        } elseif( $type == self::ATTR_TYPE  && !empty($attr)) {
            $this->type = $type;
            $this->attribute = $attr;
        } else {
            throw new \DomainException('Invalid selector type');
        }
    }

    public function selector()
    {
        return $this->selector;
    }

    public function attribute()
    {
        return $this->attribute;
    }

    public function type()
    {
        return $this->type;
    }

    public static function typesList() : array
    {
        return [self::TAG_TYPE, self::ATTR_TYPE];
    }

    public function isTag()
    {
        return $this->type == self::TAG_TYPE;
    }

    public function isAttr()
    {
        return $this->type == self::ATTR_TYPE;
    }

}