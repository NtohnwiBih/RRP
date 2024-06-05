<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;
use Auth;

class CommentController extends Controller
{
    // public function store(Request $request, Post $post)
    // {
    //     $request->validate([
    //         'author' => 'required',
    //         'comment' => 'required',
    //     ]);

    //     $post->comments()->create($request->all());

    //     return redirect()->route('posts.show', $post)
    //                     ->with('success', 'Comment added successfully.');
    // }

    // public function destroy(Post $post, Comment $comment)
    // {
    //     $comment->delete();

    //     return redirect()->route('posts.show', $post)
    //                     ->with('success', 'Comment deleted successfully.');
    // }

    public function store(Request $request, $postId)
    {
        $request->validate([
            'body' => 'required',
            'parent_id' => 'nullable|exists:comments,id'
        ]);

        $comment = new Comment([
            'user_id' => Auth::id(),
            'post_id' => $postId,
            'body' => $request->body,
            'parent_id' => $request->parent_id
        ]);

        $comment->save();

        return redirect()->back();
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();

        return back();
    }
}
