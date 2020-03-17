@extends('layouts.app')

@section('content')
<div class="container">
    <a href="/forum" class="btn btn-outline-primary">Back</a>
    @if(Auth::user() == $post->user)
    <a href="/forum/edit/{{$post->id}}" class="btn btn-outline-primary">Edit</a>
    <a href="/forum/delete/{{$post->id}}" class="btn btn-outline-secondary" data-toggle="modal" data-target="#btn-postdelModal">Delete</a>
    @endif
    <hr>
    <h1>{{$post->post_title}}</h1>
    <small>Created on {{$post->created_at}} by {{ $post->user->name }}</small>
    <div class="pb-4"></div>
    <div>
        {{$post->post_description}}
    </div>
    <div class="pb-3"></div>

    <hr/>
    <div class="row">
        <div id="comment-section" class="mx-auto col-11">
            @foreach($post->comments as $comment)
                <div class="comment">
                <p><strong>{{$comment->user->name}}</strong> <small>Commented on: {{$comment->created_at}}</small></p>
                <p>{{$comment->comment_description}}
                @if(Auth::user() == $comment->user)
                    <a href="/comments/delete/{{$comment->id}}" class="btn btn-outline-secondary btn-sm float-right">Delete Comment</a>
                @endif
                </div>
                </p>
                <hr>
            @endforeach
            {{$post->comments->links()}}
        </div>
    </div>
    <div class="row">
        <div id="comment-form" class="mx-auto col-11">
        <form action="/comments/{{$post->id}}" enctype="multipart/form-data" method="post">
            @csrf
                <div class="row">
                    <label for="comment-user"><strong>{{Auth::user()->name}}</strong></label>
                </div>
                <div class="row">
                <label for="comment-description">Add a comment</label>
                    <textarea class="form-control @error('comment-description') is-invalid @enderror" name="comment-description" id="comment-description" rows="3" placeholder="Type Comment Here"></textarea>
                
                    @error('comment-description')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="row">
                    <button type="submit" class="btn btn-outline-primary">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>

  <!-- Delete Button Modal -->
  <div class="modal fade" id="btn-postdelModal" tabindex="-1" role="dialog" aria-labelledby="postdelModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Post</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
           Are you sure you wish to delete this post and its contents? 
           <p>
           This action cannot be undone.
           </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Close</button>
          <button id="btn-postdel" type="button" class="btn btn-outline-danger">Delete</button>
        </div>
      </div>
    </div>
  </div>
@endsection