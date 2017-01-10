@extends('layouts.admin')

@section('page-title')
    Posts
@endsection

@section('content')
    @if(Session::has('message'))
        <div class="alert alert-info" role="alert">{{ Session('message') }}</div>
    @endif
    @if($posts)
    <table class="table">
        <thead>
            <tr>
                <th>Post Id</th>
                <th>Photo</th>
                <th>Owner</th>
                <th>Category</th>
                <th>Title</th>
                <th>Body</th>
                <th>Created On</th>
                <th>Modified On</th>
                <th>Edit</th>
                <th>View</th>
            </tr>
        </thead>
        @foreach($posts as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td><img height="50px" src="{{ $post->photo ? $post->photo->file : 'http://placehold.it/50x50/' }}" alt=""></td>
                <td>{{ $post->user->name }}</td>
                <td>{{ $post->category ? $post->category->name : 'uncategorized' }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ str_limit($post->body, 20) }}</td>
                <td>{{ $post->created_at->diffForHumans() }}</td>
                <td>{{ $post->updated_at->diffForHumans() }}</td>
                <td><a href="{{ route('admin.posts.edit', $post->id) }}">Edit post</a></td>
                <td><a href="{{ route('home.post', $post->id) }}">Post</a> | <a href="{{ route('admin.comments.show', $post->id) }}">Comments</a></td>
            </tr>
        @endforeach
    </table>
    @endif
@endsection