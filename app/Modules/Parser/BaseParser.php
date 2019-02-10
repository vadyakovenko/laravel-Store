<?php

namespace App\Modules\Parser;

use App\Entity\Store\Provider\Provider;

abstract class BaseParser
{

    protected $provider;

    protected $settings;

    public function __construct(Provider $provider)
    {
        $this->provider = $provider;
        $this->settings = $provider->importSettings;       
    }

    abstract public function parse();

}