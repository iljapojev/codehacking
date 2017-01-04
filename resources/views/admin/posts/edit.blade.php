@extends('layouts.admin')

@section('page-title')
    Edit post
@endsection

@section('content')

<div class="row" style="margin-bottom:20px;">
    <div class="col-sm-2">
        <img src="{{ $post->photo ? $post->photo->file : 'http://placehold.it/100x100'}}" alt="" class="img-responsive img-rounded">
    </div>

    <div class="col-sm-10">

    {!! Form::model($post, ['method'=>'PATCH', 'action'=> ['AdminPostsController@update', $post->id], 'files'=>true]) !!}

        <div class="form-group">
            {!! Form::label('title', 'Title') !!}
            {!! Form::text('title', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('category_id', 'Category') !!}
            {!! Form::select('category_id', $categories, null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('photo_id', 'Picture') !!}
            {!! Form::file('photo_id', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('body', 'Description') !!}
            {!! Form::textarea('body', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit('Update post', ['class'=>'btn btn-primary col-md-2', 'style'=>'margin-right: 10px;']) !!}
        </div>

    {!! Form::close() !!}
        
    {!! Form::open(['method'=>'DELETE', 'action'=>['AdminPostsController@destroy', $post->id]]) !!}
        <div class="form-group">
            {!! Form::submit('Delete post', ['class'=>'btn btn-danger col-md-2']) !!}
        </div>
    {!! Form::close() !!}
        
    </div>
    
</div>

    @include('includes.form_error')

@endsection