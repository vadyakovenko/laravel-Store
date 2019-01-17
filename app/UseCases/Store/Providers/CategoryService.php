<?php

namespace App\UseCases\Store\Providers;

use App\Entity\Store\Provider\Provider;
use Symfony\Component\DomCrawler\Crawler;
use App\Entity\Store\Provider\Category;


class CategoryService
{
    public function parse(Provider $provider)
    {
        $xml = file_get_contents($provider->xml_url);
        $crawler = new Crawler($xml);
  
        $crawler->filter('yml_catalog shop categories category')->reduce(function (Crawler $node) use ($provider) {
            Category::create([
                'provider_id' => $provider->id,
                'category_id' => $node->attr('id'),
                'parent_category_id' => $node->attr('parentId'),
                'value' => $node->text()
            ]);
        });
    }
}
