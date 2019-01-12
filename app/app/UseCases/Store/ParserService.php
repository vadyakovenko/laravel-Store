<?php

namespace App\UseCases\Store;
use Symfony\Component\DomCrawler\Crawler;
use App\Entity\Store\Product\Product;
use App\Entity\Store\Product\ProductVariant;
use App\Entity\Store\Product\Photo;
use App\Entity\Store\Product\Size;

class ParserService
{
    public function start()
    {
        $xml = file_get_contents('https://timeofstyle.com/standart_yml_catalog.xml');
        $crawler = new Crawler($xml);

        $oldItem = ['code' => null, 'variantCode' => null];
  
        $crawler->filter('yml_catalog shop offers offer')->reduce(function (Crawler $node) use (&$oldItem) {
            if($oldItem['code'] != explode('|', $node->attr('id'))[0]) {
                $product = Product::create([
                    'name' => $node->filter('name')->text(),
                    'code' => explode('|', $node->attr('id'))[0],
                    'description' => $node->filter('description')->text(),
                    'provider_id' => 2
                ]);
                
                $oldItem['code'] = $product->code;
                $oldItem['product_id'] = $product->id;
            }

            if($oldItem['variantCode'] != implode( '|', [explode('|', $node->attr('id'))[0], explode('|', $node->attr('id'))[1]] )){
                $productVariant =  ProductVariant::create([
                    'product_id' => $oldItem['product_id'],
                    'code' => implode( '|', [explode('|', $node->attr('id'))[0], explode('|', $node->attr('id'))[1]] ),
                    'color_value' => $node->filter('param[name="Цвет"]')->text(),
                    'price' => $node->filter('price')->text(),
                    'original_url' => $node->filter('url')->text(),
                    'quantity' => $node->filter('quantity')->text(),
                ]);

                $oldItem['variantId'] = $productVariant->id;
                $oldItem['variantCode'] = $productVariant->code;

                $node->filter('picture')->reduce(function (Crawler $node, $i) use ($productVariant) {
                    $photo = Photo::create([
                        'variation_id' => $productVariant->id,
                        'path' => $node->text(),
                    ]);
    
                    if($i == 0) {
                        $productVariant->update(['main_photo_id'=>$photo->id]);
                    }
                });
            
            }

            // $node->filter('size')->reduce(function (Crawler $node) use ($oldItem) {
                $size = $node->filter('param[name="Размер"]');
                $quantity = $node->filter('quantity');
                if($size->count()) {
                    Size::create([
                        'variation_id' => $oldItem['variantId'],
                        'parser_value' => $size->text(),
                        'quantity' => empty($quantity) ? null : $quantity->text(),
                    ]);
                }

            // });
            
        });


    }
}


////////////////////////////////////////////////GLEM////////////////////////////////////////////////
// $xml = file_get_contents('https://glem.com.ua/eshop/xml.php?user=23dc7c56606bb7e36b636c841c445d1b');
// $crawler = new Crawler($xml);

// $oldItem['name'] = '';

// $crawler->filter('yml_catalog shop offers offer')->reduce(function (Crawler $node) use (&$oldItem) {
//     if($oldItem['name'] != $node->filter('model')->text()) {
//         $product = Product::create([
//             'name' => $node->filter('model')->text(),
//             'code' => $node->attr('id'),
//             'description' => $node->filter('description')->text(),
//             'provider_id' => 1
//         ]);
        
//         $oldItem['name'] = $node->filter('model')->text();
//         $oldItem['product_id'] = $product->id;
//     }

//     $productVariant =  ProductVariant::create([
//         'product_id' => $oldItem['product_id'],
//         'code' => $node->attr('id'),
//         'color_value' => $node->filter('param[name="Цвет"]')->text(),
//         'price' => $node->filter('price')->text(),
//         'original_url' => $node->filter('url')->text(),
//     ]);

//     $node->filter('picture')->reduce(function (Crawler $node, $i) use ($productVariant) {
//         $photo = Photo::create([
//             'variation_id' => $productVariant->id,
//             'path' => $node->text(),
//         ]);

//         if($i == 0) {
//             $productVariant->update(['main_photo_id'=>$photo->id]);
//         }
//     });

//     $node->filter('size')->reduce(function (Crawler $node) use ($productVariant) {
//         Size::create([
//             'variation_id' => $productVariant->id,
//             'parser_value' => $node->text(),
//             'quantity' => $node->attr('quantity')
//         ]);
//     });
    


// });