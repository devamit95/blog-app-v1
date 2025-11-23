<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
        $this->middleware('audit');
    }

    public function index()
    {
        $postRepo = app(PostRepository::class);
        $posts = $postRepo->paginate(10);

        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
            ]);

            $post = Auth::user()->posts()->create($data);
            Cache::forget('posts.page.1');

            return redirect()->route('posts.show', $post)->with('success','Post created.');

        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

    public function show(Post $post)
    {
        $post->with(['user','comments.user']);
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $this->authorize('update', $post);
        return view('posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $this->authorize('update', $post);

        try {
            $data = $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
            ]);

            $post->update($data);
            Cache::flush();

            return redirect()->route('posts.show', $post)->with('success','Post updated.');

        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        try {
            $post->delete();
            Cache::flush();

            return redirect()->route('posts.index')->with('success','Post deleted.');
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

}
