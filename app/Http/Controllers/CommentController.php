<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;


class CommentController extends Controller
{
    public function __construct(Request $request)
    {
        $this->user = auth()->setRequest($request)->user();

    }

    public function store(Request $request)
    {
        $validData = $request->validate([
            'message' => 'required|string'
        ]);

        $create_comment = Comment::create([
            'content' => $request->message,
            'post_id' => $request->post_id,
            'user_id' => $this->user->id,
        ]);

        return back()->withSuccess(trans('lang.your_comment_has_been_sent'));
    }

    public function edit(Comment $comment)
    {
        return view('comment-edit', [
            'comment' => $comment
        ]);
    }

    public function update(Request $request, Comment $comment)
    {
        $validData = $request->validate([
            'content' => 'required|string'
        ]);

        $comment->update([
            'content' => $validData['content'],
            'approved' => 0
        ]);

        session()->flash('commentResult', [
            'message' => 'Comment updated successfully, it will appear after approval',
            'success' => true
        ]);

        return redirect($comment->post->specificResourcePath());
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        session()->flash('commentResult', [
            'message' => 'Comment deleted successfully',
            'success' => true
        ]);

        return redirect($comment->post->specificResourcePath());
    }

    public function approve(Comment $comment)
    {
        return $comment->update(['approved' => true]);
    }

    public function undoApproval(Comment $comment)
    {
        return $comment->update(['approved' => false]);
    }
}
