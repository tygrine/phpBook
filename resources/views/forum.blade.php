@extends('layouts.app')

@section('content')

<div class="container">
<div class="d-flex justify-content-start">
    <a class="btn btn-outline-primary add-post" href="/forum/create" role="button" data-container="body" data-toggle="popover" data-placement="bottom" data-content="Start here or click on a post title">Add Post</a>
</div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (count($posts) > 0)
                @foreach ($posts as $post)

            <div class="card pb-1">
            <div class="card-header d-flex">
                <div class="d-flex justify-content-sm-around">
                    <i class="fas fa-comments fa-2x"></i><a href="forum/show/{{$post->id}}" class="p-1"> {{ $post->post_title }} </a>
                    <div class="small text-muted post_id p-1 align-self-center"> 
                        Created: {{ $post->created_at }}, ID#{{ $post->id }}
                    </div>
                </div>
                <div class="ml-auto">
                {{ $post->user->name }}
                </div>
            </div>
                
            <div class="card-body">
                {{ $post->post_description }}
            </div>
            <div id="card-link" class="action pt-3 card-footer" data-postid="{{$post->id}}">
                <a href="#" class="like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'You like this post' : 'Like' : 'Like'  }}</a> |
                <a href="#" class="like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 0 ? 'You dislike this post' : 'Dislike' : 'Dislike'  }}</a>
            </div>
        </div>
        <div class="pb-2"></div>

            @endforeach
            {{$posts->links()}}
        @else
            <p> No posts found. </p>
        @endif
    </div>
</div>
</div>
@endsection

