<?php

namespace App\Modules\Parser;

use App\Entity\Store\Provider\Import\ImportSettings;
use App\Entity\Store\Provider\Provider;

class Builder
{
    public static function createParser(Provider $provider)
    {
        if(ImportSettings::COLOR_SIZE_TYPE == $provider->importSettings->import_method) {
            return new ColorSizeParser($provider);
        } 

        if(ImportSettings::COLOR_SIZES_TYPE == $provider->importSettings->import_method) {
            return new ColorSizeParser($provider);
        } 

        throw new \DomainException('Provider ' .  $provider->name . ' hasn\'t correct import method:' . $provider->importSettings->import_method . '!');
    }
}