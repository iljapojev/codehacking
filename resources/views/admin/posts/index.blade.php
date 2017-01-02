@extends('layouts.admin')

@section('page-title')
    Posts
@endsection

@section('content')
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
            </tr>
        </thead>
        @foreach($posts as $post)
            <tr>
                <td>{{ $post->id }}</td>
                <td><img height="50px" src="{{ $post->photo ? $post->photo->file : 'http://placehold.it/50x50/' }}" alt=""></td>
                <td>{{ $post->user->name }}</td>
                <td>{{ $post->category ? $post->category->name : 'uncategorized' }}</td>
                <td>{{ $post->title }}</td>
                <td>{{ $post->body }}</td>
                <td>{{ $post->created_at->diffForHumans() }}</td>
                <td>{{ $post->updated_at->diffForHumans() }}</td>
            </tr>
        @endforeach
    </table>
    @endif
@endsection