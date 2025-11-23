<?php

namespace App\Repositories;

use App\Models\Post;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cache;

class EloquentPostRepository implements PostRepository
{
    public function recent(int $limit = 5)
    {
        return Cache::remember("posts.recent.{$limit}", 60, function () use ($limit) {
            return Post::with('user')->latest()->limit($limit)->get();
        });
    }

    public function paginate(int $perPage = 10): LengthAwarePaginator
    {
        $page = request('page', 1);
        return Cache::remember("posts.page.{$page}.{$perPage}", 60, function () use ($perPage) {
            return Post::with(['user','comments.user'])->latest()->paginate($perPage);
        });
    }
}
