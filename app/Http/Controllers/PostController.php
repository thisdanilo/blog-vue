<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('category')->get();
        return inertia('Posts/Index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::get();
        return inertia('Posts/Create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|boolean',
            'category_id' => 'required|exists:categories,id',
        ]);

        $user = auth()->user();

        Post::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'content' => $request->content,
            'status' => $request->status,
            'category_id' => $request->category_id,
            'user_id' => $user->id,
        ]);

        return redirect()->back();
    }

    public function edit(Post $post)
    {
        $categories = Category::get();
        
        $post->load(['category' => function ($query) {
            $query->withTrashed();
        }]);
        
        $categoriesForSelect = $categories->map(function ($category) {
            return [
                'id' => $category->id,
                'name' => $category->name,
            ];
        });
        
        if ($post->category && $post->category->trashed() && !$categories->contains($post->category->id)) {
            $categoriesForSelect->push([
                'id' => $post->category->id,
                'name' => $post->category->name . ' (Deletada)',
            ]);
        }
        
        return inertia('Posts/Edit', [
            'post' => $post,
            'categories' => $categoriesForSelect,
        ]);
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|boolean',
            'category_id' => 'required|exists:categories,id',
        ]);

        $post->update([
            'title' => $request->title,
            'slug' => $request->slug,
            'content' => $request->content,
            'status' => $request->status,
            'category_id' => $request->category_id,
        ]);

        return redirect()->route('posts.edit', $post->id);
    }

    public function delete(Post $post)
    {
        $post->delete();

        return redirect()->back();
    }
}
