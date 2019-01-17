<?php

namespace App\Parser;

use App\Parser\RepositoryInterface;

class XmlRepository implements RepositoryInterface
{
    private $link;

    public function __construct(string $link)
    {
        $this->link = $link;
    }

    public function getData()
    {
        return file_get_contents($this->link);
    }
}