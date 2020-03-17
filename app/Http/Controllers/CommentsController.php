<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Comment;
use App\Post;
use App\Notifications\Notify;

class CommentsController extends Controller
{
    public function store(Request $request, $post_id)
    {
        $data = request()->validate([
            'comment-description' => 'required|max:2000'
        ]);
        
        $post = Post::find($post_id);

        $comment = new Comment();
        $comment->user_id = auth()->user()->id;
        $comment->comment_description = $data['comment-description'];
        $comment->post()->associate($post);
        $is_replied = true;
        $comment->save();
        $this->notify($post_id, $is_replied);
        
        return redirect()->back();
    }

    public function notify($post_id, $is_replied)
    {
        $post = Post::find($post_id);
        $current_user = Auth::user();
        $is_like = false;
        $post->user->notify(new Notify($post, $is_like, $is_replied));
    }

    public function delete($comment_id)
    {
        $comment = Comment::find($comment_id);
        // Checks if authenticated user is the comment author to allow a delete
        if(Auth::User() != $comment->user) {
            return redirect()->back();
        }
        $comment->delete();
        return redirect()->back();;
    }
}
