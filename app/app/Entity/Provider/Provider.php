<?php

namespace App\Entity\Provider;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'url', 'conditions', 'comment'];
}
