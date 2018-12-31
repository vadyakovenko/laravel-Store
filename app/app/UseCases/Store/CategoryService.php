<?php

namespace App\UseCases\Store;

use App\Entity\Store\Category;
use App\Entity\Store\MetaData;
use App\Http\Requests\Store\Categories\CategoryCreateRequest;
use App\Http\Requests\Store\Categories\CategoryUpdateRequest;

class CategoryService
{
    public function create(CategoryCreateRequest $request)
    {
        $meta = new MetaData($request['seo_title'], $request['seo_description'], $request['seo_keywords']);

        $category = Category::create([
            'name' => $request['name'],
            'slug' => $request['slug'],
            'parent_id' => $request['parent_id'],
            'is_active' => (bool) $request['is_active'],
            'seo_json' => $meta->serialize(),
        ]);

        return $category;
    }

    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $meta = new MetaData($request['seo_title'], $request['seo_description'], $request['seo_keywords']);

        $category->update([
            'name' => $request['name'],
            'slug' => $request['slug'],
            'parent_id' => $request['parent_id'],
            'is_active' => (bool) $request['is_active'],
            'seo_json' => $meta->serialize(),
        ]);

        return $category;
    }

    public function delete(Category $category)
    {
        return $category->delete();
    }

    public function first(Category $category)
    {
        if ($first = $category->siblings()->defaultOrder()->first()) {
            $category->insertBeforeNode($first);
        }

        return $category;
    }

    public function last(Category $category)
    {
        if ($last = $category->siblings()->defaultOrder('desc')->first()) {
            $category->insertAfterNode($last);
        }

        return $category;
    }
}
