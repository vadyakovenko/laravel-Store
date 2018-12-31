<?php

namespace App\Http\Controllers\Admin\Characteristics;

use App\Http\Controllers\Controller;
use App\Entity\Store\Characteristics\Color;
use App\Http\Requests\Store\Characteristics\Color\ColorCreateRequest;
use App\Http\Requests\Store\Characteristics\Color\ColorUpdateRequest;

class ColorController extends Controller
{
    public function index()
    {
        $colors = Color::all();
        return view('admin.characteristics.colors.index', compact('colors'));
    }

    public function create()
    {
        return view('admin.characteristics.colors.create', compact('colors'));
    }

    public function store(ColorCreateRequest $request)
    {
        Color::create($request->validated());
        return redirect()->route('admin.characteristics.colors.index')->with('success', 'Новый цвет успешно добавлен!');
    }

    public function edit(Color $color)
    {
        return view('admin.characteristics.colors.edit', compact('color'));
    }

    public function update(ColorUpdateRequest $request, Color $color)
    {
        $color->update($request->validated());
        
        return redirect()->route('admin.characteristics.colors.index')->with('Информация о цвет успешно обновленна!');
    }

    public function destroy(Color $color)
    {
        $color->delete();

        return redirect()->route('admin.characteristics.colors.index')->with('success', 'Цвет удален!');
    }
}
