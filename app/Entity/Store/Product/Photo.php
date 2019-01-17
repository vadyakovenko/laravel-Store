<?php 

namespace App\Entity\Store\Product;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = ['variation_id', 'path'];

    public $timestamps = false;

}