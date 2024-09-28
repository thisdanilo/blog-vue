<?php

namespace App\Http\Controllers;

use inertia;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $categories = Category::count();
        
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

        $monthlyData = array_replace(array_fill(1, 12, 0), $categoryData);

        return inertia('Dashboard', [
            'categories' => $categories,
            'categoryData' => array_values($monthlyData),
        ]);
    }
}
