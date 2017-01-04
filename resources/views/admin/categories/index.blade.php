@extends('layouts.admin')

@section('page-title')
    Categories
@endsection

@section('content')

@if(Session::has('message'))
    <div class="alert alert-info" role="alert">{{ Session('message') }}</div>
@endif
<div class="row">
    <div class="col-sm-6">
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
    </div>
    
    
    <div class="col-sm-6">
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Created at</th>
                </tr>
            </thead>
            @if($categories)
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td><a href="{{route('admin.categories.edit', $category->id)}}" class="href">{{ $category->name }}</a></td>
                        <td>{{ $category->created_at ? $category->created_at->diffForHumans() : 'no date' }}</td>
<!--                         <td>{{ $category->updated_at ? $category->updated_at->diffForHumans() : 'no date' }}</td> -->
                    </tr>
                @endforeach
            @endif
        </table>
    </div>
</div>
@endsection