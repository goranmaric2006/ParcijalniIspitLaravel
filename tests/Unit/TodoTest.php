<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class TodoTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that a todo item can be created.
     *
     * @return void
     */
    public function test_todo_can_be_created()
    {
        // Create the user for authentication
        $user = User::create([
            'name' => 'Goran Marić',
            'email' => 'test@test.com',
            'password' => Hash::make('testtest'), 
        ]);

        // Authenticate the user
        $this->actingAs($user);

        // Send the POST request to create a new todo item
        $response = $this->post('/todos', [
            'title' => 'New Todo',
            'description' => 'This is a new todo item',
        ]);

        // Assert the response status is 201 (Created)
        $response->assertStatus(201);

        // Verify the todo is in the database
        $this->assertDatabaseHas('todos', [
            'title' => 'New Todo',
            'description' => 'This is a new todo item',
        ]);
    }
}
