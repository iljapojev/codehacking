@extends('layouts.admin')

@section('page-title')
    Edit category
@endsection

@section('content')

<div class="row" style="margin-bottom:20px;">
    <div class="col-sm-6">
    {!! Form::model($category, ['method'=>'PATCH', 'action'=>['AdminCategoriesController@update', $category->id]]) !!}
        <div class="form-group">
            {!! Form::label('name', 'Category name *') !!}
            {!! Form::text('name', null, ['class'=>'form-control']) !!}
        </div>
        <div class="form-group">
            <p>* required fields</p>
        </div>

        <div class="form-group">
            {!! Form::submit('Update category', ['class'=>'btn btn-primary col-lg-4', 'style'=>'margin-right: 10px;']) !!}
        </div>
    {!! Form::close() !!}


    {!! Form::open(['method'=>'DELETE', 'action'=> ['AdminCategoriesController@destroy',$category->id]]) !!}
        <div class="form-group">
            {!! Form::submit('Delete category', ['class'=>'btn btn-danger col-lg-4']) !!}
        </div>
    {!! Form::close() !!}
    </div>
</div>
@include('includes.form_error')

@endsection