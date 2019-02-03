<?php

namespace App\Entity\Store\Provider\Import;

use Illuminate\Database\Eloquent\Model;

class ImportSettings extends Model
{
    protected $table = 'import_settings';

    protected $fillable = [
                            'provider_id',
                            'import_method',
                            'separator_product', 
                            'separator_variant',
                            'product',
                            'name',
                            'code',
                            'price',
                            'description',
                            'quantity',
                            'color',
                            'size',
                            'photo'
                        ];

    protected $casts = [
                            'separator_product' => 'array', 
                            'separator_variant' => 'array',
                            'product' => 'array',
                            'name' => 'array',
                            'code' => 'array',
                            'price' => 'array',
                            'description' => 'array',
                            'quantity' => 'array',
                            'color' => 'array',
                            'size' => 'array',
                            'photo' => 'array'
                        ];

    public const Type1 = 'color-size';
    public const Type2 = 'color-sizes';

    public static function importsList()
    {
        return [self::Type1, self::Type2];
    }
}