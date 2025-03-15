<?php

use App\Models\Recipie;

beforeEach(function () {

    $setupResponse = $this->getJson('/api/setup');
    auth()->logout();
    $this->tokens = $setupResponse->json();
    $this->token = $this->tokens['crud'];

    $recipie = Recipie::factory()->create([
        'title' => 'Test Recipie',
        'ingredients' => 'Test Ingredients',
        'instructions' => 'Test Instructions',
        'category' => 'breakfast',
    ]);

    $this->id = $recipie->id;

    $this->data = [
        'title' => 'Test Recipie',
        'image' => null,
        'ingredients' => 'Test Ingredients',
        'instructions' => 'Test Instructions',
        'category' => 'breakfast',
    ];

});

it('should not update a not authenticated user', function () {

    $response = $this->putJson("/api/V1/recipies/{$this->id}", $this->data);
    $response->assertStatus(401);

});

it('should not update a not authorized user', function () {

    $token = $this->tokens['basic'];

    $response = $this->withToken($token)
    ->putJson("/api/V1/recipies/{$this->id}", $this->data);
    $response->assertStatus(403);

});

it('should update a recipie with image', function () {

    $this->data['image'] = 'https://via.placeholder.com/150';

    $response = $this
    ->withToken($this->token)
    ->putJson("/api/V1/recipies/{$this->id}", $this->data);
    $response->assertOk()
    ->assertExactJson([
        'id' => 1,
        'title' => 'Test Recipie',
        'image' => 'https://via.placeholder.com/150',
        'ingredients' => 'Test Ingredients',
        'instructions' => 'Test Instructions',
        'category' => 'breakfast',
    ]);

});

it('should create a recipie without image', function () {

    $response = $this
    ->withToken($this->token)
    ->putJson("/api/V1/recipies/{$this->id}", $this->data);
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
  
    $this->data['image'] = 'teste';

    $response = $this
    ->withToken($this->token)
    ->putJson("/api/V1/recipies/{$this->id}", $this->data);
    $response->assertStatus(422);
});

it('should validate a title that is empty', function () {
  
    $this->data['title'] = null;

    $response = $this
    ->withToken($this->token)
    ->putJson("/api/V1/recipies/{$this->id}", $this->data);
    $response->assertStatus(422);
});

it('should validate a title that is not a string', function () {

    $this->data['title'] = 1234;

    $response = $this
    ->withToken($this->token)
    ->putJson("/api/V1/recipies/{$this->id}", $this->data);
    $response->assertStatus(422);
});

it('should validate a ingredients empty', function () {

    $this->data['ingredients'] = null;

    $response = $this
    ->withToken($this->token)
    ->putJson("/api/V1/recipies/{$this->id}", $this->data);
    $response->assertStatus(422);

});

it('should validate a ingredients that is not a text', function () {

    $this->data['ingredients'] = 1234;

    $response = $this
    ->withToken($this->token)
    ->putJson("/api/V1/recipies/{$this->id}", $this->data);
    $response->assertStatus(422);
});


it('should validate a instructions empty', function () {

    $this->data['instructions'] = null;

    $response = $this
    ->withToken($this->token)
    ->putJson("/api/V1/recipies/{$this->id}", $this->data);
    $response->assertStatus(422);

});

it('should validate a instructions that is not a text', function () {

    $this->data['instructions'] = 1234;

    $response = $this
    ->withToken($this->token)
    ->putJson("/api/V1/recipies/{$this->id}", $this->data);
    $response->assertStatus(422);

});

it('should validate a category empty', function () {

    $this->data['category'] = null;

    $response = $this
    ->withToken($this->token)
    ->putJson("/api/V1/recipies/{$this->id}", $this->data);
    $response->assertStatus(422);


});

it('should validate a category that is not a string', function () {

    $this->data['category'] = 1234;

    $response = $this
    ->withToken($this->token)
    ->putJson("/api/V1/recipies/{$this->id}", $this->data);
    $response->assertStatus(422);

});

it('should validate a category that is invalid', function () {

    $this->data['category'] = 'test';

    $response = $this
    ->withToken($this->token)
    ->putJson("/api/V1/recipies/{$this->id}", $this->data);
    $response->assertStatus(422);

});