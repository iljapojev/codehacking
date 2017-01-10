@extends('layouts.admin')

@section('page-title')
    Show comments
@endsection

@section('content')
    @if(Session::has('message'))
        <div class="alert alert-info" role="alert">{{ Session('message') }}</div>
    @endif
   
    @if(count($postcomments) > 0)
    <table class="table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Author</th>
                <th>Email</th>
                <th>Body</th>
                <th>Post</th>
                <th>Created at</th>
                <th>Action</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($postcomments as $comment)
            <tr>
                <td>{{ $comment->id }}</td>
                <td>{{ $comment->author }}</td>
                <td>{{ $comment->email }}</td>
                <td>{{ $comment->body }}</td>
                <td><a href="{{ route('home.post', $comment->post->id) }}">View post</a> | <a href="{{ route('home.post', $comment->id) }}">View replies</a></td>
                <td>{{ $comment->created_at->diffForHumans()  }}</td>
                <td>
                    @if($comment->is_active == 1)
                        {!! Form::open(['method'=>'PATCH', 'action'=>['PostCommentsController@update', $comment->id]]) !!}
                            {!! Form::hidden('is_active', '0') !!}
                            <div class="form-group">
                                {!! Form::submit('Un-approve', ['class'=>'btn btn-warning']) !!}
                             </div>
                        {!! Form::close() !!}
                    @else
                        {!! Form::open(['method'=>'PATCH', 'action'=>['PostCommentsController@update', $comment->id]]) !!}
                            {!! Form::hidden('is_active', '1') !!}
                            <div class="form-group">
                                {!! Form::submit('Approve', ['class'=>'btn btn-success']) !!}
                             </div>
                        {!! Form::close() !!}
                    @endif
                
                </td>
                <td>
                     {!! Form::open(['method'=>'DELETE', 'action'=>['PostCommentsController@destroy', $comment->id]]) !!}
                        <div class="form-group">
                            {!! Form::submit('Delete', ['class'=>'btn btn-danger']) !!}
                         </div>
                    {!! Form::close() !!}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <h1 class="text-center">No comments</h1>

    @endif

@endsection