<?php

namespace App\Services;

use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Log;



class PostProcessor
{
    /**
     * Create a new Post
     */
    public function store(User $user, string $title, string $description, string $publication_date, bool $return_post = false)
    {
        $post = Post::create([
            'user_id' => $user->id,
            'title' => $title,
            'description' => $description,
            'publication_date' => $publication_date,
        ]);
        return $return_post ? $post :  $post->wasRecentlyCreated;
    }
}
