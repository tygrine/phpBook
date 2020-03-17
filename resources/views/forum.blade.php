@extends('layouts.app')

@section('content')

<div class="container">
<div class="d-flex justify-content-start">
    <a class="btn btn-outline-primary" href="/forum/create" role="button">Add Post</a>
</div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (count($posts) > 0)
                @foreach ($posts as $post)

            <div class="card pb-1">
            <div class="card-header d-flex">
                <div class="d-flex justify-content-sm-around">
                <a href="forum/show/{{$post->id}}" class="p-1"> {{ $post->post_title }} </a>
                    <div class="small text-muted post_id p-1 align-self-center"> 
                        Created: {{ $post->created_at }}, ID#{{ $post->id }}
                    </div>
                </div>
                <div class="ml-auto">
                {{ $post->user->name }}
                </div>
            </div>
                
            <div class="card-body" data-postid="{{$post->id}}">
                    {{ $post->post_description }}
                    
                <div class="action card-link pt-3">
                    <a href="#" class="like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'You like this post' : 'Like' : 'Like'  }}</a> |
                    <a href="#" class="like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 0 ? 'You don\'t like this post' : 'Dislike' : 'Dislike'  }}</a>
                </div>
            </div>
            </div>
            <div class="pb-4"></div>

                @endforeach
                {{$posts->links()}}
            @else
                <p> No posts found. </p>
            @endif
        </div>
    </div>
</div>
@endsection
