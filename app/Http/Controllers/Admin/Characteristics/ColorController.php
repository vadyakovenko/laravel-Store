<?php

namespace App\Http\Controllers\Admin\Characteristics;

use App\Http\Controllers\Controller;
use App\Entity\Store\Characteristics\Color;
use App\Http\Requests\Store\Characteristics\Color\ColorCreateRequest;
use App\Http\Requests\Store\Characteristics\Color\ColorUpdateRequest;
use App\UseCases\Store\Characteristics\ColorService;

class ColorController extends Controller
{
    private $color;

    public function __construct(ColorService $color)
    {
        $this->color = $color;
    }

    public function index()
    {
        $colors = Color::allBySort();
        return view('admin.characteristics.colors.index', compact('colors'));
    }

    public function create()
    {
        return view('admin.characteristics.colors.create', compact('colors'));
    }

    public function store(ColorCreateRequest $request)
    {
        $this->color->create($request);
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
        $this->color->delete($color);

        return redirect()->route('admin.characteristics.colors.index')->with('success', 'Цвет удален!');
    }

    public function up(Color $color)
    {
        $color->up();
        return redirect()->route('admin.characteristics.colors.index');
    }

    public function down(Color $color)
    {
        $color->down();
        return redirect()->route('admin.characteristics.colors.index');
    }

    public function first(Color $color)
    {
        $color->first();
        return redirect()->route('admin.characteristics.colors.index');
    }

    public function last(Color $color)
    {
        $color->last();
        return redirect()->route('admin.characteristics.colors.index');
    }
}
