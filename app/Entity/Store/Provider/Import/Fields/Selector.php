<?php

namespace App\Entity\Store\Provider\Import\Fields;

class Selector
{
    public const TAG_TYPE = 'tag';
    public const ATTR_TYPE = 'attr';

    private $selector;
    private $type;

    public function __construct(string $selector, string $type)
    {
        $this->selector = $selector;

        if ($type == self::ATTR_TYPE || $type == self::TAG_TYPE ) {
            $this->type = $type;
        } else {
            throw new \DomainException('Invalid selector type');
        }
    }

    public function selector()
    {
        return $this->selector;
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