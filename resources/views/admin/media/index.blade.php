@extends('layouts.admin')

@section('page-title')
    Media
@endsection

@section('content')

@if(Session::has('message'))
    <div class="alert alert-info" role="alert">{{ Session('message') }}</div>
@endif
<div class="row">
    <div class="col-sm-6">
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Created at</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if($photos)
                    @foreach($photos as $photo)
                    <tr>
                        <td>{{ $photo->id }}</td>
                        <td><img height="20px" src="{{ $photo->file ? $photo->file : 'no file' }}"></td>
                        <td>{{ $photo->created_at ? $photo->created_at : 'no date' }}</td>
                        <td>
                            {!! Form::open(['method'=>'DELETE', 'action'=>['AdminMediaController@destroy', $photo->id]]) !!}
                            <div class="form-group">
                                {!! Form::submit('Delete', ['class'=>"btn btn-danger"]) !!}
                            </div>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection