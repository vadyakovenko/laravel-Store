<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entity\Category;
use App\Http\Requests\Categories\CategoryCreateRequest;
use App\Http\Requests\Categories\CategoryUpdateRequest;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::treeWithDepth();
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::treeWithDepth();
        return view('admin.categories.create', compact('categories'));
    }

    public function store(CategoryCreateRequest $request)
    {
        Category::create([
            'name' => $request['name'],
            'slug' => $request['slug'],
            'parent_id' => $request['parent_id'],
            'is_active' => $request['is_active'] ? 1 : 0,
        ]);

        return redirect()->route('admin.category.index')->with('success', 'Новая категория успешно добавлена!');
    }

    public function show(Category $category)
    {
        return view('admin.categories.show', ['category' => $category]);
    }

    public function edit(Category $category)
    {
        $categories = Category::treeWithDepth();
        return view('admin.categories.edit', ['category' => $category, 'categories' => $categories]);
    }

    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $category->update([
            'name' => $request['name'],
            'slug' => $request['slug'],
            'parent_id' => $request['parent_id'],
            'is_active' => $request['is_active'] ? 1 : 0,
        ]);
        return redirect()->route('admin.category.index')->with('success', 'Категория успешно обновлена!');
    }

    public function destroy(Category $category)
    {
        if(!$category->delete()) {
            throw new \RuntimeException('Error deleting category!');
        }
        return redirect()->route('admin.category.index')->with('success', 'Категория успешно удалена!');
    }
}
