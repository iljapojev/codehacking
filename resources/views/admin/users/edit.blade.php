@extends('layouts.admin')

@section('page-title')
    Edit user
@endsection

@section('content')

    <div class="row" style="margin-bottom:20px;">

        <div class="col-sm-2">
            <img src="{{ $user->photo ? $user->photo->file : '/images/profile.png'}}" alt="" class="img-responsive img-rounded">
        </div>
        
        <div class="col-sm-10">

            {!! Form::model($user, ['method'=>'PATCH', 'action'=> ['AdminUsersController@update', $user->id], 'files'=>true, ]) !!}
                <div class="form-group">
                    {!! Form::label('name', 'Name') !!}
                    {!! Form::text('name', null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('email', 'Email') !!}
                    {!! Form::email('email', null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('role_id', 'Role') !!}
                    {!! Form::select('role_id', $roles, null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('is_active', 'Status') !!}
                    {!! Form::select('is_active', [1 => 'Active', 0 => "Not active"], null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('photo_id', 'Picture') !!}
                    {!! Form::file('photo_id', null, ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('password', 'Password') !!}
                    {!! Form::password('password', ['class'=>'form-control']) !!}
                </div>
                <div class="form-group">
                    {!! Form::submit('Edit user', ['class'=>'btn btn-primary col-md-2', 'style'=>'margin-right: 10px;']) !!}
                </div>
            {!! Form::close() !!}
            
            {!! Form::open(['method'=>'DELETE', 'action'=> ['AdminUsersController@destroy',$user->id]]) !!}
                <div class="form-group">
                    {!! Form::submit('Delete user', ['class'=>'btn btn-danger col-md-2']) !!}
                </div>
            {!! Form::close() !!}

        </div>
    
    </div>

    @include('includes.form_error')

@endsection