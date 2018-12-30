<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Entity\Store\Category;
use App\UseCases\Store\CategoryService;
use App\Http\Requests\Categories\CategoryCreateRequest;
use App\Http\Requests\Categories\CategoryUpdateRequest;

class CategoryController extends Controller
{
    private $category;

    public function __construct(CategoryService $category)
    {
        $this->category = $category;
    }

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
        $this->category->create($request);

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
        $this->category->update($request, $category);

        return redirect()->route('admin.categories.index')->with('success', 'Категория успешно обновлена!');
    }

    public function destroy(Category $category)
    {
        $this->category->delete($category);

        return redirect()->route('admin.categories.index')->with('success', 'Категория успешно удалена!');
    }

    public function first(Category $category)
    {
        $this->category->first($category);

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
        $this->category->last($category);

        return redirect()->route('admin.categories.index');
    }
}
