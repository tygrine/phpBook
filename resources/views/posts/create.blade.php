@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/forum" enctype="multipart/form-data" method="post">
        @csrf
        <div class="row">
            <div class="col-8 offset-2">
            <div class="row">
            <h2>Create a new post</h2>
            </div>

            <div class="form-group row">
                <label for="post-title">Post Title</label>
                <input type="text" name="post-title" class="form-control @error('post-title') is-invalid @enderror" id="post-title" placeholder="Post Title">
                
                @error('post-title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group row">
                <label for="tags">Add Tags</label>
                <input type="text" name="tags" class="form-control" id="tags" placeholder="Add a Tag">
            </div>

            <div class="form-group row">
                <label for="post-description">Post Description</label>
                <textarea class="form-control @error('post-description') is-invalid @enderror" name="post-description" id="post-description" rows="5" placeholder="Type something here..."></textarea>
                
                @error('post-description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="row">
                <button type="submit" class="btn btn-outline-primary">Submit</button>
            </div>
        </div>
    </form>
</div>
@endsection