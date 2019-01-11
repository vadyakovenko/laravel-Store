<?php
namespace App\UseCases\Store\Characteristics;
use App\Entity\Store\Characteristics\Color;
use App\Http\Requests\Store\Characteristics\Color\ColorCreateRequest;

class ColorService
{
    public function create(ColorCreateRequest $request)
    {
        return Color::_append($request->validated());
    }

    public function delete(Color $color)
    {
        return $color->remove();
    }
}