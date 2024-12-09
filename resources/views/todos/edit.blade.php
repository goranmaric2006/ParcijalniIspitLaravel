@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Todo</h1>

    <form action="{{ route('todos.update', $todo->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $todo->title) }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="3" required>{{ old('description', $todo->description) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Todo</button>
    </form>
</div>
@endsection
