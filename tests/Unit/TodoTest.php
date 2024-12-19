<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Todo;

class TodoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_todo_item_can_be_created()
    {
        // Arrange: Define the todo data
        $todoData = [
            'title' => 'Buy groceries',
            'description' => 'Milk, Bread, and Eggs',
        ];

        // Act: Make a POST request to create a todo item
        $response = $this->postJson(route('todos.store'), $todoData);

        // Assert: Check if the todo item exists in the database
        $response->assertStatus(201); // Assuming successful creation returns 201
        $this->assertDatabaseHas('todos', [
            'title' => 'Buy groceries',
            'description' => 'Milk, Bread, and Eggs',
        ]);
    }
}
