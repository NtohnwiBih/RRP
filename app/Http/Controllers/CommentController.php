<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'author' => 'required',
            'comment' => 'required',
        ]);

        $post->comments()->create($request->all());

        return redirect()->route('posts.show', $post)
                        ->with('success', 'Comment added successfully.');
    }

    public function destroy(Post $post, Comment $comment)
    {
        $comment->delete();

        return redirect()->route('posts.show', $post)
                        ->with('success', 'Comment deleted successfully.');
    }
}
