@extends('layouts.admin')

@section('page-title')
    Show replies
@endsection

@section('content')
    @if(Session::has('message'))
        <div class="alert alert-info" role="alert">{{ Session('message') }}</div>
    @endif
   
    @if(count($commentreplies) > 0)
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
            @foreach($commentreplies as $reply)
            <tr>
                <td>{{ $reply->id }}</td>
                <td>{{ $reply->author }}</td>
                <td>{{ $reply->email }}</td>
                <td>{{ $reply->body }}</td>
                <td><a href="{{ route('home.post', $reply->comment->post->id) }}">View post</a></td>
                <td>{{ $reply->created_at->diffForHumans()  }}</td>
                <td>
                    @if($reply->is_active == 1)
                        {!! Form::open(['method'=>'PATCH', 'action'=>['CommentRepliesController@update', $reply->id]]) !!}
                            {!! Form::hidden('is_active', '0') !!}
                            <div class="form-group">
                                {!! Form::submit('Un-approve', ['class'=>'btn btn-warning']) !!}
                             </div>
                        {!! Form::close() !!}
                    @else
                        {!! Form::open(['method'=>'PATCH', 'action'=>['CommentRepliesController@update', $reply->id]]) !!}
                            {!! Form::hidden('is_active', '1') !!}
                            <div class="form-group">
                                {!! Form::submit('Approve', ['class'=>'btn btn-success']) !!}
                             </div>
                        {!! Form::close() !!}
                    @endif
                
                </td>
                <td> 
                     {!! Form::open(['method'=>'DELETE', 'action'=>['CommentRepliesController@destroy', $reply->id]]) !!}
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
    <h1 class="text-center">No replies</h1>

    @endif

@endsection