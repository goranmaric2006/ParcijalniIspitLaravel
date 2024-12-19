<?php

namespace Tests\Feature;

use App\Models\Todo;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TodoTest extends TestCase
{
    use RefreshDatabase;

    // Test to ensure a user can view the todo list (no authentication needed)
    public function test_todo_list_can_be_accessed_without_authentication()
    {
        // Make a GET request to the todos index route
        $response = $this->get('/todos');

        // Assert the response is successful (200 OK)
        $response->assertStatus(200);

        // Optionally, assert the view contains a specific string to confirm the page rendered
        $response->assertSee('Todos');
    }

    // Test to ensure a user can create a todo (no authentication needed)
    public function test_todo_can_be_created_without_authentication()
    {
        // Make a POST request to create a new todo
        $response = $this->post('/todos', [
            'title' => 'New Todo',
            'description' => 'This is a new todo item',
        ]);

        // Assert the response is a redirect (302), meaning it was processed successfully
        // and the user was redirected to the appropriate page (e.g., the todo index)
        $response->assertStatus(302);

        // Optionally, check if the database contains the new todo
        $this->assertDatabaseHas('todos', [
            'title' => 'New Todo',
            'description' => 'This is a new todo item',
        ]);
    }
}
