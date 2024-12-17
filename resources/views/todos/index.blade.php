@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Todo List</h1>

    <p style="font-size: 22px, font-weight: bold, color: red">CD pipeline test</p>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($todos as $todo)
                <tr>
                    <td>{{ $todo->title }}</td>
                    <td>{{ $todo->description }}</td>
                    <td>
                        <a href="{{ route('todos.edit', $todo->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('todos.destroy', $todo->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('todos.create') }}" class="btn btn-success">Create Todo</a>
</div>
@endsection
