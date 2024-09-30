<?php

namespace App\Services\Categories;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Services\Categories\CategoryServiceInterface;

class CategoryService implements CategoryServiceInterface
{
    public function updateOrCreate(Request $request, ?Category $category = null): Category
    {
        $attributes = $category ? ['id' => $category->id] : ['name' => $request->name];
        
        $values = [
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'user_id' => auth()->user()->id,
        ];

        return Category::updateOrCreate($attributes, $values);
    }

    public function delete(Category $category): bool
    {
        return $category->delete();
    }
}
