@extends('layouts.blog-post')

@section('content')

<!-- Blog Post -->

<!-- Title -->
<h1>{{ $post->title }}</h1>

<!-- Author -->
<p class="lead">
    by <a href="#">{{ $post->user->name }}</a>
</p>

<hr>

<!-- Date/Time -->
<p><span class="glyphicon glyphicon-time"></span> Posted on {{ $post->created_at->toDayDateTimeString() }}</p>

<hr>

<!-- Preview Image -->
<img class="img-responsive" src="{{ $post->photo->file }}" alt="">

<hr>

<!-- Post Content -->
{{ $post->body }}
<hr>

    @if(Session::has('message'))
        <div class="alert alert-info" role="alert">{{ Session('message') }}</div>
    @endif

@if(Auth::check())
    <!-- Blog Comments -->

    <!-- Comments Form -->
    <div class="well">
        <h4>Leave a Comment:</h4>
        {!! Form::open(['method'=>'POST', 'action'=>'PostCommentsController@store']) !!}
        {!! Form::hidden('post_id', $post->id) !!}
        <div class="form-group">
            {!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>3]) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Leava a comment', ['class'=>'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>

@endif
<hr>

<!-- Posted Comments -->
@if(count($comments) > 0)
    @foreach($comments as $comment)
        <!-- Comment -->
        <div class="media">
            <a class="pull-left" href="#">
                <img height="60px" lass="media-object" src="{{App\User::whereName($comment->author)->first()->photo->file}}" alt="">
            </a>
            <div class="media-body">
                <h4 class="media-heading">{{ $comment->author }}
                    <small>{{ $comment->created_at->format('F j\\, Y \\a\\t H:i') }}</small>
                </h4>
                {{ $comment->body }}
                <!-- Nested Comment - Reply -->
                {!! Form::open(['method'=>'POST', 'action'=>'CommentRepliesController@store']) !!}
                {!! Form::hidden('comment_id', $comment->id) !!}
                <div class="form-group">
                    <p></p>
                    {!! Form::textarea('body', null, ['class'=>'form-control', 'rows'=>1]) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('Reply to comment', ['class'=>'btn btn-primary pull-right']) !!}
                </div>
                {!! Form::close() !!}

                @if(count($comment->replies) > 0)
                    @foreach($comment->replies->sortByDesc('id') as $reply)
                        @if($reply->is_active == 1)
                        <div class="media">

                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">{{ $reply->author }}
                                    <small>{{ $reply->created_at->format('F j\\, Y \\a\\t H:i') }}</small>
                                </h4>
                                {{ $reply->body }}
                            </div>
                        </div>
                        @endif
                    @endforeach
                @endif
                <!-- End Nested Comment -->
            </div>
        </div>
    @endforeach
@endif

@stop

@section('scripts')
<scripts>
    $(".comment-reply-container .toggle-reply").click(function(){
        $(this)
    });
</scripts>
@stop