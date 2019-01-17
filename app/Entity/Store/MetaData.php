<?php

namespace App\Entity\Store;

class MetaData
{
    public $title;
    public $description;
    public $keywords;

    public function __construct($title, $description, $keywords)
    {
        $this->title = $title;
        $this->description = $description;
        $this->keywords = $keywords;
    }

    public function serialize()
    {
        return json_encode([
            'title' => $this->title,
            'description' => $this->description,
            'keywords' => $this->keywords,
        ]);
    }

    public static function unserialize(string $string)
    {
        $unserialized = json_decode($string);

        return new self(
            $unserialized->title,
            $unserialized->description,
            $unserialized->keywords
        );
    }
}
