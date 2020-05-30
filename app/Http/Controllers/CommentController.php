<?php

namespace App\Http\Controllers;

use App\UserPost;
use Illuminate\Http\Request;
use App\Comment;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $comment = new Comment;
        $comment->body = $request->get('com_inu');
        $comment->user()->associate($request->user());
        $post = UserPost::find($request->get('posts_id'));
        $post->comments()->save($comment);
        return back();
    }

    public function replyStore(Request $request)
    {
        $reply = new Comment();
        $reply->body = $request->get('comment_body');
        $reply->user()->associate($request->user());
        $reply->parent_id = $request->get('comment_id');
        $post = UserPost::find($request->get('post_id'));
        $post->comments()->save($reply);
        return back();
    }
}
