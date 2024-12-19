<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class TodoTest extends TestCase
{
    use RefreshDatabase;

    public function test_todo_can_be_created()
    {
        // Create a user using the test credentials
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@test.com',
            'password' => Hash::make('TestTest'), // Store the password hashed
        ]);

        // Log in as the created user
        $response = $this->postJson('/login', [
            'email' => 'test@test.com',
            'password' => 'TestTest',
        ]);

        // Extract the authentication token if using API (for example, with Sanctum)
        // $token = $response->json('token'); // Uncomment if using Sanctum token
        
        // Make a POST request to create a Todo, using actingAs to authenticate
        $response = $this->actingAs($user)
                         ->postJson('/api/todos', [
                             'title' => 'New Todo',
                             'description' => 'This is a new todo item',
                         ]);

        // Assert that the status code is 201 (created)
        $response->assertStatus(201);

        // Optionally check if the todo item was created in the database
        $this->assertDatabaseHas('todos', [
            'title' => 'New Todo',
            'description' => 'This is a new todo item',
        ]);
    }
}
