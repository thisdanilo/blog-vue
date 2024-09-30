<?php

namespace App\Services\Posts;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Services\Posts\PostServiceInterface;

class PostService implements PostServiceInterface
{
    public function updateOrCreate(Request $request, ?Post $post = null): Post
    {
        $data = $request->except('image');

        if ($request->hasFile('image')) {
            if ($post && $post->image) {
                Storage::disk('public')->delete($post->image);
            }

            $path = $request->file('image')->store('posts', 'public');
            $data['image'] = $path;
        }

        $attributes = $post ? ['id' => $post->id] : [];
        
        $values = [
            'title' => $request->title,
            'slug' => $request->slug,
            'content' => $request->content,
            'status' => $request->status,
            'category_id' => $request->category_id,
            'user_id' => auth()->user()->id,
            'image' => $data['image'] ?? ($post->image ?? null),
        ];

        return Post::updateOrCreate($attributes, $values);
    }

    public function delete(Post $post): bool
    {
        if ($post->image) {
            Storage::disk('public')->delete($post->image);
        }

        return $post->delete();
    }
}
