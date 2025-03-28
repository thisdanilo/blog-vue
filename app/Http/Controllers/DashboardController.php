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

        $postMonthData = Post::select(
            DB::raw('EXTRACT(MONTH FROM created_at) as month'),
            DB::raw('COUNT(*) as count')
        )
        ->whereYear('created_at', date('Y'))
        ->groupBy('month')
        ->orderBy('month')
        ->get()
        ->pluck('count', 'month')
        ->toArray();

        $monthlyDataPostCount = array_replace(array_fill(1, 12, 0), $postMonthData);

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
            ->withTrashed()
            ->get()
            ->pluck('posts_count', 'name')
            ->toArray();

        return inertia('Dashboard', [
            'categories' => $categories,
            'posts' => $posts,
            'postData' => array_values($monthlyDataPost),
            'postsByCategoryData' => $postsByCategoryData,
            'postMonthData' => array_values($monthlyDataPostCount),
        ]);
    }
}
