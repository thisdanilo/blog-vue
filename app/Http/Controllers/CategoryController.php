<?php

namespace App\Http\Controllers;

use inertia;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::get();
        return inertia('Categories/Index', compact('categories'));
    }

    public function create()
    {
        return inertia('Categories/Create');
    }

    public function store(CategoryRequest $request)
    {
        $user = auth()->user();

        Category::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'user_id' => $user->id,
        ]);

        return redirect()->back();
    }   

    public function edit(Category $category)
    {
        return inertia('Categories/Edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $category->update([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
        ]);

        return redirect()->route('categories.edit', $category->id);
    }

    public function delete(Category $category)
    {
        $category->delete();
        return redirect()->back();
    }
}
