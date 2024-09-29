<?php

namespace App\Http\Controllers;

use inertia;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $categories = Category::count();

        $posts = Post::count();

        $categoryData = Category::select(
            DB::raw('EXTRACT(MONTH FROM created_at) as month'),
            DB::raw('COUNT(*) as count')
        )
        ->whereYear('created_at', date('Y'))
        ->groupBy('month')
        ->orderBy('month')
        ->get()
        ->pluck('count', 'month')
        ->toArray();

        $monthlyDataCategory = array_replace(array_fill(1, 12, 0), $categoryData);

        $postData = Post::select(
            DB::raw('EXTRACT(MONTH FROM created_at) as month'),
            DB::raw('COUNT(*) as count')
        )
        ->whereYear('created_at', date('Y'))
        ->groupBy('month')
        ->orderBy('month')
        ->get()
        ->pluck('count', 'month')
        ->toArray();    

        $monthlyDataPost = array_replace(array_fill(1, 12, 0), $postData);

        $postsByCategoryData = Category::withCount('posts')
            ->get()
            ->pluck('posts_count', 'name')
            ->toArray();

        return inertia('Dashboard', [
            'categories' => $categories,
            'categoryData' => array_values($monthlyDataCategory),
            'posts' => $posts,
            'postData' => array_values($monthlyDataPost),
            'postsByCategoryData' => $postsByCategoryData,
        ]);
    }
}
