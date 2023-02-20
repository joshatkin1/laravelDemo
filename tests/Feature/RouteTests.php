<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RouteTests extends TestCase
{
    public function test_the_application_returns_a_successful_response()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_the_home_returns_a_successful_response()
    {
        $response = $this->get('/home');

        $response->assertStatus(200);
    }

    public function test_the_users_page_returns_a_successful_response()
    {
        $response = $this->get('/users');

        $response->assertStatus(200);
    }

    public function test_the_user_page_returns_a_successful_response()
    {
        $response = $this->get('/user/1');

        $response->assertStatus(200);
    }
}
