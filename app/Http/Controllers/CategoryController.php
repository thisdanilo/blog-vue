<?php

namespace App\Http\Controllers;

use inertia;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Services\Categories\CategoryServiceInterface;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryServiceInterface $categoryService)
    {
        $this->categoryService = $categoryService;
    }

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
        $this->categoryService->updateOrCreate($request);

        return redirect()->back();
    }   

    public function edit(Category $category)
    {
        return inertia('Categories/Edit', compact('category'));
    }

    public function update(CategoryRequest $request, Category $category)
    {
        $this->categoryService->updateOrCreate($request, $category);

        return redirect()->route('categories.edit', $category->id);
    }

    public function delete(Category $category)
    {
        $this->categoryService->delete($category);
        return redirect()->back();
    }
}
