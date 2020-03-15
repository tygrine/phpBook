@extends('layouts.app')

@section('content')

<div class="container">
<div class="d-flex justify-content-end">
    <a class="btn btn-outline-primary" href="/forum/create" role="button">Add Post</a>
</div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach ($posts as $post)
            <div class="card pb-2">
            <div class="card-header d-flex">
                <div class="d-flex align-items-start">
                {{ $post->post_title }}
                </div>
                <div class="ml-auto">
                {{ $post->user->name }}
                </div>
            </div>
                
            <div class="card-body" data-postid="{{$post->id}}">
                    {{ $post->post_description }}
                    
                    <div class="text-muted post_id"> 
                        {{ $post->id }}
                    </div>
                <div class="action card-link pt-3">
                    <a href="#" class="like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 1 ? 'You like this post' : 'Like' : 'Like'  }}</a> |
                    <a href="#" class="like">{{ Auth::user()->likes()->where('post_id', $post->id)->first() ? Auth::user()->likes()->where('post_id', $post->id)->first()->like == 0 ? 'You don\'t like this post' : 'Dislike' : 'Dislike'  }}</a>
                </div>
            </div>
            </div>
            <div class="pb-4"></div>
            @endforeach
        </div>
    </div>
</div>
@endsection
