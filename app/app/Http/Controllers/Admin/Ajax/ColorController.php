<?php

namespace App\Http\Controllers\Admin\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entity\Store\Characteristics\Color;
use App\Http\Requests\Store\Characteristics\Color\ColorCreateRequest;

class ColorController extends Controller
{
    public function store(ColorCreateRequest $request)
    {
        $color = Color::create($request->validated());
        return ['success' => 1, 'id' => $color->id, 'name' => $color->name, 'value' => $color->value];
    }
}