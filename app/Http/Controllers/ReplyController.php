<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reply;

class ReplyController extends Controller
{
    public function store(Request $request, $commentId)
    {
        $request->validate(['body' => 'required']);

        $reply = new Reply();
        $reply->body = $request->body;
        $reply->user_id = auth()->id();
        $reply->comment_id = $commentId;
        $reply->save();

        return back();
    }

    public function destroy(Reply $reply)
    {
        $this->authorize('delete', $reply);
        $reply->delete();

        return back();
    }
}
