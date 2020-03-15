<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Post;
use App\Like;
use App\Notifications\Notify;

class ForumController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $posts = Post::orderBy('created_at','desc')->get();
        return view('forum', ['posts' => $posts]);
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        $data = request()->validate([
            'post-title' => 'required',
            'tags' => '',
            'post-description' => 'required',
        ]);

        auth()->user()->posts()->create([
            'post_title' => $data['post-title'],
            'tags' => $data['tags'],
            'post_description' => $data['post-description'],
        ]);

        return redirect('/forum/');
    }

    public function like(Request $request)
    {
        $post_id = $request['postId'];
        $is_like = $request['isLiked'] == 'true';
        $update = false;
        
        $post = Post::find($post_id);
         if (!$post) {
             return response()->json(['message'=>'No post.']);
        }

        $user = Auth::user();
        $like = $user->likes()->where('post_id', $post_id)->first();

        if ($like) {
            $already_like = $like->like;
            $update = true;
            if ($already_like == $is_like) {
                $like->delete();
                return response()->json(['message'=>'Like entry deleted']);
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

        dd($request['isLiked'], $is_like, $user->id, $post->id);

        return response()->json(['message'=>'Entry saved.']);
    }

    public function notify($post_id, $is_like)
    {
        $post = Post::find($post_id);
        $current_user = Auth::user();
        $post->user->notify(new Notify($post));
        dd($post_id, $is_like, $current_user);
    }
}
