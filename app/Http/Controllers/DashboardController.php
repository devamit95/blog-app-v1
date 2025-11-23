<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    public function index()
    {
        $page = request('page', 1);
        $cacheKey = "myposts.page.{$page}";
        $posts = Cache::remember($cacheKey, 60, function () {
            return Post::myPosts()->latest()->paginate(20);
        });

        return view('dashboard', compact('posts'));
    }
}
