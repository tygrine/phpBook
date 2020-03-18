<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Post;
use App\Like;
use App\Comment;
use App\Notifications\Notify;

class ForumController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $posts = Post::orderBy('created_at','desc')->paginate(4);
        return view('forum', ['posts' => $posts]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function show($post_id)
    {   
        $post = Post::find($post_id);

        // Checks if post id exists in case the URL is manipulated to show an unobtainable post
        if (is_null($post)){
            return redirect('forum');
        }

        $post->comments = Comment::query()->where('post_id', $post_id)->orderBy('created_at','desc')->paginate(4);
        return view('posts.show')->with('post', $post);
    }

    public function store()
    {
        $data = request()->validate([
            'post-title' => 'required|max:50',
            'post-description' => 'required',
        ]);

        auth()->user()->posts()->create([
            'post_title' => $data['post-title'],
            'post_description' => $data['post-description'],
        ]);

        return redirect('forum');
    }

    public function edit($post_id)
    {
        $post = Post::find($post_id);

        // Checks if authenticated user is the post author to allow an edit (accessing edit page)
        if(Auth::User() != $post->user) {
            return redirect()->back();
        }

        return view('posts.edit')->with('post', $post);
    }

    public function update(Request $request, $post_id)
    {
        $data = request()->validate([
            'post-title' => 'required',
            'post-description' => 'required',
        ]);
        
        // Checks if authenticated user is the post author to allow an edit (on form submission)
        $post = Post::find($post_id);

        if(Auth::User() != $post->user) {
            return redirect()->back();
        } else {

        auth()->user()->posts()->find($post_id)->update([
            'post_title' => $data['post-title'],
            'post_description' => $data['post-description'],

        ]);

        }

        return redirect('forum');
    }

    public function delete($post_id)
    {
        $post = Post::find($post_id);

        // Checks if authenticated user is the post author to allow a delete
        if(Auth::User() != $post->user) {
            return redirect()->back();
        }

        $post->delete();

        return redirect('forum');
    }

    public function like(Request $request)
    {
        $post_id = $request['postId'];
        $is_like = $request['isLiked'] == 'true';
        $update = false;
        
        $post = Post::find($post_id);
         if (!$post) {
             return redirect('forum');
        }

        $user = Auth::user();
        $like = $user->likes()->where('post_id', $post_id)->first();

        if ($like) {
            $already_like = $like->like;
            $update = true;
            if ($already_like == $is_like) {
                $like->delete();
            }
        } else {
            $like = new Like();
        }

        $like->like = $is_like;
        $like->user_id = $user->id;
        $like->post_id = $post->id;

        if ($update) {
            $like->update();
        } else {
            $like->save();
            return $this->notify($post_id, $is_like);
        }

        dd($request['isLiked'], $is_like, $post_id, $user->id);
    }

    public function notify($post_id, $is_like)
    {
        $post = Post::find($post_id);
        $current_user = Auth::user();
        $is_replied = false;

        // No notification if the user has disliked the post and pressed again to remove it
        if ($is_like == false) {
            return;
        }

        $post->user->notify(new Notify($post, $is_like, $is_replied));
        dd($post_id, $is_like, $current_user);
    }
}
