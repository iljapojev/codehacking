@extends('layouts.admin')

@section('page-title')
    Create category
@endsection

@section('content')
{!! Form::open(['method'=>'POST', 'action'=>'AdminCategoriesController@store']) !!}
<div class="form-group">
    {!! Form::label('name', 'Category name *') !!}
    {!! Form::text('name', null, ['class'=>'form-control']) !!}
</div>

<p>* required fields</p>

<div class="form-group">
    {!! Form::submit('Create category', ['class'=>'btn btn-primary']) !!}
</div>
{!! Form::close() !!}

@include('includes.form_error')

@endsection