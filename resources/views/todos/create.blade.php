@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create New Todo</h1>

    <form action="{{ route('todos.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control" rows="3" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Create Todo</button>
    </form>
</div>
@endsection
