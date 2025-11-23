<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','role:admin']);
        $this->middleware('audit');
    }

    public function index()
    {
        $posts = Post::with(['user'])->withTrashed()->paginate(20);
        return view('admin.posts.index', compact('posts'));
    }

    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post->update($data);
        return redirect()->route('admin.posts.index')->with('success','Post updated.');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return back()->with('success','Post deleted.');
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $post->restore();
        return back()->with('success','Post restored.');
    }

}
