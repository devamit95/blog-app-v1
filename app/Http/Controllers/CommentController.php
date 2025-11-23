<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('audit');
    }

    public function store(Request $request, Post $post)
    {
        try {
            $data = $request->validate(['content' => 'required|string']);
            $comment = $post->comments()->create([
                'user_id' => Auth::id(),
                'content' => $data['content'],
            ]);

            Cache::forget("post.{$post->id}.comments");
            return back()->with('success','Comment added.');

        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

    public function edit(Comment $comment)
    {
        $this->authorize('update', $comment);
        return view('comments.edit', compact('comment'));
    }

    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        try {
            $data = $request->validate(['content' => 'required|string']);
            $comment->update($data);
            Cache::flush();

            return redirect()->route('posts.show', $comment->post)->with('success','Comment updated.');
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        try {
            $comment->delete();
            Cache::flush();

            return back()->with('success','Comment deleted.');
        } catch (\Exception $ex) {
            return redirect()->back()->with('error', $ex->getMessage());
        }
    }

}
