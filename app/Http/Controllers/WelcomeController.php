<?php

namespace App\Http\Controllers;

use inertia;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class WelcomeController extends Controller
{
    public function index()
    {
        $categories = Category::withoutGlobalScopes()
            ->orderBy('name', 'asc')
            ->get();

        $posts = Post::withoutGlobalScopes()
            ->with(['category', 'user'])
            ->where('status', 'true')
            ->whereNull('deleted_at')
            ->orderBy('created_at', 'desc')
            ->paginate(4);

        return inertia('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'categories' => $categories,
            'posts' => $posts,
        ]);
    }
}
