<?php

namespace App\Modules\Parser;

use Symfony\Component\DomCrawler\Crawler;
use App\Entity\Store\Product\Product;
use App\Entity\Store\Product\ProductVariant;
use App\Entity\Store\Product\Photo;
use App\Entity\Store\Product\Size;
use App\Entity\Store\Provider\Provider;
use App\Entity\Store\Characteristics\Size as StoreSize;
use App\Entity\Store\Characteristics\Color;
use App\Entity\Store\Category as StoreCategory;
use App\Entity\Store\Provider\Category;
use App\Entity\Store\Provider\Import\Fields\BaseField;

class ColorSizeParser extends BaseParser
{
    public function parse()
    {

        dd($this->settings->product);


        ini_set('max_execution_time', 0);
    

        $xml = file_get_contents(public_path("timeofstyle.xml"));
        $crawler = new Crawler($xml);
        $oldItem = ['code' => null, 'variantCode' => null, 'variantId' => null];
  
        $crawler->filter($settings->product->selector)->reduce(function (Crawler $node) use (&$oldItem) {

            if($oldItem['code'] != explode('|', $node->attr('id'))[0]) {

                $category = $this->provider->categories()->where('category_id', $node->filter('categoryId ')->text())->first();
                $product = Product::create([
                    'name' => $node->filter('name')->text(),
                    'code' => explode('|', $node->attr('id'))[0],
                    'provider_id' => $this->provider->id,
                    'category_id' => $category ? ($category->storeCategory ? $category->storeCategory->id : null) : null,
                ]);
                
                $oldItem['code'] = $product->code;
                $oldItem['product_id'] = $product->id;
            }

            $variantCode = implode( '|', [explode('|', $node->attr('id'))[0], explode('|', $node->attr('id'))[1]] );
            
            if(!ProductVariant::where('code', $variantCode)->first() ){
                $parserColor = $node->filter('param[name="Цвет"]')->text();
               
                $color = Color::where('name', $parserColor)->first();

                $productVariant =  ProductVariant::create([
                    'product_id' => $oldItem['product_id'],
                    'code' => $variantCode,
                    'description' => $node->filter('description')->text(),
                    'color_value' => $parserColor,
                    'color_id' => $color ? $color->id : null,
                    'price' => ceil((float)$node->filter('price')->text() * 1.2),
                    'parser_price' => $node->filter('price')->text(),
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
                    $storeSize = StoreSize::where('value', $size->text())->first();
                    
                    Size::create([
                        'variation_id' => $oldItem['variantId'],
                        'parser_value' => $size->text(),
                        'quantity' => empty($quantity) ? null : $quantity->text(),
                        'size_id' => $storeSize ? $storeSize->id : null,
                    ]);
                }

            // });
            
        });

    }

}