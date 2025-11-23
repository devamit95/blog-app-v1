<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:admin']);
    }

    public function index()
    {
        $stats = [
            'users' => User::count(),
            'posts' => Post::withTrashed()->count(),
            'comments' => Comment::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

}
