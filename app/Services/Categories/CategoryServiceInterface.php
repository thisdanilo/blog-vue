<?php

namespace App\Services\Categories;

use App\Models\Category;
use Illuminate\Http\Request;

interface CategoryServiceInterface
{
    public function updateOrCreate(Request $request, ?Category $category = null): Category;
    public function delete(Category $category): bool;
}
