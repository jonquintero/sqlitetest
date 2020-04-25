<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    /** @test */
    public function login_displays_the_login_form()
    {
        $response = $this->get(route('login'));

        $response->assertStatus(200);
        $response->assertViewIs('auth.login');
    }

    /** @test */
    public function login_displays_validation_errors()
    {
        $response = $this->post('/login', []);

        $response->assertStatus(302);
        $response->assertSessionHasErrors('email');
    }

    /** @test */
    public function index_returns_a_view()
    {
        $user = factory(User::class)->create();

        $response = $this->actingAs($user)->get('admin');

        $response->assertStatus(200);
    }
}
