<?php

use App\Models\Recipie;

beforeEach(function () {

    $setupResponse = $this->getJson('/api/setup');
    auth()->logout();
    $this->tokens = $setupResponse->json();
    $this->token = $this->tokens['crud'];

    $recipie = Recipie::factory()->create([
        'title' => 'Test Recipie',
        'image' => 'https://via.placeholder.com/150',
        'ingredients' => 'Test Ingredients',
        'instructions' => 'Test Instructions',
        'category' => 'breakfast',
    ]);

    $this->id = $recipie->id;

});

it('should not update a not authenticated user', function () {

    $response = $this->patchJson("/api/V1/recipies/{$this->id}");
    $response->assertStatus(401);

});

it('should not update a not authorized user', function () {


    $token = $this->tokens['basic'];

    $response = $this->withToken($token)
    ->patchJson("/api/V1/recipies/{$this->id}");
    $response->assertStatus(403);

});

it('should update a recipie with image', function () {

    $data = [
        'title' => 'Test Recipie (Editado)',
    ];

    $response = $this->withToken($this->token)
    ->patchJson("/api/V1/recipies/{$this->id}", $data);
    $response->assertOk()
    ->assertExactJson([
        'id' => 1,
        'title' => 'Test Recipie (Editado)',
        'image' => 'https://via.placeholder.com/150',
        'ingredients' => 'Test Ingredients',
        'instructions' => 'Test Instructions',
        'category' => 'breakfast',
    ]);

});

it('should create a recipie without image', function () {

    $data = [
        'image' => null,
    ];

    $response = $this->withToken($this->token)
    ->patchJson("/api/V1/recipies/{$this->id}", $data);
    $response->assertOk()
    ->assertExactJson([
        'id' => 1,
        'title' => 'Test Recipie',
        'image' => null,
        'ingredients' => 'Test Ingredients',
        'instructions' => 'Test Instructions',
        'category' => 'breakfast',
    ]);

});

it('should validate a image that is not a url', function() {
    $data = [
        'image' => 'teste',
    ];

    $response = $this->withToken($this->token)
    ->patchJson("/api/V1/recipies/{$this->id}", $data);
    $response->assertStatus(422);
});

it('should validate a title that is empty', function () {
    $data = [
        'title' => null,
    ];

    $response = $this->withToken($this->token)
    ->patchJson("/api/V1/recipies/{$this->id}", $data);
    $response->assertStatus(422);
});

it('should validate a title that is not a string', function () {
    $data = [
        'title' => 1234,
    ];

    $response = $this->withToken($this->token)
    ->patchJson("/api/V1/recipies/{$this->id}", $data);
    $response->assertStatus(422);
});

it('should validate a ingredients empty', function () {

    $data = [
        'ingredients' => null,
    ];

    $response = $this->withToken($this->token)
    ->patchJson("/api/V1/recipies/{$this->id}", $data);
    $response->assertStatus(422);

});

it('should validate a ingredients that is not a text', function () {
    $data = [
        'ingredients' => 1234,
    ];

    $response = $this->withToken($this->token)
    ->patchJson("/api/V1/recipies/{$this->id}", $data);
    $response->assertStatus(422);
});


it('should validate a instructions empty', function () {
    $data = [
        'instructions' => null,
    ];

    $response = $this->withToken($this->token)
    ->patchJson("/api/V1/recipies/{$this->id}", $data);
    $response->assertStatus(422);

});

it('should validate a instructions that is not a text', function () {

    $data = [
        'instructions' => 1234,
    ];

    $response = $this->withToken($this->token)
    ->patchJson("/api/V1/recipies/{$this->id}", $data);
    $response->assertStatus(422);

});

it('should validate a category empty', function () {

    $data = [
        'category' => null
    ];

    $response = $this->withToken($this->token)
    ->patchJson("/api/V1/recipies/{$this->id}", $data);
    $response->assertStatus(422);


});

it('should validate a category that is not a string', function () {

    $data = [
        'category' => 1234
    ];

    $response = $this->withToken($this->token)
    ->patchJson("/api/V1/recipies/{$this->id}", $data);
    $response->assertStatus(422);

});

it('should validate a category that is invalid', function () {

    $data = [
        'category' => 'test'
    ];

    $response = $this->withToken($this->token)
    ->patchJson("/api/V1/recipies/{$this->id}", $data);
    $response->assertStatus(422);

});