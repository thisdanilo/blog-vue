<?php

namespace App\Services\Posts;

use App\Models\Post;
use Illuminate\Http\Request;

interface PostServiceInterface
{
    public function updateOrCreate(Request $request, ?Post $post = null): Post;
    public function delete(Post $post): bool;
}
