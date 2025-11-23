<?php

namespace App\Providers;

use App\Models\Post;
use App\Repositories\EloquentPostRepository;
use App\Repositories\PostRepository;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class BlogServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PostRepository::class, EloquentPostRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(View $view, PostRepository $posts)
    {
        // share recent posts with all views using caching
        View::composer('*', fn($view) => $view->with('recentPosts', $posts->recent(5)));
    }
}
