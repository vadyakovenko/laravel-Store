<?php

namespace App\Http\Controllers\Admin\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entity\Store\Characteristics\Color;
use App\Http\Requests\Store\Characteristics\Color\ColorCreateRequest;
use App\UseCases\Store\Characteristics\ColorService;

class ColorController extends Controller
{
    private $color;

    public function __construct(ColorService $color)
    {
        $this->color = $color;
    }

    public function store(ColorCreateRequest $request)
    {
        $color = $this->color->create($request);
        return ['success' => 1, 'id' => $color->id, 'name' => $color->name, 'value' => $color->value];
    }
}