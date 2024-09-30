<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Http\Requests\PostRequest;
use App\Services\Posts\PostServiceInterface;

class PostController extends Controller
{
    protected $postService;

    public function __construct(PostServiceInterface $postService)
    {
        $this->postService = $postService;
    }

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
        $this->postService->updateOrCreate($request);

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
        $this->postService->updateOrCreate($request, $post);

        return redirect()->route('posts.edit', $post->id);
    }

    public function delete(Post $post)
    {
        $this->postService->delete($post);

        return redirect()->back();
    }
}
