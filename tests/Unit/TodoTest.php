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
        
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@test.com',
            'password' => Hash::make('TestTest'), 
        ]);


        $response = $this->postJson('/login', [
            'email' => 'test@test.com',
            'password' => 'TestTest',
        ]);

        $response = $this->actingAs($user)
                         ->postJson('/api/todos', [
                             'title' => 'New Todo',
                             'description' => 'This is a new todo item',
                         ]);


        $response->assertStatus(201);


        $this->assertDatabaseHas('todos', [
            'title' => 'New Todo',
            'description' => 'This is a new todo item',
        ]);
    }
}
