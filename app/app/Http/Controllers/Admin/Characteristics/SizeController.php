<?php

namespace App\Http\Controllers\Admin\Characteristics;

use App\Http\Controllers\Controller;
use App\Entity\Store\Characteristics\Size;
use App\Http\Requests\Store\Characteristics\Size\SizeCreateRequest;
use App\Http\Requests\Store\Characteristics\Size\SizeUpdateRequest;

class SizeController extends Controller
{
    public function index()
    {
        $sizes = Size::all();
        return view('admin.characteristics.sizes.index', compact('sizes'));
    }

    public function create()
    {
        return view('admin.characteristics.sizes.create', compact('sizes'));
    }

    public function store(SizeCreateRequest $request)
    {
        Size::create($request->validated());
        return redirect()->route('admin.characteristics.sizes.index')->with('success', 'Новый размер успешно добавлен!');
    }

    public function edit(Size $size)
    {
        return view('admin.characteristics.sizes.edit', compact('size'));
    }

    public function update(SizeUpdateRequest $request, Size $size)
    {
        $size->update($request->validated());
        
        return redirect()->route('admin.characteristics.sizes.index')->with('Информация о размер успешно обновленна!');
    }

    public function destroy(Size $size)
    {
        $size->delete();

        return redirect()->route('admin.characteristics.sizes.index')->with('success', 'Цвет удален!');
    }
}
