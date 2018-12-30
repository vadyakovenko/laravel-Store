<?php

namespace App\Entity\Store\Provider;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'url', 'conditions', 'comment'];
}
