@extends('layouts.admin')

@section('page-title')
    Categories
@endsection

@section('content')

@if(Session::has('message'))
    <div class="alert alert-info" role="alert">{{ Session('message') }}</div>
@endif

<table class="table">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Created at</th>
            <th>Updated at</th>
        </tr>
    </thead>
    @if($categories)
        @foreach($categories as $category)
            <tr>
                <td>{{ $category->id }}</td>
                <td><a href="{{route('admin.categories.edit', $category->id)}}" class="href">{{ $category->name }}</a></td>
                <td>{{ $category->created_at ? $category->created_at->diffForHumans() : 'no date' }}</td>
                <td>{{ $category->updated_at ? $category->updated_at->diffForHumans() : 'no date' }}</td>
            </tr>
        @endforeach
    @endif
</table>

@endsection