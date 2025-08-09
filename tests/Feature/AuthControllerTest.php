<?php

use App\Models\User;

test('new users can register', function () {
    $response = $this->postJson('/api/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $this->assertAuthenticated();

    $response->assertStatus(201)
        ->assertJsonStructure([
            'data' => [
                'token',
                'user' => [
                    'id',
                    'name',
                    'email',
                ],
            ],
        ]);
});

test('users can login', function () {
    $user = User::factory()->create();

    $response = $this->postJson(route('login'), [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertStatus(201)
        ->assertJsonStructure([
            'data' => [
                'token',
                'user' => [
                    'id',
                    'name',
                    'email',
                ],
            ],
        ]);
});

test('users can not authenticate with invalid email', function () {
    $user = User::factory()->create([
        'password'=> 'password'
    ]);

    $response = $this->postJson(route('login'), [
        'email' => 'wrong-email',
        'password' => 'password', // correct password
    ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors('email');

    $this->assertGuest();
});

test('users can not authenticate with invalid password', function () {
    $user = User::factory()->create();

    $response = $this->postJson(route('login'), [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    $response->assertStatus(422)
        ->assertJsonValidationErrors('email');

    $this->assertGuest();
});

test('users can logout', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->deleteJson(route('logout'));

    $response->assertNoContent();

    $this->assertDatabaseCount('personal_access_tokens', 0);
});
