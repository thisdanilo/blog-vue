<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;
use Illuminate\Support\Facades\Storage;
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

    public function store(PostRequest $request)
    {
        $user = auth()->user();

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('posts', 'public');
            $data['image'] = $path;
        }

        $post = Post::create([
            'title' => $request->title,
            'slug' => $request->slug,
            'content' => $request->content,
            'status' => $request->status,
            'category_id' => $request->category_id,
            'user_id' => $user->id,
            'image' => $data['image'],
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

    public function update(PostRequest $request, Post $post)
    {
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
        Storage::delete($post->image);

        $post->delete();

        return redirect()->back();
    }
}
