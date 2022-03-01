<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function editPost(Post $post)
    {
        $this->authorize('edit', Post::class);
        return $post;
    }

    public function deletePost(Post $post)
    {
        $this->authorize('delete', Post::class);
        return $post;
    }
}
