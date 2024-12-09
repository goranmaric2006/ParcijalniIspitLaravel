<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::all();
        return view('todos.index', compact('todos'));
    }

    public function create()
    {
        return view('todos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Todo::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('todos.index')->with('success', 'Todo created successfully!');
    }

    public function edit(Todo $todo)
    {
        return view('todos.edit', compact('todo'));
    }

    public function update(Request $request, Todo $todo)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $todo->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('todos.index')->with('success', 'Todo updated successfully!');
    }
    public function destroy(Todo $todo)
    {
        $todo->delete();

        return redirect()->route('todos.index')->with('success', 'Todo deleted successfully!');
    }
}
