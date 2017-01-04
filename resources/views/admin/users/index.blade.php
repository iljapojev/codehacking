@extends('layouts.admin')

@section('content')
@if(Session::has('message'))
    <div class="alert alert-info" role="alert">{{ Session('message') }}</div>
@endif
@section('page-title')
    Users
@endsection
<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Photo</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Created at</th>
            <th>Modified at</th>
        </tr>
    </thead>
    <tbody>
        @if($users)
            @foreach($users as $user)
                <tr>
                    <td>{{$user->id}}</td>
                    <td><img height="50px" src="{{ $user->photo ? $user->photo->file : '/images/profile.png' }}" alt=""></td>
                    <td><a href="{{ route('admin.users.edit', $user->id) }}">{{ $user->name }}</a></td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->role->name}}</td>
                    <td>{{$user->is_active == 1 ? 'active' : 'not active'}}</td>
                    <td>{{$user->created_at->diffForHumans()}}</td>
                    <td>{{$user->updated_at->diffForHumans()}}</td>
                </tr>
            @endforeach
        @endif
        
      </tbody>
</table>
@endsection