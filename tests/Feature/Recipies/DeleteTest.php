<?php

use App\Models\Recipie;

beforeEach(function () {
    $setupResponse = $this->getJson('/api/setup');
    auth()->logout();
    $this->tokens = $setupResponse->json();
});


it('should delete a recipie', function () {

    $tokenDelete = $this->tokens['crud'];

    $recipie = Recipie::factory()->create([
        'title' => 'Test Recipie',
        'ingredients' => 'Test Ingredients',
        'instructions' => 'Test Instructions',
        'category' => 'breakfast',
    ]);

    $response = $this
    ->withToken($tokenDelete)
    ->deleteJson("/api/V1/recipies/{$recipie->id}");
    $response->assertOk()
    ->assertExactJson([
        'message' => __('Recipie deleted!')
    ]);

});

it('should not delete a recipie inexistent', function () {

    $token = $this->tokens['crud']; 

    $response = $this->withToken($token)
    ->deleteJson("/api/V1/recipies/1");
    $response->assertNotFound()
    ->assertExactJson([
        'message' => __('Recipie not found.'),
    ]);

});

it('should not delete a not authenticated user', function () {

    auth()->logout();

    $response = $this->deleteJson("/api/V1/recipies/1");
    $response->assertStatus(401);

});

it('should not delete a not authorized user', function () {

    $token = $this->tokens['basic'];

    $recipie = Recipie::factory()->create([
        'title' => 'Test Recipie',
        'ingredients' => 'Test Ingredients',
        'instructions' => 'Test Instructions',
        'category' => 'breakfast',
    ]);

    $response = $this->withToken($token)
    ->deleteJson("/api/V1/recipies/{$recipie->id}");

    $response->assertStatus(403)
    ->assertExactJson([
        'message' => __('You are not have authorization to delete a Recipie.')
    ]);

});
