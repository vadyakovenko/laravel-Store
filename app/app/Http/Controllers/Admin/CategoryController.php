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

        return redirect()->route('admin.categories.index')->with('success', 'Новая категория успешно добавлена!');
    }

    public function show(Category $category)
    {
        return view('admin.categories.show', compact('category'));
    }

    public function edit(Category $category)
    {
        $categories = Category::treeWithDepth();
        return view('admin.categories.edit', compact('category', 'categories'));
    }

    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $category->update([
            'name' => $request['name'],
            'slug' => $request['slug'],
            'parent_id' => $request['parent_id'],
            'is_active' => $request['is_active'] ? 1 : 0,
        ]);
        return redirect()->route('admin.categories.index')->with('success', 'Категория успешно обновлена!');
    }

    public function destroy(Category $category)
    {
        if(!$category->delete()) {
            throw new \RuntimeException('Error deleting category!');
        }
        return redirect()->route('admin.categories.index')->with('success', 'Категория успешно удалена!');
    }

    public function first(Category $category)
    {
        if ($first = $category->siblings()->defaultOrder()->first()) {
            $category->insertBeforeNode($first);
        }

        return redirect()->route('admin.categories.index');
    }

    public function up(Category $category)
    {
        $category->up();
        
        return redirect()->route('admin.categories.index');
    }

    public function down(Category $category)
    {
        $category->down();

        return redirect()->route('admin.categories.index');
    }

    public function last(Category $category)
    {
        if ($last = $category->siblings()->defaultOrder('desc')->first()) {
            $category->insertAfterNode($last);
        }

        return redirect()->route('admin.categories.index');
    }
}
