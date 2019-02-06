<?php

namespace App\UseCases\Store\Import;

use App\Entity\Store\Provider\Provider;
use App\Services\Parser\Builder;


class ImportService 
{
    public function start(Provider $provider)
    {
        if(!$provider->importSettings) {
            throw new \RuntimeException('Provider ' . $provider->name . ' haven\'t settings for export!' );
        }

        Builder::createParser($provider)->parse();
    }
}