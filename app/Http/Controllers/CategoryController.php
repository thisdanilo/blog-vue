<?php

namespace App\Http\Controllers;

use inertia;
use App\Models\Category;
use Illuminate\Http\Request;

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

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255'
        ]);

        $user = auth()->user();

        Category::create([
            'name' => $request->name,
            'slug' => $request->slug,
            'description' => $request->description,
            'user_id' => $user->id,
        ]);

        return redirect()->back();
    }

    public function delete(Category $category)
    {
        $category->delete();
        return redirect()->back();
    }
}
