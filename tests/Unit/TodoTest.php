<?php

namespace Tests\Feature;

use Tests\TestCase;

class TodoTest extends TestCase
{
    public function test_home_redirects_to_todos_page()
    {
        // Send a GET request to the root URL and assert it redirects to the 'todos.index' route
        $response = $this->get('/');

        $response->assertStatus(302); // 302 is the status code for redirects
        $response->assertRedirect(route('todos.index'));
    }
}